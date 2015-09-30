<?php
require_once "../config.php";

$pages = array (
	"1"=>array(
			"name"=>"Početna",
			"document"=>"home.php",
			"icon"=>"fa fa-home"
		),
	"2"=>array(
			"name"=>"Dodaj",
			"document"=>"dodaj.php",
			"submenu"=>array(
				"dodaj članak"=>"dodaj_clanak.php",
				"dodaj takmičara"=>"dodaj_takmicara.php",
				"dodaj motivaciju"=>"dodaj_motivaciju.php",
				"dodaj anketu"=>"dodaj_anketu.php",
				"dodaj teretanu"=>"dodaj_teretanu.php",
				"dodaj vezbu"=>"dodaj_vezbu.php"
				),
			"icon"=>"fa fa-plus"
		),
	"3"=>array(
			"name"=>"Članci",
			"document"=>"tekstovi.php",
			"submenu"=>array(),
			"icon"=>"fa fa-file-o"
		),
		
);
$kategorija = Kategorija::getAll();
foreach($kategorija as $kat){
	$pages[3]['submenu'][$kat->kategorija] = $kat->kategorija;
}
