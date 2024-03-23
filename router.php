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

    case str_contains($route, "task/edit"):
        $taskId = end($routeParts);
        if (!empty($taskId)) {
            $taskController->edit($taskId);
        } else {
            http_response_code(405);
            echo 'Method Not Allowed "task-edit"';
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
        if (isset($_SESSION['user'])) {
            require_once 'App/Views/profile.php';
        } else {
            header('Location: /cours/Brief-Todolist/login');
            exit;
        }
        break;

    case str_contains($route, "profile/edit"):
        $routeParts = explode('/', $route);
        $userId = end($routeParts);
        if (!empty($userId)) {
        require_once 'App/Views/profile_update.php';
        } 
        break;

    case  'profile/update':
        if ($method === 'POST') {
            $user_id = $_POST['user_id'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
        
            $user = new User();
            $user->setUser_id($user_id);
            $user->setFirst_name($first_name);
            $user->setLast_name($last_name);
            $user->setEmail($email);
            $user->setPassword($password);
            $userController->updateProfile($user);
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
        case 'register':
            if ($method === 'POST') {
                $user = new User($_POST);
                $userController->register($user);
                echo json_encode(['success' => true]);
            } else {
                require_once 'App/Views/register.php';
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
        } else {
            require_once 'App/Views/login.php';
        }
        break;
    case 'logout':
        $userController->logout();
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
            
}