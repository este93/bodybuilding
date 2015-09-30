<?php
define("DB", "bodybuilding");
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");


function __autoload($name) {
	require_once "classes/" . $name . ".php";
} 

