<?php
require_once __DIR__ . '/../dao/MessagesDAO.php';
require_once __DIR__ . '/../config/db.php'; // Ovo je fajl gdje konektuješ bazu

class MessagesService {
    private $messagesDao;

    public function __construct($db) {
        $this->messagesDao = new MessagesDAO($db);
    }

    public function getAllMessages() {
        return $this->messagesDao->getAllMessages();
    }

    public function getMessageById($id) {
        return $this->messagesDao->getMessageById($id);
    }

    public function getMessagesByUserId($userId) {
        return $this->messagesDao->getMessagesByUserId($userId);
    }

    public function getMessagesByProductId($productId) {
        return $this->messagesDao->getMessagesByProductId($productId);
    }

    public function addMessage($userId, $productId, $message) {
        return $this->messagesDao->addMessage($userId, $productId, $message);
    }

    public function deleteMessage($id) {
        return $this->messagesDao->deleteMessage($id);
    }
}
?>
