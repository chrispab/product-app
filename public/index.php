<?php
// echo "hello";
// $fp = (__DIR__."/../controller/ProductsController.php");
// echo $fp;
require_once(__DIR__."/../controller/ProductsController.php");

//require_once '../controller/ProductsController.php';
// echo "after req";
$controller = new ProductsController();

$controller->handleRequest();

?>
