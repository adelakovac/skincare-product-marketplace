<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware {
    private static $secret_key = "tajni_kljuc_za_jwt";  // promijeni ako želiš

    public static function authenticate() {
        $headers = getallheaders();
        if (!isset($headers['Authorization'])) {
            http_response_code(401);
            echo json_encode(['message' => 'Authorization header missing']);
            exit;
        }

        $token = str_replace('Bearer ', '', $headers['Authorization']);
        try {
            $decoded = JWT::decode($token, new Key(self::$secret_key, 'HS256'));
            Flight::set('user', (array)$decoded);
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(['message' => 'Invalid token: ' . $e->getMessage()]);
            exit;
        }
    }

    public static function generateToken($user) {
        $payload = [
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24), // 24 sata
            'id' => $user['id'],
            'email' => $user['email'],
            'role' => $user['role']
        ];
        return JWT::encode($payload, self::$secret_key, 'HS256');
    }
}
