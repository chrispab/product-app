<?php
class ListController
{
    private $model;

    public function __construct($model){
        $this->model = $model;
    }

    public function clicked() {
        //$this->model->tstring = “Updated Data, thanks to MVC and PHP!”;
    }
}
