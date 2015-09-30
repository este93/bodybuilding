<?php
require_once "config.php"; 
$takmicar = $_GET['tak'];
$row = Takmicar::getId($takmicar,"ime");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/takmicari.css">
</head>
<body>
	<div id="t_main">
		<h1><?php echo $row->ime; ?></h1>
		<h2><span class="siva">Biografija</span></h2>
		<h3>(<?php echo $row->rodjen; ?> -)</h3>
		<hr style="background-color: rgba(51,51,51,0.2);  ">
		<?php echo $row->tekst;?>
	</div>
</body>
</html>
