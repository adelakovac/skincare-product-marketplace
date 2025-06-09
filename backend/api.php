<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/middleware/AuthMiddleware.php';

Flight::route('GET /', function() {
    echo "API server is running!";
});


Flight::route('POST /register', function() {
    $data = Flight::request()->data->getData();
    $userService = new UserService();

    $result = $userService->register($data);
    if ($result) {
        Flight::json(['message' => 'User registered', 'id' => $result]);
    } else {
        Flight::json(['message' => 'Registration failed'], 400);
    }
});

Flight::route('POST /login', function() {
    $data = Flight::request()->data->getData();
    $userService = new UserService();

    $user = $userService->login($data['email'] ?? '', $data['password'] ?? '');
    if ($user) {
        $token = AuthMiddleware::generateToken($user);
        Flight::json(['token' => $token]);
    } else {
        Flight::json(['message' => 'Login failed'], 401);
    }
});

Flight::route('GET /profile', function() {
    AuthMiddleware::authenticate();
    $user = Flight::get('user');
    Flight::json(['profile' => $user]);
});

Flight::start();
