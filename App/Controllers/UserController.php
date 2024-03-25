<?php
namespace App\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use PDO;

class UserController {
    private $userRepository;

    public function __construct($db) {
        $this->userRepository = new UserRepository($db);
    }
    public function register(User $user, $confirmPassword)
    {
        if ($user->getPassword() !== $confirmPassword) {
            echo json_encode(['error' => 'Passwords do not match']);
            exit;
        }
    
        $existingUser = $this->userRepository->getUserByEmail($user->getEmail());
    
        if ($existingUser) {
            echo json_encode(['error' => 'Email already exists']);
            exit;
        }
    
        $userId = $this->userRepository->createUser($user);
    
        if ($userId) {
            echo json_encode(['success' => true]);
            exit;
        } else {
            echo json_encode(['error' => 'Failed to register user']);
            exit;
        }
    }

public function login(User $user)
{
    $email = $user->getEmail();
    $userDb = $this->userRepository->getUserByEmail($email);

    if ($userDb) {
        if (password_verify($user->getPassword(), $userDb->getPassword())) {
            $_SESSION['user'] = [
                'user_id' => $userDb->getUser_id(),
                'first_name' => $userDb->getFirst_name(),
                'last_name' => $userDb->getLast_name(),
                'email' => $userDb->getEmail(),
            ];

            echo json_encode(['success' => true]);
            exit; 
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid password']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid email']);
    }
}
    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: /cours/Brief-Todolist/login');
        exit();
    }
    
    public function updateProfile(User $user, $confirmPassword)
{
    $userId = $user->getUser_id();
    $existingUser = $this->userRepository->getUserById($userId);

    if (!$existingUser) {
        $_SESSION['error_message'] = 'User not found.';
        header('Location: /cours/Brief-Todolist/profile/edit/' . $userId);
        exit;
    }

    $newEmail = $user->getEmail();
    if ($newEmail !== $existingUser->getEmail()) {
        $emailExistsUser = $this->userRepository->getUserByEmail($newEmail);
        if ($emailExistsUser) {
            $_SESSION['error_message'] = 'Email already exists.';
            header('Location: /cours/Brief-Todolist/profile/edit/' . $userId);
            exit;
        }
    }

    $newPassword = $user->getPassword();
    if ($confirmPassword !== $newPassword) {
        $_SESSION['error_message'] = 'Passwords do not match.';
        header('Location: /cours/Brief-Todolist/profile/edit/' . $userId);
        exit;
    }

    $isUpdated = $this->userRepository->updateUser($user);

    if ($isUpdated) {
        $_SESSION['user'] = [
            'user_id' => $user->getUser_id(),
            'first_name' => $user->getFirst_name(),
            'last_name' => $user->getLast_name(),
            'email' => $user->getEmail(),
        ];
        header('Location: /cours/Brief-Todolist/profile');
        exit;
    } else {
        $_SESSION['error_message'] = 'Failed to update user profile.';
        header('Location: /cours/Brief-Todolist/profile/edit/' . $userId);
        exit;
    }
}
    public function deleteAccount($user_Id)
    {
        $isDeleted = $this->userRepository->deleteUser($user_Id);
    
        if ($isDeleted) {
            unset($_SESSION['user']);
            session_destroy();
            header('Location: /cours/Brief-Todolist/register');
            exit();
        } else {
            error_log("Failed to delete user account with ID: $user_Id"); 
            echo "Failed to delete user account. Please try again later.";
        }
    }
}