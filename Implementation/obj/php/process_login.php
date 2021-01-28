<?php
include 'db_connect.php';
include 'functions.php';
sec_session_start(); 
 
if(isset($_POST['login'], $_POST['password'])) { 
   $email = $_POST['login'];
   $password = $_POST['password']; // The hashed password.
   if(login($email, $password, $mysqli) == true) {
      // Login success
     // echo 'Success: You have been logged in!';
     header('Location: ../../intern.php');
   } else {
      // Login failed
      header('Location: ../../index.php?error=1');
   }
} else { 
   
   echo 'Invalid Request';
}
?>