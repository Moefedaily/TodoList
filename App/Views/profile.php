<?php

use App\Models\User;
require_once __DIR__ . '/../Models/User.php';
if (isset($_SESSION['user'])) {
    $userData = $_SESSION['user'];
    $user = new User();
    $user->setUser_id($userData['user_id']);
    $user->setFirst_name($userData['first_name']);
    $user->setLast_name($userData['last_name']);
    $user->setEmail($userData['email']);

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="flex min-h-screen items-center justify-center bg-gray-100">
            <div class="max-w-md w-full space-y-8 p-8 bg-white rounded-lg shadow-lg">
                <div>
                    <h2 class="text-3xl font-bold text-center text-gray-800">Profile</h2>
                </div>
                <div class="mt-6">
                    <p class="text-lg text-gray-800"><span class="font-bold">First Name:</span> <?php echo $user->getFirst_name(); ?></p>
                    <p class="text-lg text-gray-800"><span class="font-bold">Last Name:</span> <?php echo $user->getLast_name(); ?></p>
                    <p class="text-lg text-gray-800"><span class="font-bold">Email:</span> <?php echo $user->getEmail(); ?></p>
                </div>
                <div class="mt-6">
                <a href="/cours/Brief-Todolist/logout" class="text-lg text-blue-600 font-semibold hover:underline">Logout</a>
                <a class="text-lg text-blue-600 font-semibold hover:underline" href="/cours/Brief-Todolist/profile/edit/<?php echo $user->getUser_id(); ?>">Edit Profile</a>
                <a href="/cours/Brief-Todolist/profile/delete/<?php echo $user->getUser_id(); ?>" class="ml-4 text-red-600 hover:text-red-500" onclick="return confirm('Are you sure you want to delete your account?')">Delete Account</a>                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="flex min-h-screen items-center justify-center bg-gray-100">
            <div class="max-w-md w-full space-y-8 p-8 bg-white rounded-lg shadow-lg">
                <div>
                    <h2 class="text-3xl font-bold text-center text-gray-800">Profile</h2>
                </div>
                <p class="text-lg text-red-500 text-center">User not found. Please login.</p>
                <div class="mt-6">
                    <a href="cours/Brief-Todolist/login" class="text-lg text-blue-600 font-semibold hover:underline">Login</a>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
}
?>