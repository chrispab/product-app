<?php
//define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"]);
require_once ('Router.php');

//echo __DIR__;

//include_once "mvc/Router.php";

/**
 * Primary file. Point of entry for the ap.
 *
 * Index.php intercepts all requests from the client.
 * Includes primary router, creates it and passes web requests to
 * it for further routing and processing
 */
$app = new Router();
$app->handleRequest();
