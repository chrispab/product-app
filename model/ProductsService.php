<?php
#$fp = (__DIR__);
#echo $fp;
require_once 'ProductsGateway.php';
//echo "<br> req prodgateway";

require_once 'ValidationException.php';
//echo "<br> req valexep";

//require_once 'Database.php';
//echo "<br> req db";

class ProductsService extends ProductsGateway {

	private $productsGateway = null;

	public function __construct() 	{
		//parent::__construct(); // Call the parent class's constructor
		//echo "<br> prodservice constructor";
		//$this->productsGateway = new ProductsGateway();
	}

	public function getAllProducts($orderby) {
		//echo "<br> ********   in getallprods";
		try 		{
			self::connect();
			$result = $this->selectAll($orderby);
			self::disconnect();
			return $result;
		}
		catch(Exception $e) {
			self::disconnect();
			throw $e;
		}
	}

	public function getProduct($id) {
		try {
			self::connect();
			$result = $this->selectById($id);
			self::disconnect();
		}
		catch(Exception $e) {
			self::disconnect();
			throw $e;
		}
		return $this->selectById($id);
	}

	private function validateProductParams($part_number, $description, $image, $stock_quantity, $cost_price, $selling_price, $vat_rate) {
		echo "<br> ********   validating prod params";
		$errors = array();

		if ( !isset($part_number) || empty($part_number) ) {
		    $errors[] = 'Part Number is required';
		}
		if ( !isset($description) || empty($description) ) {
		    $errors[] = 'Description is required';
		}
		if ( !isset($stock_quantity) || empty($stock_quantity) ) {
		    $errors[] = 'Stock Level is required';
		}
		if ( !isset($cost_price) || empty($cost_price) ) {
		    $errors[] = 'Cost Price is required';
		}
		if ( !isset($selling_price) || empty($selling_price) ) {
		    $errors[] = 'Selling Price is required';
		}
		if ( !isset($vat_rate) || empty($vat_rate) ) {
		    $errors[] = 'VAT Rate is required';
		}
		if ( !isset($image) || empty($image) ) {
		    $errors[] = 'An Image is required';
		}
		if (empty($errors)) {
			return;
		}
		throw new ValidationException($errors);
	}

	public function createNewProduct($part_number, $description, $image, $stock_quantity, $cost_price, $selling_price, $vat_rate) {
		echo "<br> ********   in createnew product  pn= " . $part_number;
		//die();

		try {
			self::connect();
//			$this->validateProductParams($part_number, $description, $image, $stock_quantity, $cost_price, $selling_price, $vat_rate);
			$result = $this->insert($part_number, $description, $image, $stock_quantity, $cost_price, $selling_price, $vat_rate);
			self::disconnect();
			return $result;
		}
		catch(Exception $e) {
			self::disconnect();
			throw $e;
		}
	}

	public function updateProduct($id, $part_number, $description, $image, $stock_quantity, $cost_price, $selling_price, $vat_rate) {
		try {
			self::connect();
			$result = $this->edit($id, $part_number, $description, $image, $stock_quantity, $cost_price, $selling_price, $vat_rate);
			self::disconnect();
		}
		catch(Exception $e) {
			self::disconnect();
			throw $e;
		}
	}
	public function deleteProduct($id) {
		try {
			self::connect();
			$result = $this->delete($id);
			self::disconnect();
		}
		catch(Exception $e) {
			self::disconnect();
			throw $e;
		}
	}
}
