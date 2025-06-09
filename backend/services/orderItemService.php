<?php
require_once __DIR__ . '/../dao/OrderItemDAO.php';

class OrderItemService {
    private $dao;

    public function __construct() {
        $this->dao = new OrderItemDAO();
    }

    public function create($order_id, $product_id, $quantity, $price) {
        return $this->dao->create($order_id, $product_id, $quantity, $price);
    }

    public function getAll() {
        return $this->dao->getAll();
    }

    public function getById($id) {
        return $this->dao->getById($id);
    }

    public function update($id, $order_id, $product_id, $quantity, $price) {
        return $this->dao->update($id, $order_id, $product_id, $quantity, $price);
    }

    public function delete($id) {
        return $this->dao->delete($id);
    }
}
?>
