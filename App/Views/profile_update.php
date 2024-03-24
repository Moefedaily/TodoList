<?php
require_once __DIR__ . '/../../init.php';
use App\Models\User;

if (isset($_SESSION['user'])) {
    $userData = $_SESSION['user'];
    $user = new User();
    $user->setUser_id($userData['user_id']);
    $user->setFirst_name($userData['first_name']);
    $user->setLast_name($userData['last_name']);
    $user->setEmail($userData['email']);
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body class="bg-gray-100">
    <div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded shadow-md">
        <h1 class="text-2xl font-semibold mb-6">Edit Profile</h1>
         <?php if ($errorMessage): ?>
            <div id="error-message" class="text-red-500  text-center"> 
                <?php echo $errorMessage; ?></div>
                <?php endif; ?>
                <?php if ($successMessage): ?>
                <div class="success-message" class="text-green-500 " text-center>
                <?php echo $successMessage; ?></div>
        <?php endif; ?>

        <form method="post" action="/cours/Brief-Todolist/profile/update">
        <input type="hidden" id="user_id" name="user_id" value="<?php echo $user->getUser_id(); ?>">
            
            <label for="first_name" class="block mb-2">First Name:</label>
            <input type="text"  id="first_name" name="first_name" value="<?php echo $user->getFirst_name(); ?>" class="w-full rounded-md border-gray-300 py-2 px-3 mb-4">
            
            <label for="last_name" class="block mb-2">Last Name:</label>
            <input type="text" id="last"name="last_name" value="<?php echo $user->getLast_name(); ?>" class="w-full rounded-md border-gray-300 py-2 px-3 mb-4">
            
            <input type="hidden"id="email" name="email" value="<?php echo $user->getEmail(); ?>" class="w-full rounded-md border-gray-300 py-2 px-3 mb-4">
            
            <label for="password" class="block mb-2">Password:</label>
            <input type="password" id="passwors" name="password" class="w-full rounded-md border-gray-300 py-2 px-3 mb-4">
            <label for="confirm_password" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
            <input id="confirm_password" name="confirm_password" type="password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 indent-3">
            <button type="submit"  class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-500">Update Profile</button>
        </form>
    </div>
</body>
<script src="https://cdn.tailwindcss.com"></script>
</html>

