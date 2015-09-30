<?php 
	$txt=$_GET['txt'];
	$db = Singleton::getInstance();
	$conn = $db->conn;
	$q = $conn->query("select * from tekstovi left join kategorije on kategorije.kategorija_id=tekstovi.kategorija left join users on users.user_id = tekstovi.user_id where naslov = '{$txt}' limit 1");
	$text = $q->fetchObject();
	$id = $text->id;
	$naslov = $text->naslov;
	$date = new DateTime($text->datum);
	$naslovSanitize = Functions::titleSanitize($naslov);
?>
<script>
	$(function(){
      $("#koment_form").submit(function() {
      		var ime_koment = $("input[type='text'][name='ime_koment']").val();
      		var email_koment = $("input[type='text'][name='email_koment']").val();
      		var koment = $("textarea[name='koment']").val();
      		var tekst_id = $("input[type='hidden'][name='tekst_id']").val();
            $.post("process/komentari.php", {ime_koment:ime_koment, email_koment:email_koment, koment:koment, tekst_id:tekst_id});
            this.reset();
            return false;
      })
})
</script>
<section id="article_view">
	<h1><?php echo $text->naslov; ?></h1>
	<span>Autor: <b><?= ucfirst($text->username); ?></b> - Kategorija: <b><?php echo ucfirst($text->kategorija); ?></b> dana <b><?php echo $date->format('d.m.Y'); ?></b></span>
	<img class="main_pic" src="images/main/<?php echo $naslovSanitize.".jpeg"; ?>">
	<div id="prikaz_text"><?php echo $text->tekst; ?></div>
</section>

<section id="comments">	
  <div id="pisi_komentar">
	  <h3>Ostavite komentar</h3>
	  <form action="" method="post" id="koment_form">
	    <label for="ime_koment">Ime:</label>
	    <input type="text" name="ime_koment" id="ime_koment" value="" required="required">

	    <label for="email_koment">Email:</label>
		<input type="text" name="email_koment" id="email_koment" value="" required="required">

	    <label for="koment" class="required">Komentar:</label>
	    <textarea name="koment" id="koment" rows="10" required="required"></textarea>

	    <input type="hidden" name="tekst_id" value="<?php echo isset($txt)?$id:null; ?>" />
	    <input type="hidden" name="naslov" value="<?php echo isset($txt)?$naslov:null; ?>" />

	    <input name="submit" type="submit" value="Pošalji komentar" onclick="clicked()" class="graybtn"/>
	  </form>
	</div>
	<div id="komentari">
		<?php 
			$db = Singleton::getInstance();
			$conn = $db->conn;
			$q = "select komentar_id,ime,komentar,date_format(komentari.datum, '%d %b %Y u %T') as datum from komentari left join tekstovi on tekst_id=tekstovi.id where tekst_id='{$id}' and status<>0 order by komentar_id desc";
			$query = $conn->prepare($q);
			$query->execute();
			while($rw = $query->fetchObject()){ ?>
				<div class="komentar">
					<span style="color:#ad0101;"><?php echo $rw->ime;?></span>
					<p><?php echo $rw->komentar; ?></p>
					<span style="color:#b4b4b4;font-size:14px;"><?php echo $rw->datum; ?></span>
	  			</div>
			<?php	
			}
		?>
	</div>	
</section>	
 <script>
  function clicked(){
  	var div = $("#komentari");
	var koment = $("#koment").value;
	alert(koment);
  	var div_new = div.prepend("<div id='alert'><p>Vas komentar ce biti prosledjen administratorima.</p></div>");
  	var alert = $("#alert");
  	//setTimeout(function(){este.hide('slow')},3000);
  	alert.delay(4000).fadeOut('slow');
  }
</script>