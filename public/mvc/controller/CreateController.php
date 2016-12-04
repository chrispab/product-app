<?php
class CreateController
{
    private $model;

    public function __construct($model){
        $this->model = $model;
    }

    public function createNewProduct($product) {
        $this->model->createNewProduct($product);
    }
    public function storeImage($image){
        $this->model->storeImage($image);
    }
    public function modalAlert($message){
        $this->model->modalAlert($message);
    }

    /**
 * create controller action to create a new product in the ProductsModel
 */
    public function action() {
        if (isset($_POST['add-new-product'])) { //if new product form submitted
            $product = $this->model->tempProduct();     //get a temp product

            $product->getPostParams();
            $errors = $product->validateProductParams();
            if (!$errors['errs_count']) {
                //only do following if all parama ok
                $this->model->createNewProduct($product);
                $this->model->storeImage($product->image);	//upload file
                $this->model->modalAlert("New Product Created");
            }
        }
    }
}
