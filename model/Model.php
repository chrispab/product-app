<?php
class Model
{
    public $tstring;

    public function __construct(){
        $this->tstring = "The string has been loaded through the template.";
        $this->template = "tpl/template.php";
    }
}
