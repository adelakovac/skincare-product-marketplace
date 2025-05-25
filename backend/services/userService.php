<?php
require_once __DIR__ . '/../dao/UserDAO.php';

class UserService {
    private $userDAO;

    public function __construct() {
        $this->userDAO = new UserDAO();
    }

    public function register($data) {
        if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
            return false;
        }
        return $this->userDAO->create(
            $data['name'],
            $data['email'],
            $data['password'],
            $data['role'] ?? 'user'
        );
    }

    public function login($email, $password) {
        $user = $this->userDAO->getByEmail($email);
        if (!$user) return false;

        if (password_verify($password, $user['password'])) {
            unset($user['password']);
            return $user;
        }
        return false;
    }
}
?>
