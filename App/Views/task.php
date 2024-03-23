<?php
require_once __DIR__ . '/../../init.php';

use App\Repositories\PriorityRepository;
use App\Repositories\TaskRepository;

if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['user_id'];
    $tasksRepo = new TaskRepository();
    $priorityRepo = new PriorityRepository();
    $tasks = $tasksRepo->getTasksByUserId($user_id);
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

    <a href="/cours/Brief-Todolist/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block mb-2">Create New Task</a>
    <a href="/cours/Brief-Todolist/profile" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-block mb-2">Profile</a>

    <ul class="space-y-4">
        <?php foreach ($tasks as $task): ?>
            <li class="border border-gray-200 p-4 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2"><?php echo $task->getTitle(); ?></h3>
                <p class="text-gray-700 mb-2"><?php echo $task->getDescription(); ?></p>
                <p class="text-gray-700 mb-2">Due Date: <?php echo $task->getDueto(); ?></p>
                <p class="text-gray-700 mb-2">Priority: <?php echo $priorityRepo->getPriorityNameById($task->getPriority_id()); ?></p>
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
</html>
