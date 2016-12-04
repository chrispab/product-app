<?php
class DeleteController
{
    private $model;

    public function __construct($model){
        $this->model = $model;
    }

    /**
     * delete action, remove entry from model def by id
     */
    public function deleteProduct($id){
        $this->model->deleteProduct($id);
    }

    /**
     * show modal for delete action, remove entry from model def by id
     */
    public function modalAlert($message){
        $this->model->modalAlert($message);
    }


    public function action() {
        //$this->model->tstring = “Updated Data, thanks to MVC and PHP!”;
    }
}
