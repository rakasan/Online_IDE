<?php
include "functions.php";
//phpinfo();
$ftp_id = $_GET['id'];

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
	
	$con = ftp_connect($host) or die("nu a mers");
	
	$login = ftp_login($con,$username,$password);
	ftp_pasv($con,true);
	$cale =  $_GET['path'];
	$cale[strlen($cale) -1] ='';

    $local_file = "test.html";
    $server_file = $cale;
    $continut = "";

if (ftp_get($con, $local_file, $server_file, FTP_BINARY)) {
    
    $handlet = fopen($local_file, "r");
   
    while(!feof($handlet))
    {
    	$continut .= fread($handlet, 8192);
    }
      echo $continut;
} else {
    echo "There was a problem\n";
}
?>