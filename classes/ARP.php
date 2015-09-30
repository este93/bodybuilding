<?php 
abstract class ARP{
	public static function getAll($filter=""){
		$db = Singleton::getInstance();
		$conn = $db->conn;
		$q = $conn->query("select * from ".static::$table." ".$filter);
		$res = array();
		while($rw=$q->fetchObject()){
			$res[] = $rw;
		}
		return $res;
	}
	public static function getId($id,$param=NULL){
		$db = Singleton::getInstance();
		$conn = $db->conn;
		if(is_null($param)) 
			$param = static::$key;
		$q = $conn->query("select * from ".static::$table. " where {$param}='{$id}' limit 1");
		if(!$q)
  			die(print_r($conn->errorInfo()));
		return $q->fetchObject(); 
	}
	public static function getSomething($param,$filter=""){
		$db = Singleton::getInstance();
		$conn = $db->conn;
		$q = $conn->query("select ".$param." from ".static::$table." ".$filter);
		$res = array();
		while($rw=$q->fetchObject()){
			$res[] = $rw;
		}
		return $res;
	}
	public function insert(){
		$db = Singleton::getInstance();
		$conn = $db->conn;
		$array_fields=get_object_vars($this);
		$keys = array_keys($array_fields);
		$q="insert into ".static::$table."(";
		$q.=implode(",",$keys).") values ('";
		$q.=implode("','",array_values($array_fields));
		$q.="')";
		$prep = $conn->prepare($q);
		$prep->execute();
	}
	public function update(){
		$db = Singleton::getInstance();
		$conn = $db->conn;
		$q="update " . static::$table . " set ";
		foreach($this as $k=>$v){
			if($k==static::$key) continue;
			$q.=$k."='".$v."',";
		}
		$q=rtrim($q, ",");
		$keyField = static::$key;
		$q.=" where ".$keyField. " = ". $this->$keyField;
		$prep = $conn->prepare($q);
		$prep->execute();
	}
}