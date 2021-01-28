<?php
include "functions.php";
	$host = "rcsn.ro";
	$username ="rcsnro69";
	$password ="@dm1np0w3r";

	//$conectare = $username.":".$password."@".$host;
	//echo $conectare;
	$con = ftp_connect($host) or die("nu a mers");
	
	$login = ftp_login($con,$username,$password);
	ftp_pasv($con,true);


    $local_fisier = "test.html";
    $server_file = "test.html";
    

if (ftp_get($conn, $local_file, $server_file, FTP_BINARY)) {
    echo "Successfully written to $local_file\n";
} else {
    echo "There was a problem\n";
}

?>