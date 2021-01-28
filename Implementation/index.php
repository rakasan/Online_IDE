<html>
<head>

	<style>
	textarea{
		width: 500px;
		height: 450px;
	}
	.red{color: red;}
	</style>
<script>
function showHint(str,e)
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
    	var locatie;
    	locatie = "dd" + e;
    	//alert(locatie);
    document.getElementById(locatie).innerHTML=xmlhttp.responseText;
    }
  }

xmlhttp.open("GET","directory_tree.php?path="+str,true);
xmlhttp.send();
}

function loadXMLDoc(str)
{
if (str.length==0)
  { 
  document.getElementById("loadXMLDoc").innerHTML="";
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
    	
    	//alert(locatie);
    document.getElementById("textarea2").innerHTML=xmlhttp.responseText;
    document.getElementById("texarea2_input").value=str;
    }
  }
//alert(str);
xmlhttp.open("GET","adu_fisier.php?path=" +str,true);
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
	$date = new DateTime();
	$nr=$date->getTimestamp()*100;
	foreach ($lista as $inregistrare ) 
	{

		$nr++;
		echo "<li ";
		if($inregistrare['isDir'])
		{
			echo "id ="."\"d" .$nr."\" onclick = \"showHint('".$inregistrare['path']. "'," .$nr. ")\" ";
			echo ">". $inregistrare['text']."</a>"."</li>";
			echo "<div id =\"dd".$nr."\"></div>";
		}else
		{
		echo "id ="."\"f" .$nr." \"class=\"red\"  onclick = \"loadXMLDoc('".$inregistrare['path']. "')\" ";
		echo ">". $inregistrare['text']."</a>"."</li>";
		}

	}
	echo "</ul>";

?>
<form action = "save.php" id="form_2" method ="POST">

<button id="test1">Change Content</button>
<input type="hidden" name="path" id="texarea2_input"></input>
<textarea name="Continut" id="textarea2"></textarea>
</form>
</body>
<script type="text/javascript" src="jquery-1.9.1.js"></script>

<script>
$("#test1").click(function() {

    var url = "save.php"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           data: $("#form_2").serialize(), // serializes the form's elements.
           success: function(data)
           {
               alert(data); // show response from the php script.
           }
         });

    return false; // avoid to execute the actual submit of the form.
});
</script>

</html>