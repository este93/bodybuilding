
<?php
$db = Singleton::getInstance();
$conn = $db->conn;
$kategorija = Kategorija::getAll();
$x=0; 
foreach($kategorija as $kat){ 
?>
	<section class="column"> 
	<?php  
		$text = Tekst::getAll("where kategorija = '{$kat->kategorija_id}' order by id DESC limit 4");
		$datum = new DateTime($text[0]->datum);	
	?>	
		<article class="column_top">
			<div class="folded <?php echo (($x++)%2==0)?"folded_left":"folded_right"; ?>">
				<h2><a href="?art=<?php echo $kat->kategorija_id; ?>"><?php echo(ucfirst($kat->kategorija)); ?></a></h2>
			</div>
			<div class="column_top_img">
				<?php 
					$naslov = $text[0]->naslov;
					$naslovSanitize = Functions::titleSanitize($naslov);
					$id = $text[0]->id;
					$q = $conn->query("select count(komentar_id) as broj,tekst_id from komentari where tekst_id={$id} and status<>0");
					$koment = $q->fetchObject();					
				?>
				<a href="<?php echo $naslov; ?>">
					<img src="images/main/<?php echo $naslovSanitize.".jpeg"; ?>" alt="<?php echo $text[$i]->naslov; ?>">
				</a> 
			</div><!-- end of #column_top_img -->
			<div class="column_top_text">
				<div class="column_top_text_h2">
					<a href="<?php echo $naslov; ?>">
						<h2><?php echo $naslov; ?></h2>
					</a>
					<span class="datum">
						<?php echo $datum->format("d. F. Y."); ?> | <?php echo ($koment->broj === "1")?$koment->broj." komentar":$koment->broj." komentara";?>
					</span>
				</div>
				<div class="column_top_p">
					<?php
						$tekst = strip_tags($text[0]->tekst);
						$txt = (strlen($tekst)>130)?substr($tekst,0,130)."... <a href='$naslov'>Procitaj tekst</a>":"$tekst";
						echo $txt;
					?>
				</div><!-- end of #column_top_p -->
			</div><!-- end of #column_top_text -->
		</article><!-- end of #column_top -->
		<?php 
		for($i=1; $i<4; $i++){
			$id = $text[$i]->id;
			$q = $conn->query("select count(komentar_id) as broj,tekst_id from komentari where tekst_id={$id} and status<>0");
			$koment = $q->fetchObject();
			$naslov = $text[$i]->naslov;
			$naslovSanitize = Functions::titleSanitize($naslov);
		?>
			<article class="column_article">
				<div class="column_article_img">
					<a href="<?php echo $naslov; ?>">
						<img src="images/small/<?php echo $naslovSanitize.".jpeg"; ?>" alt="<?php echo $naslov; ?>">
					</a>
				</div>
				<div class="column_article_text">
					<?php $datum = new DateTime($text[$i]->datum); ?>
					<p><?php echo $naslov; ?></p>
					<span class="datum"><?php echo $datum->format("d.F.Y."); ?> | <?php echo ($koment->broj === "1")?$koment->broj." komentar":$koment->broj." komentara";?></span>
				</div>
			</article><!-- end of #column_article -->
		<?php
		}
		?>
	</section><!-- end of #column -->
<?php	
}
?>	