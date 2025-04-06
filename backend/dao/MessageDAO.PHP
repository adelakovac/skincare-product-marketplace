<?php
class MessagesDAO {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all messages
    public function getAllMessages() {
        $query = "SELECT * FROM messages";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch message by ID
    public function getMessageById($id) {
        $query = "SELECT * FROM messages WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fetch messages for a specific user
    public function getMessagesByUserId($user_id) {
        $query = "SELECT * FROM messages WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch messages for a specific product
    public function getMessagesByProductId($product_id) {
        $query = "SELECT * FROM messages WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insert a new message
    public function addMessage($user_id, $product_id, $message) {
        $query = "INSERT INTO messages (user_id, product_id, message) 
                  VALUES (:user_id, :product_id, :message)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
        $stmt->bindParam(":message", $message);
        return $stmt->execute();
    }

    // Delete a message
    public function deleteMessage($id) {
        $query = "DELETE FROM messages WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
