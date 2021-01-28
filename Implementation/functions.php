<?php

function parseaza_lista_fisiere_raw($lista_raw,$path){
$structure = array();
$arraypointer = &$structure;
foreach ($lista_raw as $rawfile) {
	
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
            'raw'    => $info,
            'path'   => $path.$info[8]."/"
            // the 'children' attribut is automatically added if the folder contains at least one file
        );
    }
}

return $arraypointer;
}

function adu_foldere($con,$path)
{
	//echo $path;
	$lista_raw = ftp_rawlist($con, $path);
//if($lista_raw! = FALSE)
	return parseaza_lista_fisiere_raw($lista_raw,$path);
//else
	//echo "e goala";

}



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

?>