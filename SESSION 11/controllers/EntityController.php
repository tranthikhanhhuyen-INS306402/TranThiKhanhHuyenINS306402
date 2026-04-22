<?php

require_once __DIR__ . '/../models/EntityModel.php';

class EntityController {

    private $model;

    public function __construct() {
        $this->model = new EntityModel();
    }

    public function index() {
        $records = $this->model->getAll();
        require __DIR__ . '/../views/entity/index.php';
    }

    public function create() {
        require __DIR__ . '/../views/entity/create.php';
    }

    public function store() {
        $this->model->create($_POST);
        header("Location: index.php");
        exit;
    }

    public function edit() {
        $id = (int)$_GET['id'];
        $record = $this->model->getById($id);
        require __DIR__ . '/../views/entity/edit.php';
    }

    public function update() {
        $id = (int)$_POST['id'];
        $this->model->update($id, $_POST);
        header("Location: index.php");
        exit;
    }

    public function delete() {
        $id = (int)$_GET['id'];
        $this->model->delete($id);
        header("Location: index.php");
        exit;
    }
}