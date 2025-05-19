<?php
require_once __DIR__ . '/../dao/OrderDAO.php';

class OrderService {
    private $dao;

    public function __construct() {
        $this->dao = new OrderDAO();
    }

    public function create($user_id, $total_price, $status = 'pending') {
        return $this->dao->create($user_id, $total_price, $status);
    }

    public function getAll() {
        return $this->dao->getAll();
    }

    public function getById($id) {
        return $this->dao->getById($id);
    }

    public function update($id, $user_id, $total_price, $status) {
        return $this->dao->update($id, $user_id, $total_price, $status);
    }

    public function delete($id) {
        return $this->dao->delete($id);
    }
}
?>
