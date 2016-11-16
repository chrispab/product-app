<?php
require 'Database.php';

class ProductsGateway extends Database
{

	public function selectAll($order)
	{
		if (!isset($order))
		{
			$order = 'name';
		}
		echo "<br> prodgateway selall";
		$pdo = Database::connect($order);
		$sql = $pdo->prepare("SELECT * FROM products ORDER BY $order ASC");
		$sql->execute();
		// $result = $sql->fetchAll(PDO::FETCH_ASSOC);

		$products = array();
		while ($obj = $sql->fetch(PDO::FETCH_OBJ))
		{
			$products[] = $obj;
		}
		return $products;
	}

	public function selectById($id)
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("SELECT * FROM products WHERE id = ?");
		$sql->bindValue(1, $id);
		$sql->execute();
		$result = $sql->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	public function insert($name, $email, $mobile)
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("INSERT INTO products(name, email, phone) VALUES(?, ?, ?)");
		$result = $sql->execute(array($name, $email, $mobile));
	}

	public function edit($name, $email, $mobile, $id)
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("UPDATE products SET name = ?, email = ?, phone = ? WHERE id = ? LIMIT 1");
		$result = $sql->execute(array($name, $email, $mobile, $id));
	}

	public function delete($id)
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("DELETE FROM products WHERE id =?");
		$sql->execute(array($id));
	}

}

?>
