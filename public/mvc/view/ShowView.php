<?php
class ShowView{
    private $model;
    private $template;

    public function __construct($model) {
        //$this->controller = $controller;
        $this->model = $model;
        $this->template = "tpl/show_tpl.php";
    }
    /**
     * displays single product in db.
     *
     * @param No params
     *
     * @return void
     */
    public function showProduct() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        $errors = array();

        if (!$id) {
            throw new Exception('Internal error');
        }
        $product = $this->model->getProduct($id);

        $this->renderView('view.php', $product);
    }

    public function output(){
        //render template
        //echo "listview op";
        //var_dump( $this->model->getAllProducts("id") );
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        $errors = array();

        if (!$id) {
            throw new Exception('Internal error');
        }
        $product = $this->model->getProduct($id);
        require_once($this->template);
    }
}
