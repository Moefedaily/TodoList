<?php
require_once __DIR__ . '/../../init.php';

use App\Repositories\CategoryRepository;
use App\Repositories\PriorityRepository;
use App\Repositories\TaskRepository;

if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['user_id'];
    $tasksRepo = new TaskRepository();
    $priorityRepository = new PriorityRepository();
    $tasks = $tasksRepo->getTasksByUserId($user_id);
    $priorities = $priorityRepository->getAllPriorities();
    $categoryRepository = new CategoryRepository();
    $categories = $categoryRepository->getAllCategories();
} else {
    header("Location: /cours/Brief-Todolist/App/Views/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
</head>
<body class="bg-gray-100">
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Todo List</h1>

    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4" data-modal-toggle="create-task-modal">
        Create New Task
    </button>

    <div id="create-task-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">Create New Task</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-target="create-task-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                    <?php include 'task_create.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <ul class="space-y-4">
        <?php foreach ($tasks as $task): ?>
            <li class="border border-gray-200 p-4 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2"><?php echo $task->getTitle(); ?></h3>
                <p class="text-gray-700 mb-2"><?php echo $task->getDescription(); ?></p>
                <p class="text-gray-700 mb-2">Due Date: <?php echo $task->getDueto(); ?></p>
                <p class="text-gray-700 mb-2">Priority: <?php echo $priorityRepository->getPriorityNameById($task->getPriority_id()); ?></p>
                <p class="text-gray-700 mb-2">Completed: <?php echo $task->getCompleted() ? 'Completed' : 'In progress'; ?></p>
                <a href="/cours/Brief-Todolist/task/edit/<?php echo $task->getTask_id(); ?>" class="text-blue-700 hover:text-blue-950 mr-2">Edit</a>
                <a href="/cours/Brief-Todolist/task/delete/<?php echo $task->getTask_id(); ?>" class="text-red-700 hover:text-red-950 mr-2">Delete</a>
                <?php if (!$task->getCompleted()): ?>
                    <a href="/cours/Brief-Todolist/task/complete/<?php echo $task->getTask_id(); ?>"class="text-green-700 hover:text-orange-950 mr-2" onclick="return confirm('Are you sure you want to mark this task as completed?')">Mark as Completed</a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
</body>
<script src="https://cdn.tailwindcss.com"></script>
<script src="App/Views/js/script.js"></script>
</html>