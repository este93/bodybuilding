<?php 
require_once "config.php"; 
	$db = Singleton::getInstance();
	$conn = $db->conn;
	$misic = $conn->query("select * from misicne_partije");
	while($row = $misic->fetchObject()){ 
		echo "<div id='{$row->naziv}'>";
		$vezba = $conn->query("select * from vezbe where kategorija='{$row->id}'");
		while($row = $vezba->fetchObject()){ 
			$tekst = $row->tekst;
			$tekst = (strlen($tekst)>300)?substr($tekst,0,300)." ... <a href='#'>Procitaj ceo tekst</a>":$tekst;
			?>
			<div id='vezba'>
				<h4><?= $row->naziv; ?></h4>
				<img src="images/vezbe/<?= $row->naziv; ?>.jpg" alt="">
				<div id="vezba_txt"><?= strlen($row->tekst)>900?substr($row->tekst,0,900):$row->tekst; ?></div>
			</div>
		<?php
		}
		echo "</div>";
	
	}
?>
