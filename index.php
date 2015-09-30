<?php 
	require_once "config.php"; 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"> 
	<title><?php echo isset($_GET['txt'])?$_GET['txt']:"Bodybuilding Serbia"; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="javascript/jquery.easing.1.2.js"></script>
	<link rel="stylesheet" href="css/anythingslider.css">
	<script src="javascript/jquery.anythingslider.js"></script>
	<script src="javascript/funkcije.js"></script>
	<link rel="stylesheet" href="css/theme-metallic.css">
	<script src="http://maps.googleapis.com/maps/api/js"></script>
	<script type="text/javascript">
		$(function(){
		 $('#slider')
		   .anythingSlider({
		   		theme: "metallic", 
		   		 expand: true,
			    autoPlay: true,
			    autoPlayLocked: true,
				hashTags: false,
				buildNavigation: false,
			    delay: 4000,
			    resumeDelay: 15000,
			    animationTime: 800,
				buildStartStop: false,}) 
		});
	</script>
</head>
<body> 
	<div id="container"> 
		<?php
			include ("header.php"); 
			$c = $_SERVER['REQUEST_URI'];
			if(basename($c, '.php')=="index" || $c =="" || basename($c)=="bodybuilding"){
				include ("banner.php");
			} 
		?>
	  <div id="main_wrap">	
		<div id="sidebar">
			<div id="sidebar_top"></div>
			<div id="sidebar_main">
				<?php 
					if(isset($_GET['tak'])){
						include ("takmicari_side.php"); 
					}else 
						include ("sidebar.php");  
				?>
			</div><!-- end of #sidebar_main -->
			<div id="sidebar_bottom"></div>
		</div><!-- end of #sidebar -->	
		<div id="main_content">
			<div id="maincontent_top"></div>
			<div id="maincontent_top2"></div>
			<div id="maincontent_body">

				<?php 
					if(isset($_GET['txt'])){
						include("prikaz.php"); 
					}elseif(isset($_GET['art'])){
						include("tekstovi.php");
					}elseif(isset($_GET['a']) && ($_GET['a'])=="teretane"){
						include("teretane.php");
					}elseif(isset($_GET['tak'])){
						include("takmicari_prikaz.php");
					}else {
						include("home.php"); 
					}
				?>
			</div><!-- end of #main_content_body -->
			<div id="maincontent_bottom"></div>
		</div><!-- end of #main_content -->
	  </div><!-- end of #main_wrap -->	
	  <div id="footer">
		    <div id="footer_main">	
				<nav>
					<a href="">Početna &nbsp;</a>
					<a href="">| Kontaktirajte nas &nbsp;</a>
					<a href="">| Blog</a> <br />
				</nav>
				<p><i>Copyright © <?php $date = new DateTime(); echo $date->format('Y'); ?> Bodybuilding Serbia, Inc.</i></p>
			</div>
	  </div>
	</div> <!-- end of #container -->   
</body>
</html>
