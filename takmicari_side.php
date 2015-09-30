<?php
require_once "config.php";
$takmicar = $_GET['tak'];
$row = Takmicar::getId($takmicar,"ime");
?>
<div id="t_side">
	<div id="t_side_img">
		<img src="images/takmicari/<?php echo $row->slika; ?>">
	</div>
</div>
<div id="b_side">
	<dl>
		<dt>IME</dt>
			<dd><?php echo $row->ime; ?></dd>
		<dt>GODINA ROĐENJA</dt>
			<dd><?php echo $row->rodjen; ?></dd>	
		<dt>MESTO ROĐENJA</dt>
			<dd><?php echo $row->mesto; ?></dd>		
		<dt>VISINA</dt>
			<dd><?php echo $row->visina; ?> cm</dd>	
		<dt>TAKMIČARSKA TEŽINA</dt>
			<dd><?php echo $row->tezina; ?> kg</dd>	
		<dt>TITULE</dt>
			<dd><?php echo $row->titule; ?></dd>	
	</dl>
</div>