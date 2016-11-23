<?php
/**
 * Primasry file. ProductsController manages primitive static routing
 * and calls CRUD functions to achieve required actions
 *
 * A *description*, that can span multiple lines, to go _in-depth_ into the details of this element
 * and to provide some background information or textual references.
 *
 */
require_once (__DIR__.'/../model/Autoloader.php');
require_once (__DIR__. '/../model/ProductsService.php');

class ProductsController
{
	private $productsService = null;

	public function __construct() {
		$this->productsService = new ProductsService();
	}

	/**
	 * Handles requests and routes to correct method.
	 *
	 * @param No params
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
	 * List all products in db.
	 *
	 * @param No params
	 *
	 * @return void
	 */
	public function listProducts() {
		$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'id';
		$products = $this->productsService->getAllProducts($orderby);
		$this->renderView('listProducts.php',$products);
	}

	/**
	 * create new product in db.
	 *
	 * @param No params
	 *
	 * @return void
	 */
	public function createProduct() {

		// //clear error array

        $errors = array("part_number_err"=>"",
		 				"description_err"=>"",
						"image_err"=>"",
						"stock_quantity_err"=>"",
						"image_err"=>"",
                        "cost_price_err"=>"",
                        "selling_price_err"=>"",
						"vat_rate_err"=>"",
						"errs_count"=>"");

		$product = $this->productsService->tempProduct();
		if (isset($_POST['add-new-product'])) { //if new product form submitted
			$product->getPostParams();
			$errors = $product->validateProductParams();
			if (!$errors['errs_count']) {
				//only do following if all parama ok
				$this->productsService->createNewProduct($product);
				$this->productsService->storeImage($product->image);	//upload file
				?>
					<script>
					    alert('Successfully Created ...');
					    window.location.href='index.php?op=list'
					</script>
				<?php
				//prod created so alert user all OK
				//$this->redirect('index.php?op=list');//all done go to start
			}
		}
		$this->renderView('create.php',$product,$errors);
	}

	/**
	 * update/modify a products in db.
	 *
	 * @param No params
	 *
	 * @return void
	 */
	public function updateProduct() {

		// //clear error array

        $errors = array("part_number_err"=>"",
		 				"description_err"=>"",
						"image_err"=>"",
						"stock_quantity_err"=>"",
						"image_err"=>"",
                        "cost_price_err"=>"",
                        "selling_price_err"=>"",
						"vat_rate_err"=>"",
						"errs_count"=>"");

		$product = $this->productsService->tempProduct();
		//if update-product form submitted
		if (isset($_POST['btn-save-updates'])) {
			var_dump($_REQUEST);
			$product->getPostParams();
			$errors = $product->validateProductParams();
			var_dump($errors);
			var_dump($product);
			if ( (!$errors['errs_count']) || ( ($errors['errs_count']==1) && ($errors['image_err']) ) ) {//no errs so update db record
				if (!empty($product->image)) { //if new img storeimage
					$this->productsService->storeImage($product->image);
				}	//upload file				}
				else{//use previous old image no change
					$product->image = $this->productsService->getCurrentImageFileName($product->id);
				}
				//else leave image info as is
				//$this->productsService->updateProduct($product->id, $product->part_number, $product->description, $product->image,$product->stock_quantity, $product->cost_price, $product->selling_price, $product->vat_rate);
				$this->productsService->updateProduct($product);

				?>
					<script>
					    alert('Successfully Updated ...');
					    window.location.href='index.php?op=list'
					</script>
				<?php

				//$this->redirect('index.php?op=list');
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
	 * delete a product in db.
	 *
	 * @param No params
	 *
	 * @return void
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
	 * displays single product in db.
	 *
	 * @param No params
	 *
	 * @return void
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
	 * render view.
	 *
	 * @param string $viewToShow specifies view file to render.
	 * @param object $product can be passed optional to view or NULL.
	 * @param array $errors contains list of backend validation errors or NULL
	 *
	 * @return void
	 */
	public function renderView($viewToShow, $product = NULL, $errors=NULL){
		include ROOT_PATH . '/../view/' . $viewToShow;
	}

	/**
	 * redirect to specified location
	 *
	 * @param $location specifies redirect location
	 *
	 * @return void
	 */
	public function redirect($location) {
		header('Location: ' . $location);
	}

	/**
	 * show error page when called
	 *
	 * @param string $title to display on err page.
	 * @param string $message to display on error page
	 *
	 * @return void
	 */
	public function showError($title, $message) {
		include ROOT_PATH . '/../view/error.php';
	}
}
