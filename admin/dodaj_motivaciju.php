Za bojenje u crveno ispred reci stavite 'q' na posle reci 'Q'
<div id="add_text">
	<form method="post" action="process.php">
		<input type="text" name="motivacion" size="100">
		<input type="submit" name="dodaj_motivacion" value="Dodaj" class="graybtn">
	</form>
</div>
<?php  
	$prep = new Motivation();
	$motivation = $prep->getAll();
	foreach($motivation as $motiv){
		$txt = str_replace("q","<span style='background:red;'>",$motiv->text); 
		$txt = str_replace("Q","</span>",$txt); 
		?>
		<form action="process.php" method="post" id="<?php echo $motiv->id;?>">
			<label for="motiv_status"><?php if($motiv->status == 1) echo "<b style='color:yellow;'>AKTIVNA </b> | ";?><?php echo $txt; ?></label>
			<input type="hidden" value="<?php echo $motiv->id;?>" name="id">
			<input type="submit" name="update_motivation" value="Aktiviraj" class="graybtn">	
			<input type="submit" name="delete_motivation" value="Izbrisi" class="graybtn">	
			<input type="submit" name="deactivate_motivation" value="Deaktiviraj" class="graybtn">	
		</form>
		<?php
	}
?>
