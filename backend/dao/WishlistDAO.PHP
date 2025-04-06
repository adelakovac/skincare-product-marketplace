<?php
require_once 'Database.php';

class WishlistDAO {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    // CREATE
    public function create($user_id, $product_id) {
        $stmt = $this->conn->prepare("INSERT INTO wishlists (user_id, product_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $product_id]);
        return $this->conn->lastInsertId();
    }

    // READ all
    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM wishlists");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ one
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM wishlists WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $user_id, $product_id) {
        $stmt = $this->conn->prepare("UPDATE wishlists SET user_id = ?, product_id = ? WHERE id = ?");
        return $stmt->execute([$user_id, $product_id, $id]);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM wishlists WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
