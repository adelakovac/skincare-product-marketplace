<?php
require_once __DIR__ . '/../services/userService.php';

class UserController {
    private $service;

    public function __construct() {
        $this->service = new UserService();
    }

    public function register() {
        $data = Flight::request()->data->getData();

        // Simple validation
        if (!isset($data['name'], $data['email'], $data['password'])) {
            Flight::json(['error' => 'Name, email and password are required'], 400);
            return;
        }

        $existingUser = $this->service->getByEmail($data['email']);
        if ($existingUser) {
            Flight::json(['error' => 'Email already registered'], 409);
            return;
        }

        $userId = $this->service->register($data);

        if ($userId) {
            Flight::json(['message' => 'User registered successfully', 'id' => $userId], 201);
        } else {
            Flight::json(['error' => 'Registration failed'], 500);
        }
    }

    public function login() {
        $data = Flight::request()->data->getData();

        if (!isset($data['email'], $data['password'])) {
            Flight::json(['error' => 'Email and password are required'], 400);
            return;
        }

        $user = $this->service->getByEmail($data['email']);

        if (!$user || !password_verify($data['password'], $user['password'])) {
            Flight::json(['error' => 'Invalid email or password'], 401);
            return;
        }

        session_start();
        // Save user info in session except password
        unset($user['password']);
        $_SESSION['user'] = $user;

        Flight::json(['message' => 'Login successful', 'user' => $user]);
    }

    public function logout() {
        session_start();
        session_destroy();
        Flight::json(['message' => 'Logged out']);
    }

    // Other user CRUD methods here...
}
?>

