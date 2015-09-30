
<div id="home">
	<div id="row">
		<div id="overview" class="clanaka">
			<div class="overview_img">
				<i class="fa fa-file-text-o fa-2x"></i>
			</div>
			<div class="overview_details">
			<?php 
				$db = Singleton::getInstance();
				$conn = $db->conn;
				$result = $conn->query('select count(*) as `c` from `tekstovi`');
				$count = $result->fetchObject()->c;
			?>
				<div class="number"><?php echo $count;?></div>
				<div class="desc">Ukupno tekstova</div>
			</div>
			<a class="more" href="">VIEW MORE
				<i class="fa fa-arrow-circle-o-right"></i>
			</a>
		</div><!-- end of overview -->
		<div id="overview" class="tekstova">
			<div class="overview_img">
				<i class="fa fa-bar-chart-o fa-2x"></i>
			</div>
			<div class="overview_details">
			<?php 
				$result = $conn->query('select count(*) as `c` from `users`');
				$count = $result->fetchObject()->c;
			?>
				<div class="number"><?php echo $count;?></div>
				<div class="desc">Ukupno korisnika</div>
			</div>
			<a class="more" href="">VIEW MORE
				<i class="fa fa-arrow-circle-o-right"></i>
			</a>
		</div><!-- end of overview -->
	</div><!-- end of row -->
	 <div id="chart_div"></div>
	 <?php 
	 	$query = $conn->query("select * from kategorije");
	 	$kategorija = array();
	 	while($a = $query->fetchObject()){
	 		$kategorija[]=ucfirst($a->kategorija);
	 	}

	 ?>
	<script type="text/javascript">
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});
      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);
      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
        	<?php 
        		$rez=array();
    			foreach($kategorija as $kat){
    				$res = $conn->query("select kategorije.kategorija,count('tekstovi.id') as 'c' from kategorije left join tekstovi on kategorije.kategorija_id=tekstovi.kategorija where kategorije.kategorija='$kat'");
    				echo "['{$kat}', {$res->fetchObject()->c}],";
    		}
        	?>
        ]);
        // Set chart options
        var options = {'title':'Statistika tekstova po kategoriji',
                       'width':400,
                       'height':300};
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
</div><!-- end of HOME -->
