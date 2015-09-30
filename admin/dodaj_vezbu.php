<?php 
	$db = Singleton::getInstance();
	$conn = $db->conn;
	$misic = $conn->query("select * from misicne_partije");
?>
<style>
	#dodaj_vezbu{
		text-align: center;
		font-size: 16px;
	}
</style>
<div id="dodaj_vezbu">
	<h2>Dodaj Vezbu</h2><br>
	<form action="process.php" method="post" enctype="multipart/form-data" accept-charset="utf-8">
		Naziv vezbe: <input type="text" name="naziv"> <br><br>
		Slika: <input type="file" name="img"></br></br>
		Opis vezbe: <br><textarea name="tekst" id="" cols="30" rows="10"></textarea>
		Kategorija: <select name="kategorije" id="">
			<?php 
				while($row = $misic->fetchObject()){ 
					echo "<option value='{$row->id}'>".strtoupper($row->naziv)."</option>";
				}
			?>
		</select>
		<input type="submit" name="dodaj_vezbu" class="graybtn">
	</form>
</div>
