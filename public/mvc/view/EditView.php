<?php
class EditView{
    private $model;
    private $template;

    public function __construct($model) {
        //$this->controller = $controller;
        $this->model = $model;
        $this->template = "tpl/edit_tpl.php";
    }
    /**
	 * update/modify a products in db.
	 *
	 * @param No params
	 *
	 * @return void
	 */
	public function updateProduct() {

	    $errors = array("part_number_err"=>"",
		 				"description_err"=>"",
						"image_err"=>"",
						"stock_quantity_err"=>"",
						"image_err"=>"",
                        "cost_price_err"=>"",
                        "selling_price_err"=>"",
						"vat_rate_err"=>"",
						"errs_count"=>"");

		$product = $this->model->tempProduct();
		//if update-product form submitted
		if (isset($_POST['btn-save-updates'])) {
			$product->getPostParams();

			$errors = $product->validateProductParams();
			if ( (!$errors['errs_count']) || ( ($errors['errs_count']==1) && ($errors['image_err']) ) ) {//no errs so update db record
                //get current image if exists
				if (!empty($product->image)) { //if new img storeimage
					$this->model->storeImage($product->image);
				}	//upload file				}
				else{//use previous old image no change
					$product->image = $this->model->getCurrentImageFileName($product->id);
				}
				//else leave image info as is
				$this->model->updateProduct($product);
				$this->model->modalAlert("Product Updated");
			}
		}
		else { //no update form submitted - first call to update form var vals
			$id = isset($_GET['id']) ? $_GET['id'] : null;
			$product = $this->model->getProduct($id);
		}
		//$this->renderView('update.php',$product,$errors);
	}


    public function output(){
        //$this->updateProduct();
        $errors = array("part_number_err"=>"",
		 				"description_err"=>"",
						"image_err"=>"",
						"stock_quantity_err"=>"",
						"image_err"=>"",
                        "cost_price_err"=>"",
                        "selling_price_err"=>"",
						"vat_rate_err"=>"",
						"errs_count"=>"");

		$product = $this->model->tempProduct();
		//if update-product form submitted
		if (isset($_POST['btn-save-updates'])) {
			$product->getPostParams();

			$errors = $product->validateProductParams();
			if ( (!$errors['errs_count']) || ( ($errors['errs_count']==1) && ($errors['image_err']) ) ) {//no errs so update db record
                //get current image if exists
				if (!empty($product->image)) { //if new img storeimage
					$this->model->storeImage($product->image);
				}	//upload file				}
				else{//use previous old image no change
					$product->image = $this->model->getCurrentImageFileName($product->id);
				}
				//else leave image info as is
				$this->model->updateProduct($product);
				$this->model->modalAlert("Product Updated");
			}
		}
		else { //no update form submitted - first call to update form var vals
			$id = isset($_GET['id']) ? $_GET['id'] : null;
			$product = $this->model->getProduct($id);
		}
        //render template
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        //
        // $errors = array();
        //
        // if (!$id) {
        //     throw new Exception('Internal error');
        // }
        $product = $this->model->getProduct($id);
        require_once($this->template);
    }
}
