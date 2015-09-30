<!DOCTYPE html>
<html>
	<head> 
    <title>Vezbe</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/rotacija.css">
    <script src="javascript/rotacija.js"></script>
    <link rel="stylesheet" href="font-awesome-4.3.0/css/font-awesome.min.css">
	</head>
	<body>
    <div id="home" onclick="javascript:location.href='index.php'">
      <div id="pocetna">
        <i class="fa fa-home fa-3x"></i>POCETNA
      </div>
    </div>
    <div class="image-container">
      <div class="arrow-left" onClick='rotate("left",70)'></div>
      <div class="arrow-right" onClick='rotate("right",70)'></div>
      <div class="whole-body">
        <div class="preloader"></div>
        <img id='front-image' src='rotacija/frame_1.png'/>
      </div>
      <div class="highlighted-parts">
        <div class="front">
          <div id='grudi' class="klik">
            <img src='rotacija/parts/grudi.png'/>
            <span class="tooltip">Grudi</br><i>Pectoralis Major</i>
              <div class='line'></div>
            </span>
          </div>
          <div id='rame' class="klik rame_desno">
            <img src='rotacija/parts/rame_desno.png'>
            <span class="tooltip">Rame</br><i>Deltoid</i>
              <div class='line'></div>
            </span>
          </div>
          <div id='rame' class="klik rame_levo">
            <img  src='rotacija/parts/rame_levo.png'>
            <span class="tooltip">Rame</br><i>Deltoid</i>
              <div class='line'></div>
            </span>
          </div>
          <div id='trapez' class="klik trapez_levi">
            <img src='rotacija/parts/trapez_levi.png'>
            <span class="tooltip">Trapez</br><i>Trapezius</i>
              <div class='line'></div>
            </span>
          </div>
          <div id='trapez' class="klik trapez_desni">
            <img src='rotacija/parts/trapez_desni.png'>
            <span class="tooltip">Trapez</br><i>Trapezius</i>
              <div class='line'></div>
            </span>
          </div>
          <div id='abdomen' class="klik">
            <img src='rotacija/parts/abdomen.png'>
            <span class="tooltip">Trbusni zid</br><i>Rectus Abdominis</i>
              <div class='line'></div>
            </span>
          </div>
          <div id='biceps' class="klik biceps_levi">
            <img src='rotacija/parts/biceps_levi.png'>
            <span class="tooltip">Biceps</br><i>Biceps</i>
              <div class='line'></div>
            </span>
          </div>
          <div id='biceps' class="klik biceps_desni">
            <img src='rotacija/parts/biceps_desni.png'>
            <span class="tooltip">Biceps</br><i>Biceps</i>
              <div class='line'></div>
            </span>
          </div>
          <div id='triceps' class="klik triceps_levi">
            <img src='rotacija/parts/triceps_levi.png'>
            <span class="tooltip">Triceps</br><i>Triceps</i>
              <div class='line'></div>
            </span>
          </div>
          <div id='triceps' class="klik triceps_desni">
            <img src='rotacija/parts/triceps_desni.png'>
            <span class="tooltip">Triceps</br><i>Triceps</i>
              <div class='line'></div>
            </span>
          </div>
          <div id='kvadriceps' class="klik kvadriceps_levi">
            <img src='rotacija/parts/kvadriceps_levi.png'>
            <span class="tooltip">Kvadriceps</br><i>Rectus Femoris</i>
              <div class='line'></div>
            </span>
          </div>
          <div id='kvadriceps' class="klik kvadriceps_desni">
            <img src='rotacija/parts/kvadriceps_desni.png'>
            <span class="tooltip">Kvadriceps</br><i>Rectus Femoris</i>
              <div class='line'></div>
            </span>
          </div>
        </div>

        <div class="back">
          <div id='donja_ledja'> 
            <img src='rotacija/parts/donja_ledja.png'>
            <span class="tooltip">Donja ledja</br><i>Tharoco-lumbar fascia</i>
              <div class='line'></div>
            </span>
          </div>
          <div id='lepeza_desna'> 
            <img src='rotacija/parts/lepeza_desna.png'>
            <span class="tooltip">Lepeza</br><i>Latissimus Dorsi</i> 
              <div class='line'></div>
            </span>
          </div>
          <div id='lepeza_leva'> 
            <img  src='rotacija/parts/lepeza_leva.png'>
            <span class="tooltip">Lepeza</br><i>Latissimus Dorsi</i> 
              <div class='line'></div>
            </span>
          </div>
          <div id='trapezius'> 
            <img  src='rotacija/parts/trapezius.png'>
            <span class="tooltip">Trapez</br><i>Trapezius</i>
              <div class='line'></div>
            </span>
          </div>
        </div>
      </div><!-- end of .highlighted-parts -->
      
    </div><!-- end of .image-container -->

    <div id='popup' class="popup">
        <div id="a"></div>
      <div class="close"></div>
    </div>

	</body>
</html>