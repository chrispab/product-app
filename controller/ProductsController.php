<?php
//echo "in productscontroller";
require_once (__DIR__.'/../model/Autoloader.php');
//echo "aa";
require_once (__DIR__. '/../model/ProductsService.php');

class ProductsController
{

	private $productsService = null;

	public function __construct()
	{
		$this->productsService = new ProductsService();
		//echo "<br>in prodcontroller constr";
		//var_dump($this->productService->productGateway);
	}

	public function redirect($location)
	{
		header('Location: ' . $location);
	}

	public function handleRequest()
	{
		$op = isset($_GET['op']) ? $_GET['op'] : null;

		try
		{
			if (!$op || $op == 'list')
			{
				$this->listProducts();
			}
				elseif ($op == 'new')
				{
					$this->saveProduct();
				}
				elseif ($op == 'edit')
				{
					$this->editProduct();
				}
				elseif ($op == 'delete')
				{
					$this->deleteProduct();
				}
				elseif ($op == 'show')
				{
					$this->showProduct();
				}
				else
				{
					$this->showError("Page not found", "Page for execution" . $op . " was not found");
				}
		}
		catch(Exception $e)
		{
			$this->showError("Application error", $e->getMessage());
		}
	}

	public function listProducts()
	{
		$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'id';
		//echo "<br> in list prods 1";
		#var_dump($this->productsService->getAllProducts($orderby));
		$products = $this->productsService->getAllProducts($orderby);
		//var_dump($products);

		//echo "<br> in list prods 2 - now call the view";
		include ROOT_PATH . '/../view/products.php';
	}

	public function saveProduct()
	{
		$title = 'Create New Product';

		$part_number 	= '';
		$description  = '';
		$image = '';
		$stock_quantity = 0;
		$cost_price = 0;
		$selling_price = 0;
		$vat_rate = 20;
		$errors = array();

		if (isset($_POST['add-new-product']))//if new product form submitted
		{
			echo "<br> ********   save prod - form submitted";
			var_dump($_REQUEST);
			//get params from POST
			$part_number   = isset($_POST['part_number']) ? trim($_POST['part_number']) : null;
			$description  = isset($_POST['description'])  ? trim($_POST['description'])  : null;
			$image = isset($_FILES["imagefile"]["name"]) ? trim($_FILES["imagefile"]["name"]) : null;
			$stock_quantity  = isset($_POST['stock_quantity'])  ? trim($_POST['stock_quantity'])  : null;
			$cost_price  = isset($_POST['cost_price'])  ? trim($_POST['cost_price'])  : null;
			$selling_price  = isset($_POST['selling_price'])  ? trim($_POST['selling_price'])  : null;
			$vat_rate  = isset($_POST['vat_rate'])  ? trim($_POST['vat_rate'])  : null;

			//validate params
			$errors = $this->validateProductParams($part_number, $description, $image, $stock_quantity, $cost_price, $selling_price, $vat_rate);
			var_dump($errors);
			die();
			if (!$errors) {
				//validate image

				//only do following if all parama ok
				try {
					//upload image file
					$this->productsService->createNewProduct($part_number, $description, $image, $stock_quantity, $cost_price, $selling_price, $vat_rate);
					$this->redirect('index.php');
				}
				catch(ValidationException $e) {
					$errors = $e->getErrors();
				}
			}
		}
		// Include view from Create form
		include ROOT_PATH . '/../view/create.php';
	}

	public function editProduct()
	{
		$title = 'Edit product';

		$name   = '';
		$email  = '';
		$mobile = '';
		$id     = $_GET['id'];

		$product = $this->productsService->getProduct($id);

		$errors = array();

		if (isset($_POST['form-submitted']))
		{
			$name   = isset($_POST['name'])   ? trim($_POST['name']) 	   : null;
			$email  = isset($_POST['email'])  ? trim($_POST['email']) 	   : null;
			$mobile = isset($_POST['mobile']) ? trim($_POST['mobile'])     : null;

			try
			{
				$this->productsService->editProduct($name, $email, $mobile, $id);
				$this->redirect('index.php');
				return;
			}
			catch(ValidationException $e)
			{
				$errors = $e->getErrors();
			}
		}
		include ROOT_PATH . '/../view/update.php';
	}

	public function deleteProduct()
	{

		$id = isset($_GET['id']) ? $_GET['id'] : null;

		if (isset($_POST['submit']) == true)
		{
			$this->productsService->deleteProduct($id);

			$this->redirect('index.php');
		}

		if (!$id)
		{
			throw new Exception('Internal error');
		}
		$product = $this->productsService->getProduct($id);

		include ROOT_PATH . '/../view/delete.php';

	}

	public function showProduct()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : null;

		$errors = array();

		if (!$id)
		{
			throw new Exception('Internal error');
		}
		$product = $this->productsService->getProduct($id);

		include ROOT_PATH . '/../view/view.php';
	}

	private function validateProductParams($part_number, $description, $image, $stock_quantity, $cost_price, $selling_price, $vat_rate)
	{
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
		if ( !isset($image) || empty($image) ) {
		    $errors[] = 'An Image is required';
		}


///////////////
//////////check image
		$target_dir = "product_images/";
		$target_file = $target_dir . basename($_FILES["imagefile"]["name"]);
		$uploadOk = 1;//start as ok
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
//		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["imagefile"]["tmp_name"]);
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
		if ($_FILES["imagefile"]["size"] > 500000) {
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
		    if (move_uploaded_file($_FILES["imagefile"]["tmp_name"], $target_file)) {
		        echo "The file ". basename( $_FILES["imagefile"]["name"]). " has been uploaded.";
		    } else {
		        $errors[] = "Sorry, there was an error uploading your file.";
		    }
		}
////////////////////end of check stuff

		return ($errors);
	}

	public function showError($title, $message)
	{
		include ROOT_PATH . '/../view/error.php';
	}
}
