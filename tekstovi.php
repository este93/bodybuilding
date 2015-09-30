<?php require_once "config.php";?>
<div id="articles">
<?php 
$articles = Tekst::getAll("where kategorija = '{$_GET['art']}' order by id desc");
foreach($articles as $article){  
	$naslov = Functions::titleSanitize($article->naslov);
	?>
	<article>
		<div class="article_img">
			<img src="images/main/<?php echo $naslov.".jpeg"; ?>" alt="">
		</div>
		<div class="article_text">
			<h2><?php echo $article->naslov; ?></h2>
			<?php 
				$tekst = strip_tags($article->tekst);
				echo (strlen($tekst)>400)?substr($tekst,0,400)."...":"$text->article";
			?>
		</div>
	</article>	
<?php
}
?>
</div>