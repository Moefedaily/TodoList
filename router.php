<?php
use App\Controllers\UserController;
use App\Controllers\TaskController;
use App\DbConnection\Db;
use App\Models\Task;
use App\Models\User;

$dbConnection = new Db();
$db = $dbConnection->getDB();
$userController = new UserController($db);
$taskController = new TaskController($db);

$route = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$route = str_replace('/cours/Brief-Todolist/', '', $route);
$routeParts = explode('/', $route);



switch ($route) {

       /****************************task-router****************************/     

    case 'task':
        if (isset($_SESSION['user'])) {
        $taskController->index();
        } else {
            header('Location: /cours/Brief-Todolist/login');
        }
        break;


    case 'create':
        if ($method === 'GET') {
            if (isset($_SESSION['user'])) {
                $taskController->create();
            } else {
                header('Location: /cours/Brief-Todolist/login');
            }
        } else {
            http_response_code(405);
            echo 'Method Not Allowed "task-create"';
        }
        break;

    case str_contains($route,"task/edit"):
        $taskId = end($routeParts);
        if (!empty($taskId)) {
            $taskController->edit($taskId);
        } else {
            http_response_code(405);
        }
        break;

    case 'task/store':
        if ($method === 'POST') {
            $task = new Task($_POST);
            $categoryIds = isset($_POST['categories']) ? $_POST['categories'] : [];
            $taskController->store($task, $categoryIds);
        } else {
            http_response_code(405);
            echo 'Method Not Allowed "task-store"';
        }
        break;
    
    case 'task/update':
        if ($method === 'POST') {
            $task = new Task($_POST);
            $categoryIds = isset($_POST['categories']) ? $_POST['categories'] : [];
            $taskController->update($task, $categoryIds);
    
        } else {
            http_response_code(405);
            echo 'Method Not Allowed "task-update"';
        }
        break;
    
    case str_contains($route, "task/delete"):
        $routeParts = explode('/', $route);
        $taskId = end($routeParts);
        if (!empty($taskId)) {
            $taskController->delete($taskId);
        } else {
            http_response_code(405);
            echo 'Method Not Allowed "task-delete"';
        }
        break;
        
    case str_contains($route, "task/complete"):
        $routeParts = explode('/', $route);
        $taskId = end($routeParts);
        if (!empty($taskId)) {
            $taskController->complete($taskId);
        } else {
            http_response_code(405);
            echo 'Method Not Allowed "task-complete"';
        }
        break;
    
        
       /****************************profile-router****************************/     
    
    case 'profile':
        if (!isset($_SESSION['user'])) {
            header('Location: /cours/Brief-Todolist/login');
            exit;
        }
        break;

    case str_contains($route, "profile/edit"):
        $routeParts = explode('/', $route);
        $userId = end($routeParts);
        if (!empty($userId)) {
        $errorMessage = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : null;
        $successMessage = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;
        unset($_SESSION['error_message'], $_SESSION['success_message']);
        }
        break;

    case  'profile/update':
        if ($method === 'POST') {
            $user_id = $_POST['user_id'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

        
            $user = new User();
            $user->setUser_id($user_id);
            $user->setFirst_name($first_name);
            $user->setLast_name($last_name);
            $user->setEmail($email);
            $user->setPassword($password);
            $userController->updateProfile($user,$confirmPassword);
        } else {
            http_response_code(405);
            echo 'Method Not Allowed profile_update';
        }
        break;         
    

    case str_contains($route, "profile/delete"):
        $routeParts = explode('/', $route);
        $userId = end($routeParts);
        var_dump($userId);
        if (!empty($userId)) {
            $userController->deleteAccount($userId);
        } else {
            http_response_code(405);
            echo 'Method Not Allowed "task-delete"';
        }
        break;

        case 'register':
            if ($method === 'POST') {
                $user = new User($_POST);
                $confirmPassword = $_POST['confirm_password'];
                $email = $_POST['email'];
                $userController->register($user, $confirmPassword,$email);
            }
            break;
        
        case 'login':
            if ($method === 'POST') {
                $user = new User($_POST);
                $result = $userController->login($user);
        
                if ($result === true) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'error' => $result]);
                }
            }
            break;
    case 'logout':
        $userController->logout();
        break;
 
}