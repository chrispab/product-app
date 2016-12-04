<?php
class DeleteView
{
    private $model;
    private $controller;
    private $template;

    public function __construct($model, $controller) {
        //$this->controller = $controller;
        $this->model = $model;
        $this->template = "tpl/delete_tpl.php";
        $this->controller = $controller;
    }

    public function output(){
        //prep data from model
		///delete confirmed
		$id = isset($_GET['id']) ? $_GET['id'] : null;

		if ( isset($_POST['delete-product']) ) { // delete button clicked on delete prod form
            $this->controller->deleteProduct($id);
			//$this->model->deleteProduct($id);
            $this->controller->modalAlert("Product Deleted"); //and redirect

		}
		else  {	//show delete confirm page - 1st visit to op func
			$product = $this->model->getProduct($id);
            //render template
            require_once($this->template);
		}

    }
}
