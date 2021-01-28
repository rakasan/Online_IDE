<html>
<head>
	<style>
	textarea{
		width: 500px;
		height: 450px;
	}
	</style>
<script>
function showHint(str)
{
if (str.length==0)
  { 
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }

xmlhttp.open("GET","directory_tree.php?path="+str,true);
xmlhttp.send();
}

function loadXMLDoc()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("textarea2").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","adu_fisier.php",true);
xmlhttp.send();
}
</script>

</head>
<body>
<?php
include "functions.php";
	$host = "rcsn.ro";
	$username ="rcsnro69";
	$password ="@dm1np0w3r";
	
	$con = ftp_connect($host) or die("nu a mers");
	
	$login = ftp_login($con,$username,$password);
	ftp_pasv($con,true);
	if($login)
		echo "merge";
	else
		echo "nu s-a logat";
	$lista = adu_foldere($con,'/');
	echo "<ul>";
	$nr=0;
	foreach ($lista as $inregistrare ) 
	{
		$nr++;
		echo "<li ";
		if($inregistrare['isDir'])
			echo "id =".$nr. " onclick = \"showHint(".$inregistrare['path']. ")\" ";
		echo ">". $inregistrare['text']."</a>"."</li>";
	}
	echo "</ul>";

?>

<div id="txtHint"></div>
<button type="button" onclick="loadXMLDoc()">Change Content</button>
<textarea   id="textarea2"></textarea>
</body>
</html>