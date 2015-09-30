<div id="add_text">
<?php 
	if(isset($_GET['uid']))	{
		$id=$_GET['uid']; 
		$q=Tekst::getId($id);
		$naslov = $q->naslov;
		$text = $q->tekst;
		$datum = $q->datum;
	}
?>
	<form method="post" action="process.php" name="form" enctype="multipart/form-data" accept-charset="utf-8">
		<label for="selCategory">Kategorija:</label>
		<input type="hidden" value="<?php echo isset($_GET['uid'])?$id:null; ?>" name="id" />
		<select name="selCategory" id="kategorija" required>
			<option><?php echo isset($id)?ucfirst($q->kategorija):"Izaberi kategoriju: "; ?></option>
			<?php
				$q=Kategorija::getAll();
				foreach($q as $rw){
				  echo "<option value='{$rw->kategorija_id}'>".ucfirst($rw->kategorija)."</option>";
				} ?>
		</select>
		 </br></br> 
		<label for="naslov">Naslov:</label>
		<input type="hidden" name="datum" value="<?php echo isset($_GET['uid'])?$datum:null; ?>" >
		<input type="hidden" name="slika" value="<?php echo isset($_GET['uid'])?$slika:null; ?>" >
		<input type="text" id="naslov" <?php echo isset($_GET['uid'])?"value='{$naslov}'":'' ?> name="naslov" size="50" required> </br></br> 
		<label for="img">Slika:</label>
		<input type="file" name="img"></br></br></br> 
		<textarea name="text" id="text" cols="90" rows="30" required><?php echo isset($_GET['uid'])?"{$text}":null; ?></textarea></br>
		<input type="submit" name="dodaj" id="submit" value="Dodaj" class="graybtn" onClick="tinyMCE.triggerSave();">
		<input type="submit" name="izmeni" id="submit" value="Izmeni" class="graybtn" onClick="tinyMCE.triggerSave();">
	</form>
</div>