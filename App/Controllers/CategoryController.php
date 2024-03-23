<?php
namespace App\Controllers;

use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryController
{
    private $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAllCategories();
        return $categories;
    }

    public function create(Category $category)
    {
        $isCreated = $this->categoryRepository->createCategory($category);
        return $isCreated;
    }

    public function update(Category $category)
    {
        $isUpdated = $this->categoryRepository->updateCategory($category);
        return $isUpdated;
    }

    public function delete($id)
    {
        $isDeleted = $this->categoryRepository->deleteCategory($id);
        return $isDeleted;
    }
}