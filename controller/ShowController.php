<?php
class ShowController
{
    private $model;

    public function __construct($model){
        $this->model = $model;
    }

    public function action() {
        //do nothing in show controller if called
    }
}
