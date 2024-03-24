<?php
namespace App\Repositories;

use App\DbConnection\Db;
use App\Models\User;
use PDO;
use PDOException;

class UserRepository
{
    private $db;

    public function __construct()
    {
        $database = new Db;
        $this->db  = $database->getDB();
    }

    public function getAllUsers()
{
    $userArray = [];
    $sql = "SELECT * FROM tdl_users";
    $stmt = $this->db->query($sql);
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        $userArray[] = new User($row); 
    }
    return $userArray;
}


    public function getUserById($id)
    {
        $sql = "SELECT * FROM tdl_users WHERE user_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\App\Models\User');
        return $stmt->fetch();
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM tdl_users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\App\Models\User');
        return $stmt->fetch();
    }

    public function createUser(User $user)
    {

    try {
        $hash = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO tdl_users (first_name, last_name, email, password)
                VALUES (:first_name, :last_name, :email, :password)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':first_name', $user->getFirst_name());
        $stmt->bindValue(':last_name', $user->getLast_name());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $hash); 
        $stmt->execute();
        
        return true;
    } catch (\PDOException $e) {
        var_dump($e);
        return false;
    }

    }

    public function updateUser(User $user)
    {
        $sql = "UPDATE tdl_users SET
                    first_name = :first_name,
                    last_name = :last_name,
                    email = :email,
                    password = :password
                WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':first_name', $user->getFirst_name());
        $stmt->bindValue(':last_name', $user->getLast_name());
        $stmt->bindValue(':email', $user->getEmail());
        
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $stmt->bindValue(':password', $hashedPassword);
        
        $stmt->bindValue(':user_id', $user->getUser_id());
        return $stmt->execute();
    }
    

    public function deleteUser($user_Id)
    {
        try {
            $sql = "DELETE FROM tdl_task_has_category WHERE task_id IN (SELECT task_id FROM tdl_task WHERE user_id = :user_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $user_Id);
            $stmt->execute();
            
            $sql = "DELETE FROM tdl_task WHERE user_id = :user_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $user_Id);
            $stmt->execute();
    
            $sql = "DELETE FROM tdl_users WHERE user_id = :user_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $user_Id);
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo "Error deleting user: " . $e->getMessage();
            return false;
        }
    }
}    
?>
