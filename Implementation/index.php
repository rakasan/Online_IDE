<html>
<head>
</head>
<body>
<?php

	
	$host = "rcsn.ro";
	$username ="rcsnro69";
	$password ="@dm1np0w3r";
	
	//$conectare = $username.":".$password."@".$host;
	//echo $conectare;
	$con = ftp_connect($host) or die("nu a mers");
	
	$login = ftp_login($con,$username,$password);
	ftp_pasv($con,true);
	if($login)
		//echo "a mers logarea";
		echo "merge";
		else
		echo "nu s-a logat";
	
	//$fisiere = ftp_get_filelist($con, '/', true);
	function foldere_recursiv()
	
	$foldere = ftp_nlist($con, 'public_html/htaccess');
	
	if($con)
	echo "activ";
	var_dump($foldere);
	/*$structure = array();
$arraypointer = &$structure;
foreach ($foldere as $rawfile) {
    if ($rawfile[0] == '/') {
        $paths = array_slice(explode('/', str_replace(':', '', $rawfile)), 1);
        $arraypointer = &$structure;
        foreach ($paths as $path) {
            foreach ($arraypointer as $i => $file) {
                if ($file['text'] == $path) {
                    $arraypointer = &$arraypointer[ $i ]['children'];
                    break;
                }
            }
        }
    } elseif(!empty($rawfile)) {
        $info = preg_split("/[\s]+/", $rawfile, 9);        
        $arraypointer[] = array(
            'text'   => $info[8],
            'isDir'  => $info[0]{0} == 'd',
            'size'   => byteconvert($info[4]),
            'chmod'  => chmodnum($info[0]),
            'date'   => strtotime($info[6] . ' ' . $info[5] . ' ' . $info[7]),
            'raw'    => $info
            // the 'children' attribut is automatically added if the folder contains at least one file
        );
    }
}

// in $structure is all the data
print_r($structure);

// little helper functions
function byteconvert($bytes) {
    $symbol = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $exp = floor( log($bytes) / log(1024) );
    return sprintf( '%.2f ' . $symbol[ $exp ], ($bytes / pow(1024, floor($exp))) );
}

function chmodnum($chmod) {
    $trans = array('-' => '0', 'r' => '4', 'w' => '2', 'x' => '1');
    $chmod = substr(strtr($chmod, $trans), 1);
    $array = str_split($chmod, 3);
    return array_sum(str_split($array[0])) . array_sum(str_split($array[1])) . array_sum(str_split($array[2]));
}

	
	
	
	
	
	
	
	//foreach($f as $fisiere)
	//echo $f['name'];
	//echo $foldere;
	//var_dump($foldere);
	//foreach(f in $foldere)
	//echo f;
	*/
?>
</body>
</html>