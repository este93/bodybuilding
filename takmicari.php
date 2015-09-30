<?php 
	require "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bodybuilding Serbia</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/takmicari.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="javascript/takmicari.js"></script>
	<script src="javascript/jquery.easing.1.2.js"></script>
</head>
<body>
	<div id="container">
		<?php include('header.php'); ?>
		<div id="takmicari_div">
		    <section id="grid" class="grid clearfix">
		       <?php
					$takmicari = Takmicar::getAll();
						foreach($takmicari as $row){
						?>
						<a class="klasa<?php echo $row->id; ?><?php echo (($row->id)>'6')?" parno":null; ?>" href="index.php?tak=<?php echo $row->ime;?>" data-path-hover="m 180,34.57627 -180,0 L 0,0 180,0 z">
			            <figure>
			                <img src="images/takmicari/<?php echo $row->ime; ?>.jpg" />
			                <svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="M 180,160 0,110 0,0 180,0 z"/></svg>
			                <figcaption>
			                    <h2><?php echo $row->ime; ?></h2>
			                    <p>Rođen: <?php echo $row->rodjen; ?></br>
			                       Visina: <?php echo $row->visina; ?> cm</br>
			                       Takmičarska težina: <?php echo $row->tezina; ?> kg</br>
			                       <?php echo $row->titule; ?></p>
			                </figcaption>
			            </figure>
			        	</a>
		        <?php
				 }
				?>
			</section>	
		</div> <!-- end of takmicari_div -->
		<script>
		(function() {
		    function init() {
		        var speed = 250,
		            easing = mina.easeinout;
		        [].slice.call ( document.querySelectorAll( '#grid > a' ) ).forEach( function( el ) {
		            var s = Snap( el.querySelector( 'svg' ) ), path = s.select( 'path' ),
		                pathConfig = {
		                    from : path.attr( 'd' ),
		                    to : el.getAttribute( 'data-path-hover' )
		                };
		            el.addEventListener( 'mouseenter', function() {
		                path.animate( { 'path' : pathConfig.to }, speed, easing );
		            } );
		            el.addEventListener( 'mouseleave', function() {
		                path.animate( { 'path' : pathConfig.from }, speed, easing );
		            } );
		        } );
		    }
		    init();
		})();
		</script> 
	</div>
</body>
</html>

