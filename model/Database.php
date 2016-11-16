<?php

class Database
{
	private static $dbName 	   = 'products_app';
	private static $dbHost 	   = 'localhost';
	private static $dbUsername = 'myiot';
	private static $dbPassword = 'myiot';

	private static $conn = null;

	public function __construct()
	{
		// die('Init function is not allowed');
		//echo "<br> in db constructor";
	}

	public static function connect()
	{
		//echo "<br> trying to connect";
		// One connection through whole application
		if (null == self::$conn)
		{
			try
			{
				self::$conn =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbPassword);
				//echo "<br> connected";
				//var_dump(self::$conn);
			}
			catch(PDOException $e)
			{
				die($e->getMessage());
			}
		}
		return self::$conn;
	}

	public static function disconnect()
	{
		self::$conn = null;
	}

}
