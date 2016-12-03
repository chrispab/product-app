<?php
define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"]);
require_once (__DIR__. '/mvc/Router.php');

echo __DIR__;

include_once "mvc/Router.php";

/**
 * Primary file. Point of entry for the ap.
 *
 * Index.php intercepts all requests from the client.
 * Includes primary productsController, creates it and passes web requests to
 * it for further routing and processing
 */

// require_once(__DIR__."/../controller/ProductsController.php");
//
// $controller = new ProductsController();
// $controller->handleRequest();


$app = new Router();
$app->handleRequest();
