<?php
require_once 'Product.php';
require_once 'ProductsGateway.php';
require_once 'ValidationException.php';


class ProductsService extends ProductsGateway {

	private $productsGateway = null;

	public function __construct() 	{
	}

	public function getAllProducts($orderby) {
		try {
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

		try {
			self::connect();
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

	public function modalAlert($message) {

		include_once "header.php";
		?>
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<!-- Bootstrap -->
		<!-- bootstrap Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<!-- bootbox code -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

		<script>
			bootbox.alert({
				message: "<?php echo $message ?>",
				size: 'small',
				callback: function(){ window.location.href='index.php?op=list' }
			});
		</script>

		<?php
		include_once "footer.php";

	}
}
