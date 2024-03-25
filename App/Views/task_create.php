<form action="/cours/Brief-Todolist/task/store" method="post" class="space-y-6">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title:</label>
        <input type="text" name="title" id="title" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" placeholder="Enter task title">
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description:</label>
        <textarea name="description" id="description" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" placeholder="Enter task description"></textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="dueto" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due Date:</label>
            <input type="date" name="dueto" id="dueto" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
        </div>

        <div>
            <label for="priority_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority:</label>
            <select name="priority_id" id="priority_id" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                <?php foreach ($priorities as $priority): ?>
                    <option value="<?= $priority->getPriority_id() ?>">
                        <?= $priority->getName() ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div>
        <input type="hidden" name="user_id" value="<?= $_SESSION['user']['user_id'] ?>">
    </div>

    <div>
        <label for="categories" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categories:</label>
        <select name="categories[]" id="categories" multiple required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category->getCategory_id() ?>">
                    <?= $category->getName() ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button name="create-task" class="w-full flex justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-500 dark:hover:bg-indigo-600" type="submit">
        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Create Task
    </button>
</form>