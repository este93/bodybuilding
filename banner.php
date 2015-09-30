<div id="banner">
	<div id="slider">
		<?php 
			$banner = Tekst::getSomething("id,naslov","order by rand() limit 4");
			foreach($banner as $row){
				$naslov = $row->naslov;
				$naslovSanitize = Functions::titleSanitize($naslov);
				?>
				<div>
	  				<a href="<?php echo $naslov; ?>">
	  					<img src="images/main/<?php echo $naslovSanitize.".jpeg"; ?>"/>
	  				</a>
	  				<div class="text"><a href="<?php echo $naslov; ?>"><?php echo $naslov; ?></a>
	  				</div>
	 			 </div>
				<?php
			}
		?>
	</div>	<!-- end of #slider -->
</div><!-- end of #banner -->

<div id="motivation_quote">
	<h2>
	<?php  
		$prep = new Motivation();
		$motivation = $prep->getId("1","status");
		$txt = str_replace("q","<span class='mq_span'>",$motivation->text); 
		$txt = str_replace("Q","</span>",$txt); 
		echo "<h2>".$txt."</h2>";
	?>
</div><!-- end of #motivation_quote -->