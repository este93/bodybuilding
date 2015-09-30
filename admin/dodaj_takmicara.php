<div id="add_text">
<?php 
	if(isset($_GET['tak']))	{
		$takmicar=$_GET['tak']; 
		$q=Takmicar::getId($takmicar,"ime");
		$id = $q->id;
		$ime = $q->ime;
		$text = $q->tekst;
		$datum = $q->rodjen;
		$visina = $q->visina;
		$tezina = $q->tezina;
		$titule = $q->titule;
		$slika = $q->slika;
		$mesto = $q->mesto;
	}
	if(isset($slika)){ ?>
		<div style="position:relative;">
	 		<img src="../images/takmicari/<?php echo $slika;?>" width="100" style="position:absolute;right:0;">
		</div>
	<?php
		}
?>
	<form method="post" action="process.php" name="form" enctype="multipart/form-data" accept-charset="utf-8">
		<label for="selTakmicar">Izmeni takmičara:</label>
		<input type="hidden" value="<?php echo isset($_GET['tak'])?$id:null; ?>" name="id" />
		<select name="selCategory" id="takmicari" onchange="window.location='?id=2&cat=<?php echo $_GET['cat']; ?>&tak='+this.value">
			<option value="">Takmičari:</option>
			<?php
				$q=Takmicar::getAll();
				foreach($q as $rw){
				  echo "<option ".($_GET['tak']==$rw->ime?"selected":"")." value='{$rw->ime}'>".$rw->ime."</option>";
				} ?>
		</select>
		 </br></br> 
		<input type="hidden" name="slika" value="<?php echo isset($_GET['tak'])?$slika:null; ?>" >
		<label for="ime">Ime:</label>
		<input type="text" id="ime" <?php echo isset($_GET['tak'])?"value='{$ime}'":'' ?> name="ime" size="30" required> </br></br> 
		<input type="hidden" name="slika" value="<?php echo isset($_GET['tak'])?$slika:null; ?>" >
		<label for="img">Profil slika:</label>
		<input type="file" name="img"></br></br></br>
		<label for="datum">Datum rodjenja:</label>
		<input type="text" name="rodjen" id="datum" size="10" placeholder="dd. mm yyyy." <?php echo isset($_GET['tak'])?"value='{$datum}'":'' ?>>
		<label for="visina">Visina:</label>
		<input type="number" id="visina" name="visina" <?php echo isset($_GET['tak'])?"value='{$visina}'":'' ?> style="width: 50px;">
		<label for="tezina">Takmičarska težina:</label>
		<input type="number" id="tezina" name="tezina" style="width: 50px;" <?php echo isset($_GET['tak'])?"value='{$tezina}'":'' ?>>
		<label for="mesto">Mesto rođenja:</label>
		<input type="text" id="mesto" name="mesto" <?php echo isset($_GET['tak'])?"value='{$mesto}'":'' ?>>
		<label for="titule">Titule:</label>
		<input type="text" name="titule" id="titule" <?php echo isset($_GET['tak'])?"value='{$titule}'":'' ?>></br></br>
		<textarea name="text" id="text" cols="90" rows="30"><?php echo isset($_GET['tak'])?"{$text}":null; ?></textarea></br>
		<input type="submit" name="dodaj_takmicara" id="submit" class="graybtn" value="Submit" onClick="tinyMCE.triggerSave();">
		<input type="submit" name="izmeni_takmicara" id="submit" class="graybtn" value="Update" onClick="tinyMCE.triggerSave();">
	</form>
</div>