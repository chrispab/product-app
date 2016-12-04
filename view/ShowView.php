<?php
class ShowView{
    private $model;
    private $controller;
    private $template;

    public function __construct($model, $controller) {
        $this->model = $model;
        $this->controller = $controller;
        $this->template = "tpl/show_tpl.php";
    }

    public function output(){
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if (!$id) {
            throw new Exception('Internal error');
        }
        $product = $this->model->getProduct($id);
        require_once($this->template);
    }
}
