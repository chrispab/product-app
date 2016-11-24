<?php

//include_once '/home/uda/sites/products_app/model/Product.php';
use model\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testProductCleanInput()
    {
        $product = new Product();
        $input = (' qwerty ');
        $this->assertTrue($product->clean_input($input) == "qwerty");
    }

    public function testProductCleanInputstrip()
    {
        $product = new Product();

        $input = ('qw\erty');
        $this->assertTrue($product->clean_input($input) == "qwerty");
    }

    public function testProductCleanInputSpecialChars()
    {
        $product = new Product();

        // $new = htmlspecialchars("<a href='test'>Test</a>", ENT_QUOTES);
        // echo $new;

        $input = ("<a>");
        echo $input;
        echo $product->clean_input($input);
        $this->assertTrue($product->clean_input($input) == "&lt;a&gt;");
    }
}
