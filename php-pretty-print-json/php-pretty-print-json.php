<?php
$json = json_decode("{\"one\":\"AAA\",\"two\":[\"BBB\",\"CCC\"],\"three\":{\"four\":\"DDD\",\"five\":[\"EEE\",\"FFF\"]}}");
//print_r($json);
//$json = array('one' => 'AAA', 'two' => array('BBB', 'CCC'), 'three' => array('four' => 'DDD', 'five' => array('EEE', 'FFF')));

//echo json_encode($json, 128);

echo json_encode($json, JSON_PRETTY_PRINT);

//echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);


/**
* Pretty Print From A File
**/

$filename = "input.json";
$file = fopen( $filename, "r" );
         
if( $file == false ) {
	echo ( "Error in opening file" );
	exit();
}

$filesize = filesize( $filename );
$filecontent = fread( $file, $filesize );
fclose( $file );

$filename = "output.json";
$file = fopen( $filename, "w" );

if( $file == false ) {
	echo ( "Error in opening new file" );	
	exit();
}

fwrite($file, json_encode(json_decode($filecontent), JSON_PRETTY_PRINT));
fclose( $file );
