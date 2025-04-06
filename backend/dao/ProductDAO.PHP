<?php
require_once 'Database.php';

class ProductDAO {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    // CREATE - Dodaj novi proizvod
    public function create($name, $description, $price, $image_url) {
        $stmt = $this->conn->prepare("INSERT INTO products (name, description, price, image_url) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $description, $price, $image_url]);
        return $this->conn->lastInsertId();
    }

    // READ - Dohvati sve proizvode
    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ - Dohvati proizvod po ID-u
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE - Ažuriraj proizvod
    public function update($id, $name, $description, $price, $image_url) {
        $stmt = $this->conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, image_url = ? WHERE id = ?");
        return $stmt->execute([$name, $description, $price, $image_url, $id]);
    }

    // DELETE - Izbriši proizvod
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
