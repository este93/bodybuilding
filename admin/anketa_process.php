<?php
require "../config.php";
$db = Singleton::getInstance();
$conn = $db->conn;

$datetime = date_create()->format('Y-m-d H:i:s');
if(isset($_POST['dodaj'])){
	$naslov = ucfirst($_POST['naslov_ankete']);
	$odg = $_POST['odg'];
	$datetime = date_create()->format('Y-m-d H:i:s');
	$prep = $conn->prepare("insert into anketa_pitanja values('','{$naslov}','{$datetime}','0')");
	$prep->execute();
	$last_id = $conn->lastInsertId();
	foreach ($_POST as $k=>$v) {	
		$match = "/odg[0-9]/";
		$matched = preg_match($match, $k);
		if($matched){
			if(empty($v)){
				continue;
			}
			$prep = $conn->prepare("insert into anketa_odgovori values('','{$v}','{$last_id}','{$datetime}')");
			$prep->execute();
		}
	}
header("Location: admin.php?id=2&cat=dodaj_anketu.php");
}

if(isset($_POST['delete']) && !empty($_POST['brisi'])){
 	$checkboxes = implode("','",$_POST['brisi']);
	$prep = $conn->prepare("delete from anketa_pitanja where pitanje_id in ('$checkboxes')");
	$prep->execute();

header("Location: admin.php?id=2&cat=dodaj_anketu.php");
} 

if(isset($_POST['edit']) && !empty($_POST['izmeni'])){
  $prep=$conn->prepare("update anketa_pitanja set status=0");
  $prep->execute();
  $id = $_POST['izmeni'];
  $a=$conn->prepare("update anketa_pitanja set status=1 where pitanje_id={$id}");
  $a->execute();
  header("Location: admin.php?id=2&cat=dodaj_anketu.php");
}