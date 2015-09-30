<header>
	<div id="logo">
		<h1>Bodybuilding <span class='logo_span'>SRB</span></h1>
	</div>
	<nav id="main_nav">
		<ul>
			<?php 
			$activePage = $_SERVER['REQUEST_URI'];
			$menu = Menu::getAll();
			foreach ($menu as $value) {
				$url = "/bodybuilding/".$value->file;	
			?>
			 	<li <?php if($url === $activePage){?>class="active"<?php }?>>
	 		 		<a href="<?php echo $url;?>"><?php echo strtoupper($value->title);?></br>
	 		 			<span class='nav_span'><?php echo ucfirst($value->eng); ?></span>
	 		 		</a>
				</li>
			<?php 
			}
			?>
		</ul>
	</nav>

	<div id="register">
		<?php 
			$user=Session::get("username"); 
			$status=Session::get("status");
		?>
	    <button id="register_button">
	    	<?php 
	    		if(!$user)
	    			echo "Registruj se";
	    	?>
	    </button>
	    <?php 
	    	if($user){ ?>
	    		<div id="user_status" >
	    			Dobrodosao <?= $user; ?> <br>
					<a href='logout.php'>Odjavi se</a> 
					<?php 
						if($status == "4" || $status == "2")
							echo "<a href='admin/admin.php' target='_blank'>Admin panel</a>";
					 ?>
	    		</div>
	    	<?php 
	    	}
	    ?>
	    <script>
	    	/* function validate(){
	    		var username = $("input[type='text'][name='username']").val();
	    		var password = $("input[type='password'][name='password']").val();
	    		var letters = /^[A-Za-z]+$/;
		       if(username.length < 4 || username.length > 10){
		       	$(".userErr").html("Morate uneti izmedju 4 i 10 karaktera!");
		       	return false;
		       }else if(username.match(letters)){
		       	 return true;
		       }else{
		       	$(".userErr").html("Dozvoljena su samo slova");
		       	return false;
		       }
		       if(password.length < 4 || password.length > 10){
		       	$(".passErr").html("Morate uneti izmedju 4 i 10 karaktera!");
		       	return false;
		       } 
			}   */
	    </script>

        <div class="form" style="display:none;">
	      <ul class="tab-group">
	        <li class="tab tab_active"><a href="#signup">Registruj se</a></li>
	        <li class="tab"><a href="#login">Prijavi se</a></li>
	      </ul>
	      <div class="tab-content">
	        <div id="signup">   
	          <h1>Registruj se besplatno</h1>
	          <form action="process/login.php" id="register_form" method="post">
		          <div class="top-row">
		            <div class="field-wrap">
		              <label>
		                Username<span class="req">*</span>
		              </label>
		              <input type="text"  autocomplete="off" name="username" required />
		               <span class="userErr"></span>
		            </div>
		          </div>
		          <div class="field-wrap">
		            <label>
		              Email adresa<span class="req">*</span>
		            </label>
		            <input type="email"  autocomplete="off" name="email" required/>
		          </div> 
		          <div class="field-wrap">
		            <label>
		              Lozinka<span class="req">*</span>
		            </label>
		            <input type="password" autocomplete="off" name="password" required/>
		            <span class="passErr"></span>
		          </div> 
		          <button type="submit" class="button button-block" id="register_submit" name="register" />Registruj se!</button>
	          </form>
	          <div id="result"></div>
	        </div>
	        
	        <div id="login">   
	          <h1>Dobrodosao nazad!</h1>
	          <form action="process/login.php" method="post" id="login_form">
	            <div class="field-wrap">
	             <label>
	              Korisnicko ime<span class="req">*</span>
	             </label>
	             <input type="text" required autocomplete="off"/ name="username">
	            </div>
	            <div class="field-wrap">
	             <label>
	              Lozinka<span class="req">*</span>
	             </label>
	             <input type="password" required autocomplete="off" name="password"/>
	            </div>
	            <input type="hidden" value="logg" name="logg">
	            <button class="button button-block"/ name="login" id="login_submit">Prijavi se</button>
	          </form>
	          <div id="results1"></div>
	        </div>
	        
	      </div><!-- tab-content -->
		</div> <!-- /form -->	
	</div>
</header>

<script>
  $(function(){
    $("#register_button").click(function(){
      var a = $(".form");
      a.toggle(400);
    })
  })
</script>

<script>
	$('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
  var $this = $(this),
      label = $this.prev('label');

	  if (e.type === 'keyup') {
			if ($this.val() === '') {
          label.removeClass('tab_active highlight');
        } else {
          label.addClass('tab_active highlight');
        }
    } else if (e.type === 'blur') {
    	if( $this.val() === '' ) {
    		label.removeClass('tab_active highlight'); 
			} else {
		    label.removeClass('highlight');   
			}   
    } else if (e.type === 'focus') {
      
      if( $this.val() === '' ) {
    		label.removeClass('highlight'); 
			} 
      else if( $this.val() !== '' ) {
		    label.addClass('highlight');
			}
    }

});

$('.tab a').on('click', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('tab_active');
  $(this).parent().siblings().removeClass('tab_active');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});
</script>