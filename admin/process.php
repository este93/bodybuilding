<?php
require '../config.php';
include '../classes/SimpleImage.php';

//dodavanje clanka
if(isset($_POST['dodaj'])) {
  $article = new Tekst();
  $naslov = $_POST['naslov'];
  $search = array("?",":","ć","Ć");
  $replace = array("","-","c","C");
  $naslov = str_replace($search, $replace,$naslov);
  $output = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $naslov); 
  if($_FILES['img']['tmp_name']!==""){
	$file_tmp = $_FILES['img']['tmp_name'];
    $img = new abeautifulsite\SimpleImage($file_tmp);
	$img->best_fit(1000, 450)->mean_remove()->save("../images/main/".$output.".jpeg");
    $img->best_fit(130, 90)->mean_remove()->save("../images/small/".$output.".jpeg");
  }  
  $article->naslov=ucfirst($naslov);
  $article->tekst=addslashes($_POST['text']);
  $article->datum=date('Y-m-d');
  $article->kategorija=$_POST['selCategory'];
 
  $article->insert();
  header("Location: admin.php?id=2&cat=dodaj_clanak.php");
}

//brisanje clanka
if(isset($_POST['delete']) && !empty($_POST['brisi'])){
	$db = Singleton::getInstance();
	$conn = $db->conn;
 	$checkboxes = implode("','",$_POST['brisi']);
	$prep = $conn->prepare("delete from tekstovi where id in ('$checkboxes')");
	$prep->execute();
  header("Location: admin.php?id=3");
}

//izmena clanka
if(isset($_POST['izmeni'])) {
  $article = new Tekst();
  $file_tmp = $_FILES['img']['tmp_name'];
  $naslov = $_POST['naslov'];
  $search = array("?",":","ć","Ć");
  $replace = array("","-","c","C");
  $naslov = str_replace($search, $replace,$naslov);
  $article->naslov=ucfirst($naslov);
  $article->id=$_POST['id'];
  $article->tekst=addslashes($_POST['text']);
  $article->datum=$_POST['datum'];
  $article->kategorija=$_POST['selCategory'];
  $output = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $naslov); 
  if(!file_exists("../images/main/".$output.".jpeg")){
    $img = new abeautifulsite\SimpleImage($file_tmp);
  $img->best_fit(1000, 450)->mean_remove()->save("../images/main/".$output.".jpeg");
  $img->best_fit(130, 90)->mean_remove()->save("../images/small/".$output.".jpeg");
  }
  
  $article->update();
  header("Location: admin.php?id=3");
}

//dodavanje takmicara
if(isset($_POST['dodaj_takmicara'])) {
  $article = new Takmicar();
  $article->ime=ucfirst($_POST['ime']);
  $article->tekst=addslashes($_POST['text']);
  $article->rodjen=$_POST['rodjen'];
  $article->visina=$_POST['visina'];
  $article->tezina=$_POST['tezina'];
  $article->titule=$_POST['titule'];
  $article->mesto=$_POST['mesto'];
  $file_tmp = $_FILES['img']['tmp_name'];
  $file_type_explode = explode("/",$_FILES['img']['type']);
  $file_type = ".".$file_type_explode[1];
  $ime = $_POST['ime'];
  $ime = str_replace("ć","c",$ime);
  $ime = str_replace("Ć","c",$ime);
  $output = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $_POST['ime']); 
  move_uploaded_file($file_tmp, "../images/takmicari/".$output.$file_type);
  $slika = $_POST['slika'];
  $article->slika = $output.$file_type;
  $article->insert();
  header("Location: admin.php?id=2&cat=dodaj_takmicara.php");
}

//izmena takmicara
if(isset($_POST['izmeni_takmicara'])) {
  $article = new Takmicar();
  $article->id=$_POST['id'];
  $article->ime=ucfirst($_POST['ime']);
  $article->tekst=addslashes($_POST['text']);
  $article->rodjen=$_POST['rodjen'];
  $article->visina=$_POST['visina'];
  $article->tezina=$_POST['tezina'];
  $article->titule=$_POST['titule'];
  $article->mesto=$_POST['mesto'];
  $file_tmp = $_FILES['img']['tmp_name'];
  $file_name = $_FILES['img']['name'];
  $file_type_explode = explode("/",$_FILES['img']['type']);
  $file_type = ".".$file_type_explode[1];
  $ime = $_POST['ime'];
  $ime = str_replace("ć","c",$ime);
  $ime = str_replace("Ć","c",$ime);
  $output = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ime); 
  move_uploaded_file($file_tmp, "../images/takmicari/".$output.$file_type);
  $slika = $_POST['slika'];
  $article->slika = file_exists("../images/takmicari/".$slika)?"{$slika}":$ime.$file_type; 
  $article->update();
  header("Location: admin.php?id=2&cat=dodaj_takmicara.php");
}

//prihvatanje komentara
if(isset($_GET['dodajkom'])){
  $kom = new Komentar();
  $kom->komentar_id=$_GET['dodajkom'];
  $kom->status="1";
  $kom->update();
  header("Location: admin.php?id=2");
}

//brisanje komentara
if(isset($_GET['brisikom'])){
  $db = Singleton::getInstance();
  $conn = $db->conn;
  $id = $_GET['brisikom'];
  $q=$conn->query("delete from komentari where komentar_id='{$id}'");
  header("Location: admin.php?id=2");
}

//dodavanje motivacije
if(isset($_POST['dodaj_motivacion'])){
  $mot = new Motivation();
  $mot->text=$_POST['motivacion'];
  $mot->status="0";
  $mot->insert();
  header("Location: admin.php?id=2&cat=dodaj_motivaciju.php");
}

//aktiviranje motivacije
if(isset($_POST['update_motivation'])){
  $db = Singleton::getInstance();
  $conn = $db->conn;
  $prep=$conn->prepare("update motivation_quote set status=0");
  $prep->execute();
  $id = $_POST["id"];
  $a=$conn->prepare("update motivation_quote set status=1 where id={$id}");
  $a->execute();
  header("Location: admin.php?id=2&cat=dodaj_motivaciju.php");
}

//brisanje motivacije
if(isset($_POST['delete_motivation'])){
  $db = Singleton::getInstance();
  $conn = $db->conn;
   $id = $_POST["id"];
   $prep=$conn->prepare("delete from motivation_quote where id={$id}");
  $prep->execute();
    header("Location: admin.php?id=2&cat=dodaj_motivaciju.php");
}

//dodavanje teretane
if(isset($_POST['teretana'])){
  $ter = new Teretana();
  $ter->naziv=$_POST['naziv'];
  $ter->adresa=$_POST['adresa'];
  $ter->lat=$_POST['lat'];
  $ter->lon=$_POST['lon'];
  $ter->opis=$_POST['opis'];
  $ter->insert();
  header("Location: admin.php?id=2&cat=dodaj_teretanu.php");
}

//dodavanje vezbe
if(isset($_POST['dodaj_vezbu'])){
  $vezba = new Vezbe();
  $naziv = $_POST['naziv'];
  $search = array("?",":","ć","Ć");
  $replace = array("","-","c","C");
  $naziv = str_replace($search, $replace,$naziv);
  $output = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $naziv); 
  $file_tmp = $_FILES['img']['tmp_name'];
  $img = new abeautifulsite\SimpleImage($file_tmp);
  $img->best_fit(500, 400)->mean_remove()->save("../images/vezbe/".$output.".jpg");
  $vezba->naziv= $naziv;
  $vezba->tekst=$_POST['tekst'];
  $vezba->kategorija=$_POST['kategorije'];
  $vezba->insert();
  header("Location: admin.php?id=2&cat=dodaj_vezbu.php");
}

//dodavanje korisnika
if(isset($_GET['dodajkorisnika'])){
  $kor = new Users();
  $kor->id=$_GET['dodajkorisnika'];
  $kor->status="1";
  $kor->update();
  header("Location: admin.php?id=2");
}

//brisanje korisnika
if(isset($_GET['brisikorisnika'])){
  $db = Singleton::getInstance();
  $conn = $db->conn;
  $id = $_GET['brisikorisnika'];
  $q=$conn->query("delete from users where id='{$id}'");
  header("Location: admin.php?id=2");
}

//dodavanje admina
if(isset($_POST['dodajadmina'])){
  $kor = new Users();
  $kor->id=$_POST['admin'];
  $kor->status="2";
  $kor->update();
  header("Location: admin.php?id=2");
}

//brisanje admina
if(isset($_GET['brisiadmina'])){
  $kor = new Users();
  $kor->id=$_GET['brisiadmina'];
  $kor->status="1";
  $kor->update();
  header("Location: admin.php?id=2");
}