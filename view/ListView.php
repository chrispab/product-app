<?php
class ListView
{
    private $model;
    private $controller;
    private $template;

    public function __construct($model, $controller) {
        //$this->controller = $controller;
        $this->model = $model;
        $this->controller = $controller;
        $this->template = "tpl/list_tpl.php";
    }

	public function output(){
        //prep data from model
        //render template
        $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'id';
        $products = $this->model->getAllProducts($orderby);
        require_once($this->template);
    }
}
