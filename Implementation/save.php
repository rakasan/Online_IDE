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
	$cale =  $_POST['path'];
	$cale[strlen($cale) -1] ='';
 $local_file = "test7";
  $handlet = fopen($local_file, "w+");
 fwrite($handlet, $_POST['Continut']);
  fclose($handlet);
  ftp_put($con, $cale, $local_file, FTP_BINARY);
  echo "done";

?>