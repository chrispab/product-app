<?php
require_once 'Database.php';
/**
 *
 */
class ProductsGateway extends Database {
	public function __construct() {
	}

	public function selectAll($orderby) {
		if (!isset($orderby)) {
			$orderby = 'id';	//default sort order
		}

		$pdo = Database::connect();
		$sql = $pdo->prepare("SELECT * FROM products ORDER BY $orderby ASC");
		$sql->execute();

		$products = array();
		while ($obj = $sql->fetch(PDO::FETCH_OBJ)) {
			$products[] = $obj;
		}
		return $products;
	}

	/**
	 *
	 */
	public function selectById($id) {
		$pdo = Database::connect();
		$sql = $pdo->prepare("SELECT * FROM products WHERE id = ?");
		$sql->bindValue(1, $id);
		$sql->execute();
		$result = $sql->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	/**
	 *
	 */
	public function insert($part_number, $description, $image, $stock_quantity, $cost_price, $selling_price, $vat_rate) {

		$pdo = Database::connect();
		// set the PDO error mode to exception
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {
			$sql = $pdo->prepare("INSERT INTO products (part_number, description, image, stock_quantity, cost_price, selling_price, vat_rate) VALUES(:part_number, :description, :image, :stock_quantity, :cost_price, :selling_price, :vat_rate)");
			$sql->bindParam(':part_number', $part_number);
			$sql->bindParam(':description', $description);
			$sql->bindParam(':image', $image);
			$sql->bindParam(':stock_quantity', $stock_quantity);
			$sql->bindParam(':cost_price', $cost_price);
			$sql->bindParam(':selling_price', $selling_price);
			$sql->bindParam(':vat_rate', $vat_rate);
			//echo "<br> ********   in gateway statement prepared<br>";
		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		try {
			$result = $sql->execute();
			//echo "<br>New record created successfully";
		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	/**
	 *
	 */
	public function edit($id, $part_number, $description, $image, $stock_quantity, $cost_price, $selling_price, $vat_rate) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = $pdo->prepare("UPDATE products SET name = ?, email = ?, phone = ? WHERE id = ? LIMIT 1");
		try {
			$sql = $pdo->prepare("UPDATE products SET part_number = :part_number,
				 description = :description, image = :image, stock_quantity = :stock_quantity,
				 cost_price = :cost_price, selling_price = :selling_price, vat_rate = :vat_rate
			 	WHERE id = :id");
			$sql->bindParam(':id', $id);
			$sql->bindParam(':part_number', $part_number);
			$sql->bindParam(':description', $description);
			$sql->bindParam(':image', $image);
			$sql->bindParam(':stock_quantity', $stock_quantity);
			$sql->bindParam(':cost_price', $cost_price);
			$sql->bindParam(':selling_price', $selling_price);
			$sql->bindParam(':vat_rate', $vat_rate);
			//echo "<br> ********   in edit pg<br>";
		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		try {
			$result = $sql->execute();
			//echo "<br>New record created successfully";
		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	/**
	 *
	 */
	public function delete($id) {

		$pdo = Database::connect();

		// select image from db to delete
		$stmt_select = $pdo->prepare('SELECT image FROM products WHERE id =:prod_id');
		$stmt_select->execute(array(':prod_id'=>$id));
		$imgRow = $stmt_select->fetch(PDO::FETCH_ASSOC);
		//del
		unlink("product_images/".$imgRow['image']);

		//delete db record
		$sql = $pdo->prepare("DELETE FROM products WHERE id =?");
		$sql->execute(array($id));
	}
	/**
	 * Delete image from storeImage
	 * @param  string $image_file_name to delete.
	 *
	 * @return void
	 */
	 public function delete_image_from_storage($image_file_name) {
		 unlink("product_images/".$image_file_name);
	 }
}
