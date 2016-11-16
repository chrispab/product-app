<?php
#$fp = (__DIR__);
#echo $fp;
require_once 'ProductsGateway.php';
require_once 'ValidationException.php';
require_once 'Database.php';

class ProductsService extends ProductsGateway
{

	private $productsGateway = null;

	public function __construct()
	{
		echo "<br> prodservice constructor";
		$this->productsGateway = new ProductsGateway();
		echo "<br> prodservice constructed";
	}

	public function getAllProducts($orderby)
	{
		try
		{
			echo "<br> in getallprods";
			self::connect();
			$result = $this->productsGateway->selectAll($orderby);
			self::disconnect();
			return $result;
		}
		catch(Exception $e)
		{
			self::disconnect();
			throw $e;
		}
	}

	public function getProduct($id)
	{
		try
		{
			self::connect();
			$result = $this->productsGateway->selectById($id);
			self::disconnect();
		}
		catch(Exception $e)
		{
			self::disconnect();
			throw $e;
		}
		return $this->productsGateway->selectById($id);
	}

	private function validateProductParams($name, $email, $mobile)
	{
		$errors = array();

		if ( !isset($name) || empty($name) ) {
		    $errors[] = 'Name is required';
		}
		if ( !isset($email) || empty($email) ) {
		    $errors[] = 'Email is required';
		}
		if ( !isset($mobile) || empty($mobile) ) {
		    $errors[] = 'Mobile is required';
		}
		if (empty($errors))
		{
			return;
		}
		throw new ValidationException($errors);
	}

	public function createNewProduct($name, $email, $mobile)
	{
		try
		{
			self::connect();
			$this->validateProductParams($name, $email, $mobile);
			$result = $this->productsGateway->insert($name, $email, $mobile);
			self::disconnect();
			return $result;
		}
		catch(Exception $e)
		{
			self::disconnect();
			throw $e;
		}
	}

	public function editProduct($name, $email, $mobile, $id)
	{
		try
		{
			self::connect();
			$result = $this->productsGateway->edit($name, $email, $mobile, $id);
			self::disconnect();
		}
		catch(Exception $e) {
			self::disconnect();
			throw $e;
		}
	}
	public function deleteProduct($id)
	{
		try
		{
			self::connect();
			$result = $this->productsGateway->delete($id);
			self::disconnect();
		}
		catch(Exception $e)
		{
			self::disconnect();
			throw $e;
		}
	}

}

?>
