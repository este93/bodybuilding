<?php 
require_once("../config.php");
function test_input($data) {
  	$data = trim($data);
  	$data = strip_tags($data);
  	$data = htmlspecialchars($data);
  	return $data;
}

if(isset($_POST['login'])){
    if(!empty($_POST['username'])){
      $username = test_input($_POST['username']);
    }
		if(!empty($_POST['password'])){
      $password = test_input($_POST['password']);
    }
    
	  User::login($username,$password);
    header("location: ../index.php");
  }



if(isset($_POST['email'])){
   if(!empty($_POST['username'])){
     $username = test_input($_POST['username']);
    }else {
      echo "Morate uneti koriscnicko ime!";
      return false;
    }
  if(!empty($_POST['password'])){
      $password = test_input($_POST['password']);
    }else {
      echo "Morate uneti lozinku!";
      return false;
    }
  if(!empty($_POST['email'])){
      if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $email = test_input($_POST['email']);
      }else {
        echo "Neispravna email adresa";
        return false;
      }
      
    }else {
      echo "Morate uneti email adresu!";
      return false;
    }
  if(User::userExists($username)){
    echo "Korisnicko ime ".$username." je zauzeto!";
    return false;
  }
 
  if(User::register($username, $email, $password)){
    echo "Uspesna registracija! Uskoro cete biti prihvaceni i od strane administratora.";
  }else echo "Greska! Desio se problem prilikom registracije. Pokusajte ponovo.";
} 
  
