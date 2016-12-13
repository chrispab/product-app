<?php
class Model
{
    public $string;

    public function __construct(){
        $this->string = "The string has been loaded.";
        $this->template = "tpl/mytemplate.php";
    }
}
