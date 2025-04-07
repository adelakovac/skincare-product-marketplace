<?php
require_once 'Database.php';

class OrderDAO {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    // CREATE
    public function create($user_id, $total_price, $status = 'pending') {
        $stmt = $this->conn->prepare("INSERT INTO orders (user_id, total_price, status) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $total_price, $status]);
        return $this->conn->lastInsertId();
    }

    // READ all
    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM orders");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ one
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $user_id, $total_price, $status) {
        $stmt = $this->conn->prepare("UPDATE orders SET user_id = ?, total_price = ?, status = ? WHERE id = ?");
        return $stmt->execute([$user_id, $total_price, $status, $id]);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM orders WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
