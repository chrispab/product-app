<?php
class DeleteView
{
    private $model;

    public function __construct($model, $controller) {
        //$this->controller = $controller;
        $this->model = $model;
        $this->template = "tpl/delete_tpl.php";
        $this->controller = $controller;

    }
    /**
	 * delete a product in db.
	 *
	 * @param No params
	 *
	 * @return void
	 */
	public function deleteProduct() {
		//$this->productsService->modalAlert("Product Deleted");

		//delete button clicked
		///delete confirmed
		$id = isset($_GET['id']) ? $_GET['id'] : null;

		if ( isset($_POST['delete-product']) ) { // delete button clicked on delete confirm form
			$this->productsService->deleteProduct($id);
			$this->productsService->modalAlert("Product Deleted");
		}
		else  {	//show delete confirm page
			$product = $this->productsService->getProduct($id);
			//$this->renderView('delete.php',$product);
		}
	}
    public function output(){
        //prep data from model
        //delete button clicked
		///delete confirmed
		$id = isset($_GET['id']) ? $_GET['id'] : null;

		if ( isset($_POST['delete-product']) ) { // delete button clicked on delete confirm form
            $this->controller->deleteProduct($id);
			//$this->model->deleteProduct($id);
            $this->controller->modalAlert("Product Deleted"); //and redirect
            //$this->model->modalAlert("Product Deleted");
            //all done so redirect to prod list
            //header('Location: ' . "index.php?op=list");
		}
		else  {	//show delete confirm page - 1st visit to op func
			$product = $this->model->getProduct($id);
			//$this->renderView('delete.php',$product);
            //render template
            require_once($this->template);
		}

    }
}
