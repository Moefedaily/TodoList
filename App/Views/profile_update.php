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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/047f41f5d9.js" crossorigin="anonymous"></script>

</head>
<body class="bg-gray-100">
    <div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded shadow-md">
        <h1 class="text-2xl font-semibold mb-6 text-center text-gray-800">
            <i class="fas fa-user-edit mr-2"></i> Edit Profile
        </h1>         <?php if ($errorMessage): ?>
            <div id="error-message" class="text-red-500  text-center"> 
                <?php echo $errorMessage; ?></div>
                <?php endif; ?>
                <?php if ($successMessage): ?>
                <div class="success-message" class="text-green-500 " text-center>
                <?php echo $successMessage; ?></div>
        <?php endif; ?>

        <form method="post" action="/cours/Brief-Todolist/profile/update" class="space-y-4">
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $user->getUser_id(); ?>">

            <div>
                <label for="first_name" class="block text-gray-700 font-semibold mb-2">First Name:</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo $user->getFirst_name(); ?>" class="w-full rounded-md border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
            </div>

            <div>
                <label for="last_name" class="block text-gray-700 font-semibold mb-2">Last Name:</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo $user->getLast_name(); ?>" class="w-full rounded-md border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $user->getEmail(); ?>" class="w-full rounded-md border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password:</label>
                <input type="password" id="password" name="password" class="w-full rounded-md border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
            </div>

            <div>
                <label for="confirm_password" class="block text-gray-700 font-semibold mb-2">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" class="w-full rounded-md border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition-colors duration-300 flex items-center justify-center">
                <i class="fas fa-save mr-2"></i> Update Profile
            </button>
        </form>
    </div>
</body>
</html>


