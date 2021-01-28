<?php
include "functions.php";
//phpinfo();
	$host = "rcsn.ro";
	$username ="rcsnro69";
	$password ="@dm1np0w3r";

	//$conectare = $username.":".$password."@".$host;
	//echo $conectare;
	$con = ftp_connect($host) or die("nu a mers");
	
	$login = ftp_login($con,$username,$password);
	ftp_pasv($con,true);
	$cale =  $_GET['path'];
	$cale[strlen($cale) -1] ='';
//echo $cale;
    $local_file = "test";
    $server_file = $cale;
    $continut = "";

if (ftp_get($con, $local_file, $server_file, FTP_BINARY)) {
    //echo "Successfully written to $local_file\n";
   
    $handlet = fopen($local_file, "r");
   // $continut = fread($handlet, filesize($local_file));
    while(!feof($handlet))
    {
    	$continut .= fread($handlet, 8192);
    }
   // $continut = stream_get_contents($handlet);
 //  unlink($local_file);
    echo $continut;

} else {
    echo "There was a problem\n";
}

?>