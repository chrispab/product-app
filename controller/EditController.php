<?php
class EditController
{
    private $model;

    public function __construct($model){
        $this->model = $model;
    }

    public function action() {
        //$this->model->tstring = “Updated Data, thanks to MVC and PHP!”;
    }
}
