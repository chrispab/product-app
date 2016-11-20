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


	private function validateImageToStore($image){
				$uploadOk = 1;//start as ok
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			    $check = getimagesize($_FILES["image"]["tmp_name"]);
			    if($check !== false) {
			        echo "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        $errors[] = "File is not an image.";
			        $uploadOk = 0;
			    }
				// Check if file already exists
				if (file_exists($target_file)) {
				    $errors[] = "Sorry, file already exists.";
				    $uploadOk = 0;
				}
				// Check file size
				if ($_FILES["image"]["size"] > 500000) {
				    $errors[] = "Sorry, your file is too large.";
				    $uploadOk = 0;
				}
				// Allow specific file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				    $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				    $uploadOk = 0;
				}
				// Check if $uploadOk, is set to 0 by an error
				if ($uploadOk == 0) {
				    $errors[] = "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				}
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
