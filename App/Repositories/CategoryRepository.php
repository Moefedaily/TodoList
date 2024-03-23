<?php
namespace App\Repositories;

use App\DbConnection\Db;
use App\Models\Category;
use PDO;

class CategoryRepository
{
    private $db;

    public function __construct()
    {
        $database = new Db;
        $this->db = $database->getDB();
    }

    public function getAllCategories()
    {
        $categoryArray = [];
        $sql = "SELECT * FROM tdl_category";
        $stmt = $this->db->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categoryArray[] = new Category($row);
        }
        return $categoryArray;
    }

    public function getCategoryById($id)
    {
        $sql = "SELECT * FROM tdl_category WHERE category_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\App\Models\Category');
        return $stmt->fetch();
    }

    public function createCategory(Category $category)
    {
        $sql = "INSERT INTO tdl_category (name) VALUES (:name)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':name', $category->getName());
        return $stmt->execute();
    }

    public function updateCategory(Category $category)
    {
        $sql = "UPDATE tdl_category SET name = :name WHERE category_id = :category_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':name', $category->getName());
        $stmt->bindValue(':category_id', $category->getCategory_id());
        return $stmt->execute();
    }

    public function deleteCategory($id)
    {
        $sql = "DELETE FROM tdl_category WHERE category_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}