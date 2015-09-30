<?php 
	$teretane = Teretana::getAll();
?>
<script>
function initialize()
{
	var myCenter=new google.maps.LatLng(44.813883, 20.443132);
	var mapProp = {
	  center:myCenter,
	  zoom:13,
	  mapTypeId:google.maps.MapTypeId.ROADMAP
	  };
	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
	<?php 
		
		foreach($teretane as $row){?>
			var myLat=new google.maps.LatLng(<?php echo $row->lat; ?>,<?php echo $row->lon; ?>);
			var marker=new google.maps.Marker({
			  position:myLat,
			  title: '<?php echo $row->naziv; ?>',
			  icon: "misc/map_barbel.png"
			  });
			marker.setMap(map);
	<?php
	}
	?>
	google.maps.event.addListener(marker,'click',function() {
	  map.setZoom(16);
	  map.setCenter(marker.getPosition());
	  });
}
function loadScript()
{
  var script = document.createElement("script");
  script.type = "text/javascript";
  script.src = "http://maps.googleapis.com/maps/api/js?key=&sensor=false&callback=initialize";
  document.body.appendChild(script);
}

window.onload = loadScript;
</script>
<style>
	 #teretana{
	 	 border: 1px solid gray;
  		 padding: 5px;
  		font-family: "JosefinSans","Helvetica","Arial";
		background-color: white;
		color: black;

	 	}
	 #teretana h4{
	 	margin: 5px;
	 }
</style>
<h2 style="margin:10px;">Spisak teretana u Beogradu sa adresama i brojevima telefona.</h2>
<div id="googleMap" style="width:100%;height:380px;"></div>  
<div>
	<?php
		foreach($teretane as $row){ 
	?>
			<div id="teretana">
				<h4><?=$row->naziv; ?></h4>
				<p>Adresa: <?=$row->adresa; ?></p>
				<p><?=$row->opis; ?></p>
			</div>
	<?php
	} 
	?>
</div>
