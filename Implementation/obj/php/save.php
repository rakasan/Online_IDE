<?php
include "functions.php";

	session_start();
	$ftp_id = $_SESSION['id'];
 //echo $ftp_id;
	$con = mysql_connect('localhost','root','');
    mysql_select_db("vlad_licenta") OR die("nu am gasit BD");
    $select = "SELECT * FROM ftp_info WHERE ID_FTP = $ftp_id";
    $result = mysql_query($select);
    while ($row = mysql_fetch_array($result)) {
            
            $host = $row['HOST'];
            $username = $row['USERNAME'];
            $password = $row['PASSWORD'];
            $desierd_name = $row['DESIRED_NAME'];
            
        }   
        

	//$conectare = $username.":".$password."@".$host;
	//echo $conectare;
	$con = ftp_connect($host) or die("nu a mers");
	
	$login = ftp_login($con,$username,$password);
	ftp_pasv($con,true);
	$cale =  $_POST['path'];
	$cale[strlen($cale) -1] ='';
 	$local_file = "test7";
 	 $handlet = fopen($local_file, "w+");
 	fwrite($handlet, $_POST['code']);
 	 fclose($handlet);
  ftp_put($con, $cale, $local_file, FTP_BINARY);
  echo "done";

?>