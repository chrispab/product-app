<?php

include_once '/home/uda/sites/products_app/controller/ProductController.php';
use PHPUnit\Framework\TestCase;

class ProductsControllerTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $product = new Product();
        $product->handleRequest('/')
        ->see('Laravel');
    }
}
