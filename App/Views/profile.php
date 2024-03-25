<?php

use App\Models\User;
require_once __DIR__ . "/../Models/User.php";
if (isset($_SESSION["user"])) {
    $userData = $_SESSION["user"];
    $user = new User();
    $user->setUser_id($userData["user_id"]);
    $user->setFirst_name($userData["first_name"]);
    $user->setLast_name($userData["last_name"]);
    $user->setEmail($userData["email"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/047f41f5d9.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen items-center justify-center">
        <div class="max-w-md w-full bg-white rounded-lg shadow-lg">
            <div class="p-8">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Profile</h2>
                <div class="mb-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-user text-gray-600 mr-3"></i>
                        <p class="text-lg text-gray-700"><span class="font-semibold">First Name:</span> <?php echo $user->getFirst_name(); ?></p>
                    </div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-user text-gray-600 mr-3"></i>
                        <p class="text-lg text-gray-700"><span class="font-semibold">Last Name:</span> <?php echo $user->getLast_name(); ?></p>
                    </div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-envelope text-gray-600 mr-3"></i>
                        <p class="text-lg text-gray-700"><span class="font-semibold">Email:</span> <?php echo $user->getEmail(); ?></p>
                    </div>
                </div>
                <div class="flex justify-center">
                    <a href="/cours/Brief-Todolist/profile/edit/<?php echo $user->getUser_id(); ?>" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-full text-lg font-semibold mr-4 flex items-center">
                        <i class="fas fa-user-edit mr-2"></i> Edit Profile
                    </a>
                    <a href="/cours/Brief-Todolist/profile/delete/<?php echo $user->getUser_id(); ?>" class="bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded-full text-lg font-semibold flex items-center" onclick="return confirm('Are you sure you want to delete your account?')">
                        <i class="fas fa-trash-alt mr-2"></i> Delete Account
                    </a>
                </div>
            </div>
            <div class="p-4 bg-gray-100 text-center">
                <a href="/cours/Brief-Todolist/logout" class="text-lg text-blue-600 font-semibold hover:underline">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </div>
    </div>
</body>
</html>
