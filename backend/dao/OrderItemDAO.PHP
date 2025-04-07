<?php
require_once 'Database.php';

class OrderItemDAO {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    // CREATE
    public function create($order_id, $product_id, $quantity, $price) {
        $stmt = $this->conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $product_id, $quantity, $price]);
        return $this->conn->lastInsertId();
    }

    // READ all
    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM order_items");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ one
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM order_items WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $order_id, $product_id, $quantity, $price) {
        $stmt = $this->conn->prepare("UPDATE order_items SET order_id = ?, product_id = ?, quantity = ?, price = ? WHERE id = ?");
        return $stmt->execute([$order_id, $product_id, $quantity, $price, $id]);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM order_items WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
