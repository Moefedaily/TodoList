<?php
namespace App\Repositories;
use App\DbConnection\Db;
use App\Models\Task;
use PDO;


class TaskRepository
{
    private $db;

    public function __construct()
    {
      $database = new Db;
      $this->db = $database->getDB();
      }

    public function getAllTasks()
    {
        $taskArray = [];
        $sql = "SELECT * FROM tdl_task";
        $stmt = $this->db->query($sql);
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $taskArray[] = new Task($row);
        }
        return $taskArray;

    }
   

    public function getTasksByUserId($user_id)
    {
        try {
            $sql = "SELECT * FROM tdl_task WHERE user_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$user_id]);
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Models\Task');
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function getTaskById($task_id)
    {
        $sql = "SELECT * FROM tdl_task WHERE task_id = :task_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':task_id', $task_id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\App\Models\Task');
        return $stmt->fetch();
    }


    public function createTask(Task $task, Array $categorie)
    {
        $sql = "INSERT INTO tdl_task (title, description, dueto, completed, priority_id, user_id)
                VALUES (:title, :description, :dueto, :completed, :priority_id, :user_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':title', $task->getTitle());
        $stmt->bindValue(':description', $task->getDescription());
        $stmt->bindValue(':dueto', $task->getDueto());
        $stmt->bindValue(':completed', $task->getCompleted());
        $stmt->bindValue(':priority_id', $task->getPriority_id());
        $stmt->bindValue(':user_id', $task->getUser_id());
         $stmt->execute();
         $id = $this->db->lastInsertId();
         $this->assignCategoriesToTask($id, $categorie);
        return $id;
    }
    
    public function updateTask(Task $task)
{
    $title = $task->getTitle();
    $description = $task->getDescription();
    $dueto = $task->getDueto();
    $completed = $task->getCompleted();
    $priority_id = $task->getPriority_id(); 
    $user_id = $task->getUser_id(); 
    $task_id = $task->getTask_id(); 

    try {
        $sql = "UPDATE tdl_task 
                SET title = ?, 
                    description = ?, 
                    dueto = ?, 
                    completed = ?, 
                    priority_id = ?, 
                    user_id = ? 
                WHERE task_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$title, $description, $dueto, $completed, $priority_id, $user_id, $task_id]);
        return $stmt->rowCount() == 1;
    } catch (\PDOException $e) {
        var_dump($e);
        return false;
    }
}


public function deleteTask($task_id)
{
    try {
        // Delete category associations from tdl_task_has_category
        $sql = "DELETE FROM tdl_task_has_category WHERE task_id = :task_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':task_id', $task_id);
        $stmt->execute();

        // Delete the task from tdl_task
        $sql = "DELETE FROM tdl_task WHERE task_id = :task_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':task_id', $task_id);
        $result = $stmt->execute();

        return $result;
    } catch (\PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
    public function getTaskCategories($taskId)
{
    try {
        $sql = "SELECT category.category_id, category.name
                FROM tdl_task_has_category task_category
                JOIN tdl_category category ON task_category.category_id = category.category_id
                WHERE task_category.task_id = :task_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':task_id', $taskId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Models\Task');
    } catch (\PDOException $e) {
        return [];
    }
}


public function assignCategoriesToTask($taskId, array $categoryIds)
{
    if ($taskId) {
        // First, we have to remove the existing category associations for the task
        $sql = "DELETE FROM tdl_task_has_category WHERE task_id = :task_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':task_id', $taskId);
        $stmt->execute();

        // Then, we'll insert the new category associations
        $sql = "INSERT INTO tdl_task_has_category (task_id, category_id) VALUES (:task_id, :category_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':task_id', $taskId);
        foreach ($categoryIds as $categoryId) {
            $stmt->bindValue(':category_id', $categoryId);
            $stmt->execute();
        }
    }
}

}

