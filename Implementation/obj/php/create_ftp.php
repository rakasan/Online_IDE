<?php
session_start();
	$con = mysql_connect('localhost','root','');
    mysql_select_db("vlad_licenta") OR die("nu am gasit BD");
    $nume_conexiune = $_POST['nume_conexiune'];
    $adresa_host = $_POST['adresa_host'];
    $username = $_POST['username'];
    $parola = $_POST['parola'];
    $insert = "INSERT INTO  `vlad_licenta`.`ftp_info` (

`ID_USER` ,
`DESIRED_NAME` ,
`USERNAME` ,
`PASSWORD` ,
`HOST`
)
VALUES (
 '1',  '$nume_conexiune',  '$username',  '$parola',  '$adresa_host'
)";
if(mysql_query($insert))
	echo "succes";
else
	echo "nu a mers";

//echo $nume_conexiune.$adresa_host.$username.$parola;

?>