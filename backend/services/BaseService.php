<?php
class BaseService {
    protected $dao;

    public function __construct($dao) {
        $this->dao = $dao;
    }

    public function getAll() {
        return $this->dao->getAll();
    }

    public function getById($id) {
        return $this->dao->getById($id);
    }

    public function create(...$params) {
        // Pretpostavlja se da DAO ima create metodu s parametarskim listama
        return call_user_func_array([$this->dao, 'create'], $params);
    }

    public function update(...$params) {
        // Pretpostavlja se da DAO ima update metodu s parametarskim listama
        return call_user_func_array([$this->dao, 'update'], $params);
    }

    public function delete($id) {
        return $this->dao->delete($id);
    }
}
?>
