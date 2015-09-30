<?php
class Singleton{
	private static $instance = null;
	public $conn;
	private function __construct(){
		try {
    		$this->conn = new PDO("mysql:host=localhost;dbname=bodybuilding;charset=utf8","root","");
    		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch (PDOException $e) {
    		echo 'Problem sa konekcijom: ' . $e->getMessage();
}
			
	}
	static function getInstance(){
		if(!self::$instance)
			self::$instance = new Singleton;
		return self::$instance;
	}
}