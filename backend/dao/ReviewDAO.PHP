<?php
require_once 'Database.php';

class ReviewDAO {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    // CREATE
    public function create($user_id, $product_id, $rating, $comment) {
        $stmt = $this->conn->prepare("INSERT INTO reviews (user_id, product_id, rating, comment) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $product_id, $rating, $comment]);
        return $this->conn->lastInsertId();
    }

    // READ all
    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM reviews");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ one
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $user_id, $product_id, $rating, $comment) {
        $stmt = $this->conn->prepare("UPDATE reviews SET user_id = ?, product_id = ?, rating = ?, comment = ? WHERE id = ?");
        return $stmt->execute([$user_id, $product_id, $rating, $comment, $id]);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM reviews WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
