<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/047f41f5d9.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full sm:max-w-md">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">Register</h2>
            <form id="registerForm" class="space-y-6">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <div class="relative">
                        <input id="first_name" name="first_name" type="text" required
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-400 focus:ring-opacity-50">
                        <span
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"><i
                                class="fas fa-user"></i></span>
                    </div>
                </div>

                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <div class="relative">
                        <input id="last_name" name="last_name" type="text" required
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-400 focus:ring-opacity-50">
                        <span
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"><i
                                class="fas fa-user"></i></span>
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="relative">
                        <input id="email" name="email" type="email" required
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-400 focus:ring-opacity-50">
                        <span
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"><i
                                class="fas fa-envelope"></i></span>
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <input id="password" name="password" type="password" required
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-400 focus:ring-opacity-50">
                        <span
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"><i
                                class="fas fa-lock"></i></span>
                    </div>
                </div>

                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm
                        Password</label>
                    <div class="relative">
                        <input id="confirm_password" name="confirm_password" type="password" required
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-400 focus:ring-opacity-50">
                        <span
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"><i
                                class="fas fa-lock"></i></span>
                    </div>
                </div>

                <div>
                    <button name="register" type="submit"
                        class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Register
                    </button>
                </div>
            </form>
            <p class="mt-6 text-center text-sm text-gray-600">
                Already a member? <a href="login" class="font-medium text-indigo-600 hover:text-indigo-500">Login</a>
            </p>
        </div>
    </div>
</body>

</html>
