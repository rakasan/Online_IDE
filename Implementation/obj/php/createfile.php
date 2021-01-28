
<?php
session_start();
include "functions.php";
	$ftp_id = $_SESSION['id'];
    $path = $_SESSION['path'] . $_GET['nume'];
    $local_file= "template.txt";
  

$con = mysql_connect('localhost','root','');
    mysql_select_db("vlad_licenta") OR die("nu am gasit BD");
    $select = "SELECT * FROM ftp_info WHERE ID_FTP = $ftp_id";
    $result = mysql_query($select);
    while ($row = mysql_fetch_array($result)) {
            
            $host = $row['HOST'];
            $username = $row['USERNAME'];   
            $password = $row['PASSWORD'];
           // $desierd_name = $row['DESIRED_NAME'];
            //$id_user = $row['ID_USER'];
            $id_ftp =  $row['ID_FTP'];
        } 

	//$conectare = $username.":".$password."@".$host;
	//echo $conectare;
	$con = ftp_connect($host) or die("nu a mers");
	
	$login = ftp_login($con,$username,$password);
	ftp_pasv($con,true);
	
 if(ftp_put($con,$path,$local_file,FTP_BINARY))
        echo "upload complet";
    else
     echo "upload esuat"
	
?>