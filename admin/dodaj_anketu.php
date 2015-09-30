<script> 
	var i =1;
	function add(){
		$("#odg").append("<input type='text' name='odg"+i+"'/>");
		i++;
	}
</script>
<script>
	$(function(){
		$("#dodaj").click(function(){
			$("#ankete").hide(500);
			$("#dodaj_anketu").show(500);
		})
	})
</script>
<script>
	$(function(){
		$("#nazad").click(function(){
			$("#ankete").show(500);
			$("#dodaj_anketu").hide(500);
		})
	})
</script>
<div id="polls">
	<div id="ankete" style="padding:10px;">
	<div style="float:left; margin-bottom: 10px;">
		<button class="graybtn" id="dodaj">Dodaj novu anketu</button>
		<input type="submit" name="delete" value="Izbrisi anketu" form="forma" class="graybtn">
		<input type="submit" name="edit" value="Aktiviraj anketu" form="forma" class="graybtn">
	</div>
	<table id="tabela">
		<thead>
			<tr>
				<th>ID</th>
				<th>Status</th>
				<th>Naslov</th>
				<th>Izbrisi</th>
				<th>Aktiviraj</th>
			</tr>
		</thead>
		<form action="anketa_process.php" method="post" id="forma">
		<?php 
			$ankete = Anketa::getAll();
			foreach($ankete as $anketa){ 
				if($anketa->status == 1)
					$anketa->status = "aktivna";
				else 
					$anketa->status = "neaktivna";
		?>
				<tr>
					<td><?php echo $anketa->pitanje_id; ?></td>
					<td><?php echo $anketa->status; ?></td>
					<td><?php echo $anketa->pitanje; ?></td>
					<td>				
						<input type="checkbox" name="brisi[]" value="<?php echo $anketa->pitanje_id; ?>">					
					</td>
					<td>
						<input type="radio" name="izmeni" value="<?php echo $anketa->pitanje_id; ?>">
					</td>
				</tr>
		<?php 
			}
		?>
		</form>
	</table>
</div> <!-- end of ankete -->

<div id="dodaj_anketu" style="display:none;">
	<form action="anketa_process.php" method="post">
		<label for="naslov_ankete">Naslov ankete:</label><br>
		<input type="text" name="naslov_ankete" id="naslov_ankete"><br>
		<div id="anketa_odgovori">
			<div id="odg_header">
				<div style="float:left">Ponudjeni odgovori:</div>
				<div id="anketa_controls">
					<i class="fa fa-plus" onclick="add()"></i>
				</div>
			</div>
			<div id="odg">
			</div>
		</div><br><br>
		<input type="submit" name="dodaj" class="graybtn" value="Sacuvaj">
		
	</form><button class="graybtn" style="margin-left:10px;" id="nazad">Nazad</button>
</div> <!-- end of div #dodaj_anketu -->

<div id="anketa" style="display:none;">
	<?php
		$conn = new PDO("mysql:host=localhost;dbname=bodybuilding;charset=utf8","root","");
		$q = $conn->query("select * from anketa_pitanja where status=1");
		$row = $q->fetchObject();
		$pitanje_id=$row->pitanje_id;
	?>
	<div id="pool_q">
		<fieldset>
			<legend><h3><?php echo $row->pitanje;?></h3></legend>
			<form id="myForm" name="form" method="post" action=""> 
			<?php 
				$q = $conn->query("select * from anketa_odgovori where id_pitanja=$pitanje_id");
				while($row=$q->fetchObject()){
					$odgovor_id = $row->odgovor_id;
					echo "<input type='radio' value='{$odgovor_id}' id='pool' name='pool'>{$row->odgovor}<br>";
					echo "<input type='hidden' value='$odgovor_id' name='hidden_id'>";
				};
			?>
				<input type="submit" name="glasaj" value="Glasaj">
			</form>	
		</fieldset>
	</div>
	<div id="pool_r" style="display:none;">
		<?php 
			$q = $conn->query("select * from anketa_odgovori where id_pitanja=$pitanje_id");
			while($row=$q->fetchObject()){
				$odgovor_id = $row->odgovor_id;
				$qa = $conn->query("select count(*) as total from anketa_glasanja where id_odgovora=$odgovor_id");
				$lkl = $conn->query("select count(*) as total from anketa_glasanja where id_odgovora in(select odgovor_id from anketa_odgovori where id_pitanja=$pitanje_id)");
				$ppp = $lkl->fetchObject();
				$sum = $ppp->total; 
				$rt = $qa->fetchObject();
				$now = $rt->total;
				$percent = round(($now*100)/$sum);
			echo $row->odgovor." <img src='poll.gif' alt='' width='$percent' height='20' style='min-width:1px;'> $percent %<br>";
			}; 
		?>
	</div>
</div>
</div>
