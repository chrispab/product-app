<?php
#$fp = (__DIR__);
#echo $fp;
require_once 'Product.php';
require_once 'ProductsGateway.php';
require_once 'ValidationException.php';


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


	public function createNewProduct($product) {
		//echo "<br> ********   in createnew product  pn= " . $part_number;
		//die();

		try {
			self::connect();
//			$this->validateProductParams($part_number, $description, $image, $stock_quantity, $cost_price, $selling_price, $vat_rate);
			$result = $this->insert($product->part_number, $product->description, $product->image, $product->stock_quantity, $product->cost_price, $product->selling_price, $product->vat_rate);
			self::disconnect();
			return $result;
		}
		catch(Exception $e) {
			self::disconnect();
			throw $e;
		}
	}

	public function storeImage ($imagefile){
		$target_dir = "product_images/";
		$target_file = $target_dir . basename($_FILES["imagefile"]["name"]);

		if (move_uploaded_file($_FILES["imagefile"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["imagefile"]["name"]). " has been uploaded.";
		} else {
			$errors[] = "Sorry, there was an error uploading your file.";
		}
		return;

	}

	public function getCurrentImageFileName($id){
		$p = $this->getProduct($id);
		$image = $p->image;
		return $image;
	}


	public function updateProduct($product) {
		try {
			self::connect();
			$result = $this->edit($product->id, $product->part_number, $product->description, $product->image, $product->stock_quantity, $product->cost_price, $product->selling_price, $product->vat_rate);
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


	public function tempProduct() {
		$product = new Product();
		return $product;
	}
}
