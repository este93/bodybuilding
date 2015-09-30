<?php 
require_once "../config.php"; 
$db = Singleton::getInstance();
$conn = $db->conn;
?>
<table id="tabela">
	<thead>
		<tr>
			<th>
				All
			</th>
			<th width="6%">
				ID
			</th>
			<th width="11%">
				Kategorija
			</th>
			<th>
				Naslov
			</th>
			<th>
				Datum
			</th>
			<th width='15%'>
				Kontrole
			</th>
		</tr>
		<tr class="head_input">
			<td>
				<?php 
					$y = isset($_GET['cat'])?"where kategorija='{$_GET['cat']}'":"";
					$result = $conn->query("select count(*) as `c` from `tekstovi` ". $y);
					$count = $result->fetchObject()->c;
					echo $count;
				?>
			</td>
			<td>
				<input type="text" class="id_input">
			</td>
			<td>
				<select onchange="window.location='?id=3&cat='+this.value" name="selCategory" id="kategorija">
					<option value="a">Izaberi kategoriju</option>
					<?php
						$q = Kategorija::getAll();
						foreach($q as $rw){
		  					echo "<option ".($_GET['cat']==$rw->kategorija?"selected":"")." value='{$rw->kategorija}'>".ucfirst($rw->kategorija)."</option>";
					} ?>
				</select>
			</td>
			<td>
				<form action="" method="get" id="search">
					<input type="hidden" name="id" value="3">
					<?php if(isset($_GET['cat'])){ ?>
						<input type="hidden" name="cat" value="<?php echo $_GET['cat']; ?>">
					<?php } ?>
					<input type="text" name="pretraga">
				</form>
			</td>
			<td>
				<input type="date">
			</td>
			<td>
				<input type="submit" form="delete_forma" value="Izbrisi" name="delete">
			</td>
		</tr>
	</thead>
	<tbody>
		<form action="process.php" method="post" id="delete_forma">
	<?php 
		if(isset($_GET['cat'])&&isset($_GET['pretraga'])){
	 		$y = "where kategorije.kategorija='{$_GET['cat']}' ";
	 		$search = explode(" ", $_GET['pretraga']);
			foreach($search as $word){
	 			$y.="AND naslov like '%$word%' ";
	 		}
		}else if(isset($_GET['cat'])){
			$y = "where kategorije.kategorija='{$_GET['cat']}'";
	 	}else if (isset($_GET['pretraga'])){
			$y = "where 1=1 ";
			$search = explode(" ", $_GET['pretraga']);
			foreach($search as $word){
	 			$y.="AND naslov like '%$word%'";
	 		}
	 	}
		$text = $conn->query("select id,naslov,datum,kategorije.kategorija from kategorije left join tekstovi on kategorije.kategorija_id=tekstovi.kategorija ".$y." order by id"); 
		while($rw = $text->fetchObject()){
			$date = new DateTime($rw->datum);
			$selected_id = isset($_GET['uid'])?$_GET['uid']:null;
		?>
		<tr>
			<td>
				<input type="checkbox" id="checker" name="brisi[]" value="<?php echo $rw->id; ?>">
			</td>
			<td><?php echo $rw->id; ?></td>
			<td><?php echo ucfirst($rw->kategorija); ?></td>
			<td><?php echo $rw->naslov; ?></td>
			<td><?php echo $date->format('d.m.Y'); ?></td>
			<td>
				<input onchange="window.location='?id=3&uid='+this.value" type="checkbox" id="checker" value="<?php echo $rw->id; ?>" <?php echo $selected_id==$rw->id?"checked":""; ?>>
				<div class="izmeni">
					<i class="faa fa fa-pencil"></i>
					<a href="admin.php?id=2&cat=dodaj_clanak.php<?php echo isset($_GET['uid'])?"&uid={$_GET['uid']}":null; ?>" class="izmeni_a">Izmeni</a>
				</div>
				
			</td>
		</tr>
		<?php
			}
 		?>
		</form>
	</tbody>
</table>
