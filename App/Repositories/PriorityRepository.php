<?php
namespace App\Repositories;

use App\DbConnection\Db;
use App\Models\Priority;
use PDO;

class PriorityRepository
{
    private $db;

    public function __construct()
    {
        $database = new Db;
        $this->db = $database->getDB();
    }

    public function getAllPriorities()
    {
        $sql = "SELECT * FROM tdl_priority";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, '\App\Models\Priority');
    }

    public function getPriorityById($priority_id)
    {
        $sql = "SELECT * FROM tdl_priority WHERE priority_id = :priority_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':priority_id', $priority_id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\App\Models\Priority');
        return $stmt->fetch();
    }
   
    public function getPriorityNameById($priority_id)
{
    $sql = "SELECT name FROM tdl_priority WHERE priority_id = :priority_id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':priority_id', $priority_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['name'] : '';
}
}