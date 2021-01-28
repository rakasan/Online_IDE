
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
/*	if($login)
		//echo "a mers logarea";
		echo "merge";
		else
		echo "nu s-a logat";
	
*/
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
	/*foreach ($lista as $inregistrare ) 
	{
		$nr++;
		$result = $result."<li ";
		if($inregistrare['isDir'])
		$result = $result. "id ="."\"d" .$nr."\" onclick = \"showHint(".$inregistrare['path']. "," .$nr. ")\" ";
		$result = $result. ">". $inregistrare['text']."</a>"."</li>";
		$result =$result. "<div id =\"dd".$nr."\"></div>";
	}
	*/
	foreach ($lista as $inregistrare ) 
	{

		$nr++;
		$result = $result. "<li ";
		if($inregistrare['isDir'])
		{
			$result = $result. "id ="."\"d" .$nr."\" onclick = \"showHint('".$inregistrare['path']. "'," .$nr. ")\" ";
			$result = $result. ">". $inregistrare['text']."</a>"."</li>";
			$result = $result. "<div id =\"dd".$nr."\"></div>";
		}else
		{
		$result = $result."id ="."\"f" .$nr." \"class=\"red\"  onclick = \"loadXMLDoc('".$inregistrare['path']. "')\" ";
		$result = $result.">". $inregistrare['text']."</a>"."</li>";
		}

	}
	$result = $result. "</ul>";
	
	echo $result;
	
//	return $result;
	
	

?>