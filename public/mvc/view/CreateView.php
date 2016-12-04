<?php
class CreateView{
    private $model;
    private $template;

    public function __construct($model) {
        //$this->controller = $controller;
        $this->model = $model;
        $this->template = "tpl/create_tpl.php";
    }
    /**
	 * create new product in db.
	 *
	 * @param No params
	 *
	 * @return void
	 */
	public function createProduct() {
		// //clear error array
        $errors = array("part_number_err"=>"",
		 				"description_err"=>"",
						"image_err"=>"",
						"stock_quantity_err"=>"",
						"image_err"=>"",
                        "cost_price_err"=>"",
                        "selling_price_err"=>"",
						"vat_rate_err"=>"",
						"errs_count"=>"");

		$product = $this->productsService->tempProduct();
		if (isset($_POST['add-new-product'])) { //if new product form submitted
			$product->getPostParams();
			$errors = $product->validateProductParams();
			if (!$errors['errs_count']) {
				//only do following if all parama ok
				$this->productsService->createNewProduct($product);
				$this->productsService->storeImage($product->image);	//upload file
				$this->productsService->modalAlert("New Product Created");
			}
		}
		//$this->renderView('create.php',$product,$errors);
	}


    public function output(){
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
        if (isset($_POST['add-new-product'])) { //if new product form submitted
            $product->getPostParams();
            $errors = $product->validateProductParams();
            if (!$errors['errs_count']) {
                //only do following if all parama ok
                $this->model->createNewProduct($product);
                $this->model->storeImage($product->image);	//upload file
                $this->model->modalAlert("New Product Created");
            }
        }
        require_once($this->template);
    }
}
