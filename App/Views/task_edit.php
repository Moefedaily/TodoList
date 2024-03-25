<?php
require_once __DIR__ . "/../../init.php";

use App\Repositories\CategoryRepository;
use App\Repositories\TaskRepository;
use App\Repositories\PriorityRepository;
use App\Repositories\UserRepository;

$route = str_replace("/cours/Brief-Todolist/", "", $_SERVER["REQUEST_URI"]);
$routeParts = explode("/", $route);
$taskId = end($routeParts);
if ($taskId) {
    $taskRepository = new TaskRepository();
    $task = $taskRepository->getTaskById($taskId);
    $userRepository = new UserRepository();
    $userId = $task->getUser_id();
    $user = $userRepository->getUserById($userId);
    $priorityRepository = new PriorityRepository();
    $priorities = $priorityRepository->getAllPriorities();
    $categoryRepository = new CategoryRepository();
    $categories = $categoryRepository->getAllCategories();
    $taskCategories = $taskRepository->getTaskCategories($task->getTask_id());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/047f41f5d9.js" crossorigin="anonymous"></script>

</head>
<body>

<div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                <i class="fas fa-edit mr-2"></i> Edit Task
            </h2>
        </div>
        <form class="space-y-6" action="/cours/Brief-Todolist/task/update" method="post">
            <input type="hidden" name="task_id" value="<?php echo $task->getTask_id(); ?>">

            <div>
                <label for="title" class="block text-gray-700 font-semibold mb-2">Task Title</label>
                <input id="title" name="title" type="text" value="<?php echo $task->getTitle(); ?>" required class="w-full rounded-md border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-600" placeholder="Enter task title">
            </div>

            <div>
                <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea id="description" name="description" required class="w-full rounded-md border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-600" placeholder="Enter task description"><?php echo $task->getDescription(); ?></textarea>
            </div>

            <div>
                <label for="dueto" class="block text-gray-700 font-semibold mb-2">Due Date</label>
                <input id="dueto" name="dueto" type="date" value="<?php echo $task->getDueto(); ?>" required class="w-full rounded-md border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-600">
            </div>

            <div>
                <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
            </div>

            <div>
                <label for="priority_id" class="block text-gray-700 font-semibold mb-2">Priority</label>
                <select id="priority_id" name="priority_id" required class="w-full rounded-md border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    <?php if (!empty($priorities)): ?>
                        <?php foreach ($priorities as $priority): ?>
                            <option value="<?php echo $priority->getPriority_id(); ?>" <?php echo $task->getPriority_id() == $priority->getPriority_id() ? "selected" : ""; ?>>
                                <?php echo $priority->getName(); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">No priorities available</option>
                    <?php endif; ?>
                </select>
            </div>

            <div>
                <label for="categories" class="block text-gray-700 font-semibold mb-2">Categories</label>
                <select id="categories" name="categories[]" multiple required class="w-full rounded-md border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    <?php foreach ($categories as $category): ?>
                        <?php
                        $selected = in_array($category->getCategory_id(), array_column($taskCategories, "category_id"));
                        $selectedAttr = $selected ? "selected" : "";
                        ?>
                        <option value="<?php echo $category->getCategory_id(); ?>" <?php echo $selectedAttr; ?>>
                            <?php echo $category->getName(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="flex items-center">
                <label for="completed" class="text-gray-700 font-semibold mr-2">Completed</label>
                <input id="completed" name="completed" type="checkbox" <?php echo $task->getCompleted() ? "checked" : ""; ?> class="rounded-md focus:ring-indigo-600">
            </div>

            <button type="submit" name="update-task" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition-colors duration-300 flex items-center justify-center">
                <i class="fas fa-save mr-2"></i> Update Task
            </button>
        </form>
    </div>
</body>
</html>