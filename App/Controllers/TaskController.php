<?php
namespace App\Controllers;
use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\PriorityRepository;
use App\Repositories\UserRepository;

class TaskController
{
    private $taskRepository;
    private $categoryRepository;
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
        $this->taskRepository = new TaskRepository($db);
        $this->categoryRepository = new CategoryRepository();
    }

    public function index()
    {
        $tasks = $this->taskRepository->getAllTasks();
        require_once __DIR__ . '/../Views/task.php';
        
    }

    public function create()
    {
        $categories = $this->categoryRepository->getAllCategories();
        require_once __DIR__ . '/../Views/task_create.php';
    }

    public function store(Task $task, array $categoryIds)
    {
        if ($this->taskRepository->createTask($task,$categoryIds)) {
            $taskId = $this->db->lastInsertId(); 
            $this->taskRepository->assignCategoriesToTask($taskId, $categoryIds); 
            echo " <br> Controller:Task added successfully! <br>";
            header('Location: /cours/Brief-Todolist/task'
        );
            exit();
        } else {
            echo "controller: Error adding Task.";
        }
    }

    

        public function edit($id)
    {
        $taskRepository = new TaskRepository();
        $task = $taskRepository->getTaskById($id);

        $userRepository = new UserRepository();
        $userId = $task->getUser_id();
        $user = $userRepository->getUserById($userId);

        $priorityRepository = new PriorityRepository();
        $priorities = $priorityRepository->getAllPriorities();

        $categories = $this->categoryRepository->getAllCategories();
        $taskCategories = $taskRepository->getTaskCategories($id);

        require_once __DIR__ . '/../Views/task_edit.php';
    }

    public function update(Task $task, array $categoryIds)
    {
    $taskData = $this->taskRepository->getTaskById($task->getTask_id());

    $taskArray = [
        'task_id' => $taskData->getTask_id(),
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'dueto' => $_POST['dueto'],
        'completed' => isset($_POST['completed']) ? 1 : 0,
        'priority_id' => $_POST['priority_id'],
        'user_id' => $_POST['user_id']
    ];

        $task = new Task($taskArray);

        $this->taskRepository->updateTask($task);
        $this->taskRepository->assignCategoriesToTask($task->getTask_id(), $categoryIds);
        header('Location:/cours/Brief-Todolist/task ');
    }

    public function complete($task_id)
    {
        $task = $this->taskRepository->getTaskById($task_id);
        if ($task) {
            $task->setCompleted(true);
            $this->taskRepository->updateTask($task);
        }
        header('Location: /cours/Brief-Todolist/task');
        exit();
    }

    public function delete($task_id)
    {
        $this->taskRepository->deleteTask($task_id);
        header('Location:/cours/Brief-Todolist/task ');
        ;
    }
}