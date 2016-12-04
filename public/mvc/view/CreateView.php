<?php
class CreateView{
    private $model;
    private $controller;
    private $template;
    //private $errors;    //form/validation errs array

    public function __construct($model, $controller) {
        //$this->controller = $controller;
        $this->model = $model;
        $this->controller = $controller;
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
		$product = $this->productsService->tempProduct();
		if (isset($_POST['add-new-product'])) { //if new product form submitted
			$product->getPostParams();
			$errors = $product->validateProductParams();
			if (!$errors['errs_count']) {
				//only do following if all params ok
				$this->productsService->createNewProduct($product);
				$this->productsService->storeImage($product->image);	//upload file
				$this->productsService->modalAlert("New Product Created");
			}
		}
		//$this->renderView('create.php',$product,$errors);
	}


    public function output(){
        //prep view data
        $product = $this->model->tempProduct();     //get a temp product

        if (isset($_POST['add-new-product'])) { //if new product form submitted/re
            //get data from POST vars and populate product
            $product->getPostParams();
            $errors = $product->validateProductParams();
            if (!$errors['errs_count']) {
                //only do following if all params ok
                $this->controller->createNewProduct($product);
                $this->controller->storeImage($product->image);	//upload file
                $this->model->modalAlert("New Product Created");//and redirscts also
                //all done so show prod listing
                //header('Location: ' . "index.php?op=list");

            }
        }
        else {  //no POST vars so must be first time form showing - fresh create
            $errors = array("part_number_err"=>"",
                        "description_err"=>"",
                        "image_err"=>"",
                        "stock_quantity_err"=>"",
                        "image_err"=>"",
                        "cost_price_err"=>"",
                        "selling_price_err"=>"",
                        "vat_rate_err"=>"",
                        "errs_count"=>"0");
        }
        //show the product create form
        require_once($this->template);
    }
}
