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
		$this->productService = new ProductsService();
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
		$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : null;
		echo "<br> in list prods 1";
		$products = $this->productsService->getAllProducts($orderby);
		echo "<br> in list prods 2";
		include ROOT_PATH . 'view/products.php';
	}

	public function saveProduct()
	{
		$title = 'Create New Product';

		$name 	= '';
		$email  = '';
		$mobile = '';

		$errors = array();

		if (isset($_POST['form-submitted']))
		{
			$name   = isset($_POST['name'])   ? trim($_POST['name'])   : null;
			$email  = isset($_POST['email'])  ? trim($_POST['email'])  : null;
			$mobile = isset($_POST['mobile']) ? trim($_POST['mobile']) : null;

			try
			{
				$this->productsService->createNewProduct($name, $email, $mobile);
				$this->redirect('index.php');
				return;
			}
			catch(ValidationException $e)
			{
				$errors = $e->getErrors();
			}
		}
		// Include view from Create form
		include ROOT_PATH . '/view/create.php';
	}

	public function editProduct()
	{
		$title = 'Edit product';

		$name   = '';
		$email  = '';
		$mobile = '';
		$id     = $_GET['id'];

		$contact = $this->productsService->getProduct($id);

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
		include ROOT_PATH . 'view/update.php';
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
		$contact = $this->productsService->getProduct($id);

		include ROOT_PATH . 'view/delete.php';

	}

	public function showProduct()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : null;

		$errors = array();

		if (!$id)
		{
			throw new Exception('Internal error');
		}
		$contact = $this->productsService->getProduct($id);

		include ROOT_PATH . 'view/view.php';
	}

	public function showError($title, $message)
	{
		include ROOT_PATH . 'view/error.php';
	}
}

?>
