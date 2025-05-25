<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload za JWT

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require_once __DIR__ . '/../services/UserService.php';


class AuthController {
    public static function login() {
        $data = Flight::request()->data;
        $email = $data['email'];
        $password = $data['password'];

        $user = UserService::getUserByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            Flight::halt(401, 'Invalid email or password');
        }

        $secret_key = 'tajni_kljuc'; // Prebaci u .env ako želiš veću sigurnost

        $payload = [
            "id" => $user['id'],
            "email" => $user['email'],
            "exp" => time() + 3600 // Token vrijedi 1 sat
        ];

        $jwt = JWT::encode($payload, $secret_key, 'HS256');

        Flight::json(["token" => $jwt]);
    }
}

