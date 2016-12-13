<?php
class EditView
{
    private $model;
    private $controller;
    private $template;

    public function __construct($model, $controller)
    {
        $this->controller = $controller;
        $this->model = $model;
        $this->template = "tpl/edit_tpl.php";
    }

    public function output()
    {
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
            if ((!$errors['errs_count']) || (($errors['errs_count']==1) && ($errors['image_err']))) {//no errs so update db record
                if (!empty($product->image)) { // new img supplied
                    //new image so check for old image and del if required
                    $image_to_delete = $this->model->getCurrentImageFileName($product->id);
                    $this->model->delete_image_from_storage($image_to_delete);
                    $this->controller->storeImage($product->image);
                } else {//use previous old image no change
                    $product->image = $this->model->getCurrentImageFileName($product->id);
                }
                $this->controller->updateProduct($product);
                $this->controller->modalAlert("Product Updated");//and redirect
            }
        } else { //no update form submitted - first call to update form var vals
            //render template
            $id = isset($_GET['id']) ? $_GET['id'] : null;

            $product = $this->model->getProduct($id);
            require_once($this->template);
        }
    }
}
