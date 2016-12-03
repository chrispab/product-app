<?php
class View
{
    private $model;

    public function __construct($model) {
        $this->controller = $controller;
        $this->model = $model;
    }

    public function output(){
        //prep data from model
        $data = "<p>" . $this->model->tstring ."</p>";
        
        //render template
        require_once($this->model->template);
    }
}
