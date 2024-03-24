<?php
require_once __DIR__ . '/../../init.php';

use App\Repositories\CategoryRepository;
use App\Repositories\TaskRepository;
use App\Repositories\PriorityRepository;
use App\Repositories\UserRepository;

$route = str_replace('/cours/Brief-Todolist/', '', $_SERVER['REQUEST_URI']);
$routeParts = explode('/', $route);
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
</head>
<body>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Edit Task</h2>
        </div>
        <form class="space-y-6" action="/cours/Brief-Todolist/task/update" method="post">

             <input type="hidden" name="task_id" value="<?php echo $task->getTask_id(); ?>">
            <div>
                <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Task Title</label>
                <div class="mt-2">
                    <input id="title" name="title" type="text" value="<?php echo $task->getTitle(); ?>" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                </div>
                <div class="mt-2">
                    <textarea id="description" name="description" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?php echo $task->getDescription(); ?></textarea>
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="dueto" class="block text-sm font-medium leading-6 text-gray-900">Due Date</label>
                </div>
                <div class="mt-2">
                    <input id="dueto" name="dueto" type="date" value="<?php echo $task->getDueto(); ?>" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>

            <div>

                <div class="mt-2">
                <input type="hidden" name="task_id" value="<?php echo $task->getTask_id(); ?>">
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between">
                    <label for="priority_id" class="block text-sm font-medium leading-6 text-gray-900">Priority</label>
                </div>
            <div class="mt-2">
              <select id="priority_id" name="priority_id" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <?php if (!empty($priorities)): ?>
                      <?php foreach ($priorities as $priority): ?>
                        <option value="<?php echo $priority->getPriority_id(); ?>"
                         <?php echo ($task->getPriority_id() == $priority->getPriority_id()) ?
                          'selected' : ''; ?>>
                         <?php echo $priority->getName(); ?>
                         </option>
                <?php endforeach; ?>
                 <?php else: ?>
                    <option value="">No priorities available</option>
                <?php endif; ?>
                </select>
            </div>
                <div>
    <div class="flex items-center justify-between">
        <label for="categories" class="block text-sm font-medium leading-6 text-gray-900">Categories</label>
    </div>
    <div class="mt-2">
        <select id="categories" name="categories[]" multiple required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            <?php
           
           foreach ($categories as $category) {
               $selected = in_array($category->getCategory_id(),// to change
                array_column($taskCategories, 'category_id')); //using array_column to get the category id
               $selectedAttr = $selected ? 'selected' : '';
               echo '<option value="' . $category->getCategory_id() 
               . '" ' . $selectedAttr . '>' . $category->getName() . '</option>';
           }
           
            ?>
        </select>
    </div>
</div>

            </div>
            <div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="user_id" class="block text-sm font-medium leading-6 text-gray-900"><?php echo $user->getFirst_name(); ?></label>
                </div>
                <div class="mt-2">
                <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                </div>
            </div>
            </div>
            <div>
                <div class="flex items-center justify-between">
                    <label for="completed" class="block text-sm font-medium leading-6 text-gray-900">Completed</label>
                </div>
                <div class="mt-2">
                    <input id="completed" name="completed" type="checkbox" <?php echo $task->getCompleted() ? 'checked' : ''; ?> class="rounded-md focus:ring-indigo-600">
                </div>
            </div>

            <div>
                <button type="submit" name="update-task" class="mt-4 flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update Task</button>
            </div>
        </form>
    </div>

</body>
<script src="https://cdn.tailwindcss.com"></script>
</html>