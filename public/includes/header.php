<?php
$loggedIn = isset($_SESSION['user']);
$userName = $loggedIn ? $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/cours/Brief-Todolist/App/Views/css/style.css">
    <title>Todo App</title>
</head>
<body>
    <header class="bg-gray-800 text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/cours/Brief-Todolist" class="text-xl font-bold">Todo App</a>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="/cours/Brief-Todolist/task" class="hover:text-gray-300">Tasks</a></li>
                    <?php if ($loggedIn): ?>
                        <li><a href="/cours/Brief-Todolist/profile" class="hover:text-gray-300">Profile</a></li>
                        <li><a href="/cours/Brief-Todolist/logout" class="hover:text-gray-300">Logout</a></li>
                    <?php else: ?>
                        <li><a href="/cours/Brief-Todolist/login" class="hover:text-gray-300">Login</a></li>
                        <li><a href="/cours/Brief-Todolist/register" class="hover:text-gray-300">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container mx-auto py-8">