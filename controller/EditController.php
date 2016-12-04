<?php
class EditController
{
    private $model;

    public function __construct($model){
        $this->model = $model;
    }
    public function storeImage($image){
        $this->model->storeImage($image);
    }
    public function updateProduct($product){
        $this->model->updateProduct($product);
    }
    public function modalAlert($message){
        $this->model->modalAlert($message);
    }

    public function action() {
        //$this->model->tstring = “Updated Data, thanks to MVC and PHP!”;
    }
}
