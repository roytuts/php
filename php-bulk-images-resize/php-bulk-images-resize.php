<?php

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 300);

echo 'Bulk Image Resizing in PHP - Starting...';

$img_dir = 'images/';
//echo $img_dir;
$scanned_dir = array_diff(scandir($img_dir), array('..', '.'));
//print_r($scanned_dir);

foreach($scanned_dir as $filename) {
	//echo $filename;
	//echo nl2br("\n");
	
	// Get new sizes
	//list($width, $height) = getimagesize($img_dir . $filename);
	
	$newwidth = 1200;
	$newheight = 628;

	// Load
	$thumb = imagecreatetruecolor($newwidth, $newheight);
	$source = imagecreatefromjpeg($img_dir. $filename);

	// Resize
	imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	
	//imagejpeg($thumb, $img_dir. $filename);
	if(imagejpeg($thumb, $img_dir. $filename)) {
		imagedestroy($thumb);
	}
}

echo nl2br("\n");
echo nl2br("\n");

echo 'Bulk Image Resizing in PHP - Finished';

?>