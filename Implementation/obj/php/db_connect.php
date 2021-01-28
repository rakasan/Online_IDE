<?php
define("HOST", "localhost"); // The host you want to connect to.
define("USER", "root"); // The database username.
define("PASSWORD", ""); // The database password. 
define("DATABASE", "vlad_licenta"); // The database name.
 
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
/*if($mysqli)
	echo 'connect';
else
	echo 'neconectat';
*/
?>