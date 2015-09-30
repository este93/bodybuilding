<?php 
require "config.php"; 
$db = Singleton::getInstance();
$conn = $db->conn;
?>

<ul id="najnovije">
	<?php
		$side = Tekst::getSomething("id,naslov,datum","limit 4");
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

<ul id="najcitanije">
<?php
		$side = Tekst::getSomething("id,naslov,datum","order by datum DESC limit 4");
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

<ul id="komentari">
	<?php
		$side = Komentar::getAll("where status = 1 order by datum desc");
		foreach($side as $text) {
			$date = new DateTime($text->datum);
	?>
			<li class="koment">
				<?php 
					echo $text->ime." - ".$text->komentar;
				?>
			</li>
	  <?php
	  	}
	?>
</ul>