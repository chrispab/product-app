<?php
class ListView
{
    private $model;

    public function __construct($model) {
        $this->controller = $controller;
        $this->model = $model;
    }


	/**
	 * List all products in db.
	 *
	 * @param No params
	 *
	 * @return void
	 */
	public function listProducts() {
		$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'id';
		$products = $this->productsService->getAllProducts($orderby);
		$this->renderView('listProducts.php',$products);
	}

	public function output(){
        //prep data from model
        //$data = "<p>" . $this->model->tstring ."</p>";

        //render template
        require_once($this->model->template);
    }
