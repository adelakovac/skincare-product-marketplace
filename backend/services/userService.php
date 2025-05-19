<?php
require_once __DIR__ . '/../dao/UserDAO.php';

class UserService {
    private $dao;

    public function __construct() {
        $this->dao = new UserDAO();
    }

    public function getAll() {
        return $this->dao->getAll();
    }

    public function getById($id) {
        return $this->dao->getById($id);
    }

    public function create($name, $email) {
        return $this->dao->create($name, $email);
    }

    public function update($id, $name, $email) {
        return $this->dao->update($id, $name, $email);
    }

    public function delete($id) {
        return $this->dao->delete($id);
    }
}
?>
