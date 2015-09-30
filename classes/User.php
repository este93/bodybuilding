<?php 
class User {
	public $id, $username, $password, $status;
	const Anonimous = 0;
	const User = 	   0b001;
	const Admin =	   0b010;
	const SuperAdmin = 0b100;
	function setSessions(){
		Session::set("username",$this->username);
		Session::set("status",$this->status);
	}
	static function login($username, $password) {
		$db = Singleton::getInstance();
		$conn = $db->conn;
		$q = $conn->prepare(
			"select * from users where username=:us and password=password(:pass) and status<>0 limit 1"
			); 
		$q->bindParam(":us", $username);
		$q->bindParam(":pass",$password);
		$q->execute();
		$q->setFetchMode(PDO::FETCH_CLASS,"User");
		if($user=$q->fetch()){
			$user->setSessions(); 
			return $user;
		}else 
			return null;
	}
	static function userExists($username){
	    $db = Singleton::getInstance();
		$conn = $db->conn;
	    $query = $conn->prepare('select username from users where username = :name');
	    $query->bindParam(':name', $username);
	    $query->execute();
	    if($query->rowCount() > 0){
	        return true;
	    }else{
	        return false;
	    }
	}
	static function register($username,$email,$password){
		$db = Singleton::getInstance();
		$conn = $db->conn;
		$q = $conn->prepare("insert into users values('', :username, :email, password(:password),'0')"); 
		$q->bindParam(":username", $username);
		$q->bindParam(":email",$email);
		$q->bindParam(":password",$password);
		$q->execute();
		if($q->rowCount() > 0){
	        return true;
	    }else{
	        return false;
	    }
	}	
}