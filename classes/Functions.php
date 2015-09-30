<?php
class Functions{
	public static function titleSanitize($data){
		$search = array("Š","š","ć","Ć","Č","č","Ž","ž","đ","Đ","dž","Dž");
		$replace = array("S","s","c","C","C","c","Z","z","dj","Dj","dz","Dz");
		$data = str_replace($search, $replace,$data);
		//$data = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $data); 
		return $data;
	}
}