<?php

require_once __DIR__ . '/../init.php';
 include 'includes/header.php'; 
 ?>

<div class="content-wrapper">
    <?php
    $route = str_replace('/cours/Brief-Todolist/', '', $_SERVER['REQUEST_URI']);
    $routeParts = explode('/', $route);
    $id = end($routeParts);

    switch ($route) {
        case '':
            include __DIR__ . '../../App/Views/task.php';
            break;
        case 'register':
            include __DIR__ . '../../App/Views/register.php';
            break;
        case 'login':
            include __DIR__ . '../../App/Views/login.php';
            break;
        case 'task':
            include __DIR__ . '../../App/Views/task.php';
            break;
        case 'task/edit/'.$id:
            include __DIR__ . '../../App/Views/task_edit.php';
            break;
        case 'profile':
            include __DIR__ . '../../App/Views/profile.php';
            break;
        case 'profile/edit/'.$id:
            include __DIR__ . '../../App/Views/profile_update.php';
            break;
        default:
            include __DIR__ . '../../App/Views/task.php';
            break;
    }
    ?>
</div>
<?php include 'includes/footer.php'; ?> 
