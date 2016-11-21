<?php
require_once (__DIR__.'/../model/Autoloader.php');
require_once (__DIR__. '/../model/ProductsService.php');
/**
 * Primasry file. ProductsController manages primitive static routing
 * and calls CRUD functions to achieve required actions
 *
 * A *description*, that can span multiple lines, to go _in-depth_ into the details of this element
 * and to provide some background information or textual references.
 *
 * @param string $myArgument With a *description* of this argument, these may also
 *    span multiple lines.
 *
 * @return void
 */

class ProductsController
{
	private $productsService = null;

	public function __construct() {
		$this->productsService = new ProductsService();
	}

	/**
	 * Handles requests and routes to correct method
	 *
	 * processes request and routes to correct methodtextual references.
	 *
	 * @param string $myArgument With a *description* of this argument, these may also
	 *    span multiple lines.
	 *
	 * @return void
	 */
	public function handleRequest() {
		$op = isset($_GET['op']) ? $_GET['op'] : null;


			if (!$op) {
				$this->renderView('home.php');
			}
			elseif ($op == 'list') {
				$this->listProducts();
			}
			elseif ($op == 'new') {
				$this->createProduct();
			}
			elseif ($op == 'edit') {
				$this->updateProduct();
			}
			elseif ($op == 'delete') {
				$this->deleteProduct();
			}
			elseif ($op == 'show') {
				$this->showProduct();
			}
			else {
				$this->showError("Operation not supported", "Operation for execution: " . $op . " - was not found");
			}

	}

/**
 *
 */
	public function listProducts() {
		$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'id';
		$products = $this->productsService->getAllProducts($orderby);
		$this->renderView('listProducts.php',$products);
	}


	public function createProduct() {

		$errors = array();
		$product = $this->productsService->tempProduct();
		if (isset($_POST['add-new-product'])) { //if new product form submitted
			$product->getPostParams();
			$errors = $product->validateProductParams();
			if (!$errors) {
				//validate image HEREEREEEREREERE**********
				//only do following if all parama ok
				$this->productsService->createNewProduct($product);
				$this->productsService->storeImage($product->image);	//upload file

				//prod created so alert user all OK
				$this->redirect('index.php?op=list');//all done go to start
			}
		}
		$this->renderView('create.php',$product,$errors);
	}

	/**
	 *
	 */
	public function updateProduct() {

		$errors = array();
		$product = $this->productsService->tempProduct();
		//if update-product form submitted
		if (isset($_POST['btn-save-updates'])) {
			var_dump($_REQUEST);
			$product->getPostParams();
			$errors = $product->validateProductParams();
			var_dump($errors);
			var_dump($product);
			if (!$errors) {//no errs so update db record
				if (!empty($product->image)) { //if new img storeimage
					$this->storeImage($product->image);	//upload file
				}
				else{//use previous old image no change
					$product->image = $this->productsService->getCurrentImageFileName($product->id);
				}
				//else leave image info as is
				//$this->productsService->updateProduct($product->id, $product->part_number, $product->description, $product->image,$product->stock_quantity, $product->cost_price, $product->selling_price, $product->vat_rate);
				$this->productsService->updateProduct($product);

				?>
					<script>
					    alert('Successfully Updated ...');
					    window.location.href='index.php';
					</script>
				<?php

				$this->redirect('index.php');
			}
		}
		else { //no update form submitted - first call to update form var vals
			$id = isset($_GET['id']) ? $_GET['id'] : null;
			$product = $this->productsService->getProduct($id);
			//var_dump($product);
		}
		$this->renderView('update.php',$product,$errors);
	}

	/**
	 *
	 */
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

		$this->renderView('delete.php', $product);
	}

	/**
	 *
	 */
	public function showProduct() {
		$id = isset($_GET['id']) ? $_GET['id'] : null;

		$errors = array();

		if (!$id) {
			throw new Exception('Internal error');
		}
		$product = $this->productsService->getProduct($id);

		$this->renderView('view.php', $product);
	}

	/**
	 *
	 */
	public function renderView($viewToShow, $product = NULL, $errors=NULL){
		include ROOT_PATH . '/../view/' . $viewToShow;
	}

	/**
	 *
	 */
	public function redirect($location) {
		header('Location: ' . $location);
	}

	/**
	 *
	 */
	public function showError($title, $message) {
		include ROOT_PATH . '/../view/error.php';
	}
}
