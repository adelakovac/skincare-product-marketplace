<?php
require_once __DIR__ . '/../dao/ProductDAO.php';

class ProductService {
    private $dao;

    public function __construct() {
        $this->dao = new ProductDAO();
    }

    public function getAll() {
        return $this->dao->getAll();
    }

    public function getById($id) {
        return $this->dao->getById($id);
    }

    public function create($name, $description, $price, $image_url) {
        return $this->dao->create($name, $description, $price, $image_url);
    }

    public function update($id, $name, $description, $price, $image_url) {
        return $this->dao->update($id, $name, $description, $price, $image_url);
    }

    public function delete($id) {
        return $this->dao->delete($id);
    }
}
?>
