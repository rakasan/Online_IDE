<?php
include 'db_connect.php';
include 'functions.php';

// The hashed password from the form
$email = $_POST['login'];
$password = $_POST['password']; 
// Create a random salt
$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
// Create salted password (Careful not to over season)
$password = hash('sha512', $password.$random_salt);
 
// Add your insert to database script here. 
// Make sure you use prepared statements!
if ($insert_stmt = $mysqli->prepare("INSERT INTO members (EMAIL, PASSWORD, SALT) VALUES ( ?, ?, ?)")) {    
   $insert_stmt->bind_param('sss', $email, $password, $random_salt); 
   // Execute the prepared query.
   $insert_stmt->execute();
   echo $random_salt;
   echo 'succes';
}
else
 	echo 'ceva nu a mers';

?>