
        <form action="/cours/Brief-Todolist/task/store" method="post">
                <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                <input type="text" name="title" id="title" required
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                <textarea name="description" id="description" required
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
            </div>

            <div class="mb-4">
                <label for="dueto" class="block text-sm font-medium text-gray-700">Due Date:</label>
                <input type="date" name="dueto" id="dueto" required
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="priority_id" class="block text-sm font-medium text-gray-700">Priority:</label>
                <select name="priority_id" id="priority_id" required
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    <?php foreach ($priorities as $priority): ?>
                    <option value="<?= $priority->getPriority_id() ?>">
                        <?= $priority->getName() ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4 flex items-center">
                <input type="checkbox" name="completed" id="completed" value="1"
                    class="mr-2 focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                <label for="completed" class="text-sm font-medium text-gray-700">Mark as completed</label>
            </div>

            <div class="mb-4">
                <input type="hidden" name="user_id" value="<?= $_SESSION['user']['user_id'] ?>">
            </div>
            <div class="mb-4">
    <label for="categories" class="block text-sm font-medium text-gray-700">Categories:</label>
    <select name="categories[]" id="categories" multiple required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        <?php
     
        foreach ($categories as $category):?> 
            <option value="<?= $category->getCategory_id()?>"> 
            <?= $category->getName()?>
             </option>
       <?php endforeach; ?>
    </select>
</div>
            <button name="create-task"
                class="w-full px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                type="submit">Create Task</button>
        </form>
    
