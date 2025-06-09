<?php
require_once __DIR__ . '/../dao/WishlistDAO.php';

class WishlistService {
    private $dao;

    public function __construct() {
        $this->dao = new WishlistDAO();
    }

    public function getAll() {
        return $this->dao->getAll();
    }

    public function getById($id) {
        return $this->dao->getById($id);
    }

    public function create($user_id, $product_id) {
        return $this->dao->create($user_id, $product_id);
    }

    public function update($id, $user_id, $product_id) {
        return $this->dao->update($id, $user_id, $product_id);
    }

    public function delete($id) {
        return $this->dao->delete($id);
    }
}
?>
