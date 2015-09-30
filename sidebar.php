
<h1> Bodybuilding <span class="logo_span">Serbia<span></h1>
<form action="" method="get" class="sfm" name="theform">
    <input type="text" name="q" value="" id="sf" placeholder="PRETRAGA" onkeyup="showResult(this.value)" autocomplete="off"/>
    <div id="livesearch"></div>
</form>
<nav id="sidebar_nav">
	<ul>
		<li><a href="index.php">HOME</a></li>
		<li><a href="?a=teretane" id="teretane">TERETANE</a></li>
		<li><a href="?art=4">BLOG</a></li>
		<li><a href="takmicari.php">TAKMIČARI</a></li>
	</ul>
</nav>	
<div id="sidebar_news">
	<div id="sidebar_news_nav">
		<button class="najnovije">Najnovije</button>
		<button class="najcitanije">Najčitanije</button>
		<button class="komentari">Komentari</button>
	</div><!-- end of #sidebar_news_nav -->
	<div id="sidebar_news_main">
		<ul>
		<?php
			$side = Tekst::getSomething("id,naslov,datum","limit 4");
			$db = Singleton::getInstance();
			$conn = $db->conn;
			foreach($side as $text) {
				$date = new DateTime($text->datum);
				$naslov = Functions::titleSanitize($text->naslov);
				$q = $conn->query("select count(komentar_id) as broj,tekst_id from komentari where tekst_id={$text->id} and status<>0");
				$koment = $q->fetchObject();	
		?>
				<li class="news">
					<div class="news_img">
						<a href="<?php echo $naslov; ?>">
							<img src="images/small/<?php echo $naslov.".jpeg"; ?>" alt="">
						</a>
					</div>
					<div class="news_text">
						<a href="<?php echo $naslov; ?>"><h3><?php echo $text->naslov; ?></h3></a>
						<span class="datum"><?php echo $date->format('d.m.Y'); ?> | <?php echo ($koment->broj === "1")?$koment->broj." komentar":$koment->broj." komentara";?></span>
					</div>
				</li>
		  <?php
		  	}
		?>
		</ul>
	</div><!-- end of #sidebar_news_main -->
</div><!-- end of #sidebar_news -->

<div id="poll">
	<?php
		$db = Singleton::getInstance();
		$conn = $db->conn;
		$q = $conn->query("select * from anketa_pitanja where status=1");
		$row = $q->fetchObject();
		$pitanje_id=$row->pitanje_id;
	?>
	<div id="poll_q">
		<fieldset>
			<legend><h3><?php echo $row->pitanje;?></h3></legend>
			<form id="myForm" name="form" method="post" action=""> 
			<?php 
				$q = $conn->query("select * from anketa_odgovori where id_pitanja=$pitanje_id");
				while($row=$q->fetchObject()){
					$odgovor_id = $row->odgovor_id;
					echo "<input type='radio' value='{$odgovor_id}' class='pool' name='pool' id='{$odgovor_id}'>
						<label for='{$odgovor_id}'>{$row->odgovor}</label><br>";
				};
			?>
				<input type="submit" name="glasaj" value="Glasaj">
			</form>	
		</fieldset>
	</div>
	<div id="results" style="display:none; padding: 10px; border: 1px solid #ccc; -webkit-border-radius: 12px; -moz-border-radius: 12px; border-radius: 12px;">
		<h4 id = "anketa_response" style="border-bottom: 1px solid #e8e8e8; margin-bottom: 15px; padding-bottom: 10px;">Hvala na glasanju</h4>
		<?php 
			$q = $conn->query("select * from anketa_odgovori where id_pitanja=$pitanje_id");
			while($row=$q->fetchObject()){
				$odgovor_id = $row->odgovor_id;
				$count_single = $conn->query("select count(*) as total from anketa_glasanja where id_odgovora=$odgovor_id");
				$count_total = $conn->query("select count(*) as total from anketa_glasanja where id_odgovora in(select odgovor_id from anketa_odgovori where id_pitanja=$pitanje_id)");
				$count_total_fetch = $count_total->fetchObject();
				if($count_total_fetch->total==0) $sum = 1;
				else $sum = $count_total_fetch->total; 
				$count_single_fetch = $count_single->fetchObject();
				$current = $count_single_fetch->total;
				$percent = round(($current*100)/$sum); 
			?>
				<div>
					<p style='float:left;'><?php echo $row->odgovor;?></p>
					<p style='float:right;'><b><?php echo $percent."%";?></b><?=" (".$current." votes)";?></p>
					<div style='background-color: #f1f1f1; border: 1px solid #d1d1d1; clear: both;'>
						<div style='font-size: 2px; width: <?php echo $percent;?>%; background: #343434; height: 18px;'></div>
					</div>
				</div>
			<?php
			}; 
		?> 
		<p style="margin-top: 10px;">Ukupno glasova: <b><?php echo $sum;?></b></p>
		<button id="anketa_nazad">Vrati se na anketu</button>
	</div>
		
</div>