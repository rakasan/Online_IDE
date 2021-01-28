
<?php
session_start();
include "functions.php";

function ftp_is_dir( $dir , $ftpcon ) {
    // get current directory
    $original_directory = ftp_pwd( $ftpcon );
    // test if you can change directory to $dir
    // suppress errors in case $dir is not a file or not a directory
    if ( @ftp_chdir( $ftpcon, $dir ) ) {
        // If it is a directory, then change the directory back to the original directory
        ftp_chdir( $ftpcon, $original_directory );
        return true;
    } 
    else {
        return false;
    }      
}  
	$ftp_id = $_SESSION['id'];
    $path = $_SESSION['path'] . $_GET['nume'];

$con = mysql_connect('localhost','root','');
    mysql_select_db("vlad_licenta") OR die("nu am gasit BD");
    $select = "SELECT * FROM ftp_info WHERE ID_FTP = $ftp_id";
    $result = mysql_query($select);
    while ($row = mysql_fetch_array($result)) {
            $host = $row['HOST'];
            $username = $row['USERNAME'];
            $password = $row['PASSWORD'];
            $id_ftp =  $row['ID_FTP'];
        } 
	$con = ftp_connect($host) or die("nu a mers");
	
	$login = ftp_login($con,$username,$password);
	ftp_pasv($con,true);
	if(isset($_GET['path']))
	{
		$path = $_GET['path'];
	}
	if(ftp_is_dir($path,$con))
		echo "folder existent";
	else 
		if(@ftp_mkdir($con,$path))
			echo "folder creat";
		else
			echo "eroare";
?>