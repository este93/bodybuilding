<?php
require_once "../config.php";
$post = is_numeric($_POST['name'])?$_POST['name']:'1';
if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARTDED_FOR'] != '') {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
$db = Singleton::getInstance();
$conn1 = $db->conn;
$a = $conn1->query("select * from anketa_glasanja where IP = '{$ip}'");
if($a->rowCount() > 0){
	echo "Moguce je glasati samo jednom";
}else {
	$conn = new PDO("mysql:host=localhost;dbname=bodybuilding;charset=utf8","root","");
$prep = $conn->prepare("insert into anketa_glasanja values('',$post,NOW(),'$ip')");
$prep->execute();

}

