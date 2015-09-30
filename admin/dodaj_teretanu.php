<script>
    var geocoder;
    var map;
    function initialize() {
      geocoder = new google.maps.Geocoder();
      var latlng = new google.maps.LatLng(44.813883, 20.443132);
      var mapOptions = {
        zoom: 14,
        center: latlng
      }
      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    }
    function codeAddress() {
      var address = document.getElementById('address').value;
      geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          map.setCenter(results[0].geometry.location);
          var marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location
          }); 
          document.getElementById('lat').innerHTML = results[0].geometry.location['A'].toFixed(6);
          document.getElementById('lon').innerHTML = results[0].geometry.location['F'].toFixed(6);
        } else {
          alert('Geocode was not successful for the following reason: ' + status);
        }
      });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
  </script>
  <div id="teretane_main">
    <fieldset>
      <legend>Dodaj teretanu: </legend>
       <form action="process.php" method="post">
        Naziv: <input type="text" name="naziv"><br>
        Adresa: <input type="text" name="adresa"><br>
        Lat: <input type="text" name="lat"><br>
        Lon: <input type="text" name="lon"><br>
        Opis: <textarea name="opis" id="" cols="30" rows="10"></textarea>
        <input type="submit" value="Unesi" name="teretana" class="graybtn">
      </form>
    </fieldset>

  <div id="lat_lon">
    <h3>LAT: </h3>
    <div id="lat"></div>
    <h3>LON: </h3>
    <div id="lon"></div>
  </div>

  <div id="panel">
    <input id="address" type="textbox" value="">
    <input type="button" value="Trazi" onclick="codeAddress()">
  </div>
  <div id="map-canvas"></div>

  <div id="teretane">
  <?php
  $teretane = Teretana::getAll();
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
</div>
