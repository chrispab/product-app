<?php
// echo "hello";
// $fp = (__DIR__."/../controller/ProductsController.php");
// echo $fp;
require_once(__DIR__."/../controller/ProductsController.php");

//require_once '../controller/ProductsController.php';
// echo "after req";
$controller = new ProductsController();
#$db = new Database();
#$db->connect();
//Database::connect();
//$products = $controller->productsService->getAllProducts('id');
//var_dump($products);
$controller->handleRequest();
