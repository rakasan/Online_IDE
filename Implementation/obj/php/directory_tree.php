<?php
session_start();
include "functions.php";
	$ftp_id = $_GET['id'];

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
		$lista = adu_foldere($con,$path);
		}
	else
	{
		$lista = adu_foldere($con,'/');
		$path = "";
	}
	$result = "<ul>"; 
	$date = new DateTime();
	$nr=$date->getTimestamp()*100;
	
	foreach ($lista as $inregistrare ) 
	{
		if($inregistrare['isDir'])
		{
			if($inregistrare['text'] != "." && $inregistrare['text'] != "..")
			{
				$nr++;
				$result = $result. "<li ";
				$result = $result. "class =\"director\" id ="."\"d" .$nr."\" onclick = \"showHint('".$inregistrare['path']. "','" .$nr."','".$id_ftp."')\" ";
				$result = $result. ">". $inregistrare['text']."</li>";
				$result = $result. "<div id =\"dd".$nr."\"></div>";
			}
			
		}
		}
	foreach ($lista as $inregistrare ) 
	{

		

		if($inregistrare['isDir']==0)
		{
			$nr++;
			$result = $result. "<li ";
			//$inregistrare['text'][strlen($inregistrare['text']) -1] ='';
			$result = $result."id ="."\"f" .$nr." \"class=\"fisier\"  onclick = \"loadXMLDoc(".$inregistrare['path']. ",".$ftp_id.")\" ";
			$result = $result.">". $inregistrare['text']."</li>";
		}
	}
	$result = $result. "</ul>";
	
	$_SESSION['path'] = $path;
	$_SESSION['id'] = $id_ftp;

	echo $result;


?>