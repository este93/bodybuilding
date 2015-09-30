<?php
$db = Singleton::getInstance();
$conn = $db->conn;
 if(isset($_GET['cat'])){
 	$inc = $_GET['cat'];
 	include $inc;
 }else {
?>
<h2>Komentari na cekanju:</h2><br>
<table id="tabela">
	<tr>
		<td>Kom.ID</td>
		<td>Članak</td>
		<td>Ime</td>
		<td>E-mail</td>
		<td>Komentar</td>
		<td>Datum</td>
		<td>Dodaj/izbrisi komentar</td>
	</tr>

<?php 
$q = "select komentar_id,tekstovi.id,naslov,email,ime,komentar,date_format(komentari.datum, '%d %b %Y u %T') as datum from komentari left join tekstovi on tekst_id=tekstovi.id where status='0'";
$query = $conn->prepare($q);
$query->execute();
while($rw = $query->fetchObject()){?>
	<tr>
		<td><?= $rw->komentar_id; ?></td>
		<td><?= $rw->naslov; ?></td>
		<td><?= $rw->ime; ?></td>
		<td><?= $rw->email; ?></td>
		<td><?= $rw->komentar; ?></td>
		<td><?= $rw->datum; ?></td>
		<td>
			<a href="process.php?brisikom=<?php echo $rw->komentar_id; ?>"><img src="../misc/block.png"></a>
			<a href="process.php?dodajkom=<?php echo $rw->komentar_id; ?>"><img src="../misc/approve.png"></a>
		</td>
	</tr>
	<?php
}
?>
</table>

<br><br><h2>Korisnici na cekanju: </h2><br>
<table id="tabela">
	<tr>
		<td>Korisnik ID</td>
		<td>Username</td>
		<td>Email</td>
		<td>Dodaj/izbrisi korisnika</td>
	</tr>

<?php 
$q = "select * from users where status = 0";
$query = $conn->prepare($q);
$query->execute();
while($rw = $query->fetchObject()){?>
	<tr>
		<td><?= $rw->id; ?></td>
		<td><?= $rw->username; ?></td>
		<td><?= $rw->email; ?></td>
		<td>
			<a href="process.php?brisikorisnika=<?php echo $rw->id; ?>"><img src="../misc/block.png"></a>
			<a href="process.php?dodajkorisnika=<?php echo $rw->id; ?>"><img src="../misc/approve.png"></a>
		</td>
	</tr>
	<?php
}
?>
</table>
 <?php 
if(($mask&$status)==4){ 
?>
<br><br><h2>Dodaj admina: </h2><br>
<form method="post" action="process.php">
	<select name="admin">
		<option>Korisnici:</option>
		<?php 
		$q = "select * from users where status = 1";
		$query = $conn->query($q);
		while($rw = $query->fetchObject()){
		?>
		<option value="<?= $rw->id;?>">
			<?php echo $rw->username; ?>
		</option>
		<?php } ?>
	</select>
	<input type='submit' value='dodaj admina' name='dodajadmina'>
</form> <br>
<table id="tabela">
	<tr>
		<td>Admin ID</td>
		<td>Username</td>
		<td>Email</td>
		<td>Status</td>
		<td>Izbrisi admina</td>
	</tr>

<?php 
$q = "select * from users where status = 2 or status = 4";
$query = $conn->prepare($q);
$query->execute();
while($rw = $query->fetchObject()){
	if($rw->status == 2) $status = 'admin';
	elseif($rw->status == 4) $status = 'super-admin';
?>
	<tr>
		<td><?= $rw->id; ?></td>
		<td><?= $rw->username; ?></td>
		<td><?= $rw->email; ?></td>
		<td><?= $status; ?></td>
		<td>
			<a href="process.php?brisiadmina=<?php echo $rw->id; ?>"><img src="../misc/block.png"></a>
		</td>
	</tr>
	<?php
}
?>
</table>
<?php }
}