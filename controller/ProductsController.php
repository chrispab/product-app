<?php
//echo "in productscontroller";
require_once (__DIR__.'/../model/Autoloader.php');
//echo "aa";
require_once (__DIR__. '/../model/ProductsService.php');

class ProductsController
{

	private $productsService = null;

	public function __construct() {
		$this->productsService = new ProductsService();
		//echo "<br>in prodcontroller constr";
		//var_dump($this->productService->productGateway);
	}

	public function redirect($location) {
		header('Location: ' . $location);
	}

	public function handleRequest() {
		$op = isset($_GET['op']) ? $_GET['op'] : null;

		try {
			if (!$op || $op == 'list') {
				$this->listProducts();
			}
			elseif ($op == 'new') {
				$this->saveProduct();
			}
			elseif ($op == 'edit') {
				$this->editProduct();
			}
			elseif ($op == 'delete') {
				$this->deleteProduct();
			}
			elseif ($op == 'show') {
				$this->showProduct();
			}
			else {
				$this->showError("Page not found", "Page for execution" . $op . " was not found");
			}
		}
		catch(Exception $e) {
			$this->showError("Application error", $e->getMessage());
		}
	}

	public function listProducts() {
		$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'id';
		//echo "<br> in list prods 1";
		#var_dump($this->productsService->getAllProducts($orderby));
		$products = $this->productsService->getAllProducts($orderby);
		//var_dump($products);

		//echo "<br> in list prods 2 - now call the view";
		include ROOT_PATH . '/../view/products.php';
	}

	public function saveProduct() {
		$title = 'Create New Product';
		$part_number 	= '';
		$description  = '';
		$image = '';
		$stock_quantity = 0;
		$cost_price = 0;
		$selling_price = 0;
		$vat_rate = 20;
		$errors = array();

		//if new product form submitted
		if (isset($_POST['add-new-product'])) {
			echo "<br> ********   save prod - form submitted";
			var_dump($_REQUEST);
			//get params from POST
			$id   = isset($_POST['id']) ? trim($_POST['id']) : null;
			$part_number   = isset($_POST['part_number']) ? trim($_POST['part_number']) : null;
			$description  = isset($_POST['description'])  ? trim($_POST['description'])  : null;
			$image = isset($_FILES["imagefile"]["name"]) ? trim($_FILES["imagefile"]["name"]) : null;
			$stock_quantity  = isset($_POST['stock_quantity'])  ? trim($_POST['stock_quantity'])  : null;
			$cost_price  = isset($_POST['cost_price'])  ? trim($_POST['cost_price'])  : null;
			$selling_price  = isset($_POST['selling_price'])  ? trim($_POST['selling_price'])  : null;
			$vat_rate  = isset($_POST['vat_rate'])  ? trim($_POST['vat_rate'])  : null;

			//validate params
			$errors = $this->validateProductParams( $part_number, $description, $image, $stock_quantity, $cost_price, $selling_price, $vat_rate);
			var_dump($errors);
			//die();
			if (!$errors) {
				//validate image
				//only do following if all parama ok
				//upload image file here
				$this->storeImage( $image);	//upload file
				$this->productsService->createNewProduct($part_number, $description, $image, $stock_quantity, $cost_price, $selling_price, $vat_rate);
				//die();
				$this->redirect('index.php');
			}
		}
		// Include view from Create form
		include ROOT_PATH . '/../view/create.php';
	}

	public function editProduct() {
		$title = 'Update Product';
		$part_number 	= '';
		$description  = '';
		$image = '';
		$stock_quantity = 0;
		$cost_price = 0;
		$selling_price = 0;
		$vat_rate = 20;
		$errors = array();

		//if update-product form submitted
		if (isset($_POST['btn-save-updates'])) {
			var_dump($_REQUEST);
			$id   = isset($_POST['id']) ? trim($_POST['id']) : null;
			$part_number   = isset($_POST['part_number']) ? trim($_POST['part_number']) : null;
			$description  = isset($_POST['description'])  ? trim($_POST['description'])  : null;
			$image = isset($_FILES["imagefile"]["name"]) ? trim($_FILES["imagefile"]["name"]) : null;
			$stock_quantity  = isset($_POST['stock_quantity'])  ? trim($_POST['stock_quantity'])  : null;
			$cost_price  = isset($_POST['cost_price'])  ? trim($_POST['cost_price'])  : null;
			$selling_price  = isset($_POST['selling_price'])  ? trim($_POST['selling_price'])  : null;
			$vat_rate  = isset($_POST['vat_rate'])  ? trim($_POST['vat_rate'])  : null;

			//create product object with post params
			//$product = new product(productServices->
			//validate params
			$errors = $this->validateProductParams($part_number, $description, $stock_quantity, $cost_price, $selling_price, $vat_rate);
			var_dump($errors);
			//create product object with post params for update form to use
			//$product = new product($part_number, $description, $image, $stock_quantity, $cost_price, $selling_price, $vat_rate)
			//$myNewObj->setNewVar = 'newVal';
			$product = new StdClass();
			$product->id = $id;
			$product->part_number = $part_number;
			$product->description = $description;
			$product->image = $image;
			$product->stock_quantity = $stock_quantity;
			$product->cost_price = $cost_price;
			$product->selling_price = $selling_price;
			$product->vat_rate = $vat_rate;
			var_dump($product);

			//die();
			if (!$errors) {//no errs so update db record
				//validate image
				//if image has no val here then using prev imagefile
				//else get new image from file value attr
				//only do following if all parama ok
				if (!empty($image)) { //if new img storeimage
					$this->storeImage( $image);	//upload file
				}
				else{
					//use previous old image no change
					$image = $this->getCurrentImageFileName($id);
				}
				//else leave image info as is
				$this->productsService->updateProduct($id, $part_number, $description, $image, $stock_quantity, $cost_price, $selling_price, $vat_rate);
				echo "<br>called update product";

				//die();

				$this->redirect('index.php');
			}
		}
		else { //no update form submitted - first call to update resourcebundle_create
			$id = isset($_GET['id']) ? $_GET['id'] : null;
			$product = $this->productsService->getProduct($id);
			var_dump($product);
			//die();
		}
		include ROOT_PATH . '/../view/update.php';
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
	private function getCurrentImageFileName($id){
		$p = $this->productsService->getProduct($id);
		$image = $p->image;
		return $image;
	}
	public function deleteProduct() {
		$id = isset($_GET['id']) ? $_GET['id'] : null;

		if (isset($_POST['submit']) == true) {
			$this->productsService->deleteProduct($id);
			$this->redirect('index.php');
		}

		if (!$id) {
			throw new Exception('Internal error');
		}
		$product = $this->productsService->getProduct($id);

		include ROOT_PATH . '/../view/delete.php';
	}

	public function showProduct() {
		$id = isset($_GET['id']) ? $_GET['id'] : null;

		$errors = array();

		if (!$id) {
			throw new Exception('Internal error');
		}
		$product = $this->productsService->getProduct($id);

		include ROOT_PATH . '/../view/view.php';
	}

	private function validateProductParams($part_number, $description, $stock_quantity, $cost_price, $selling_price, $vat_rate) {
		echo "<br> ********   validating prod params in controller";
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
		// if ( !isset($image) || empty($image) ) {
		//     $errors[] = 'An Image is required';
		// }

		return ($errors);
	}
	private function validateImageToStore($image){


		///////////////
		//////////check image
				// $target_dir = "product_images/";
				// $target_file = $target_dir . basename($_FILES["image"]["name"]);
				$uploadOk = 1;//start as ok
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
		//		if(isset($_POST["submit"])) {
			    $check = getimagesize($_FILES["image"]["tmp_name"]);
			    if($check !== false) {
			        echo "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        $errors[] = "File is not an image.";
			        $uploadOk = 0;
			    }
		//		}
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
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				    $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				    $uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				    $errors[] = "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
				    // if (move_uploaded_file($_FILES["imagefile"]["tmp_name"], $target_file)) {
				    //     echo "The file ". basename( $_FILES["imagefile"]["name"]). " has been uploaded.";
				    // } else {
				    //     $errors[] = "Sorry, there was an error uploading your file.";
				    // }
				}
		////////////////////end of check stuff
	}

	public function showError($title, $message) {
		include ROOT_PATH . '/../view/error.php';
	}
}
