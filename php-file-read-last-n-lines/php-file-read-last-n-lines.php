<?php

	/*$file = file("license.txt");
	$readLines = max(0, count($file) - 10); //n being non-zero positive integer

	if($readLines > 0) {
		for ($i = $readLines; $i < count($file); $i++) {
			echo $file[$i];
			echo nl2br("\n");
		}
	} else {
		echo 'file does not have required no. of lines to read';
	}*/
	
	$file = new SplFileObject('license.txt', 'r');
	$file->seek(PHP_INT_MAX);
	$last_line = $file->key();
	$lines = new LimitIterator($file, $last_line - 10, $last_line); //n being non-zero positive integer
	print_r(iterator_to_array($lines));
	
	// Iterate each element
	/*$it = iterator_to_array($lines);
	
	foreach($it as $ele){
		echo nl2br($ele . "\n");
	}*/


?>