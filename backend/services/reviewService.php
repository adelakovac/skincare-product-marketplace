<?php
require_once __DIR__ . '/../dao/ReviewDAO.php';

class ReviewService {
    private $dao;

    public function __construct() {
        $this->dao = new ReviewDAO();
    }

    public function getAll() {
        return $this->dao->getAll();
    }

    public function getById($id) {
        return $this->dao->getById($id);
    }

    public function create($user_id, $product_id, $rating, $comment) {
        return $this->dao->create($user_id, $product_id, $rating, $comment);
    }

    public function update($id, $user_id, $product_id, $rating, $comment) {
        return $this->dao->update($id, $user_id, $product_id, $rating, $comment);
    }

    public function delete($id) {
        return $this->dao->delete($id);
    }
}
?>
