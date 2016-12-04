<?php
class ListView
{
    private $model;
    private $template;

    public function __construct($model) {
        //$this->controller = $controller;
        $this->model = $model;
        $this->template = "tpl/list_tpl.php";
    }
	/**
	 * List all products in db.
	 *
	 * @param No params
	 *
	 * @return void
	 */
	public function listProducts() {
		//$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'id';
		//$products = $this->productsService->getAllProducts($orderby);
		//$this->renderView('listProducts.php',$products);
	}

	public function output(){
        //prep data from model
        //$data = "<p>" . $this->model->tstring ."</p>";

        //render template
        echo "listview op";
        var_dump( $this->model->getAllProducts("id") );
        $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'id';
        $product = $this->model->getAllProducts($orderby);
        require_once($this->template);
    }
}
