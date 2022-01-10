<?php
 
	$file = file_get_contents("sample.js");

	echo generate_sri_hash($file, 'sha256');
	echo "\n";
	echo generate_sri_hash($file, 'sha384');
	echo "\n";
	echo generate_sri_hash($file, 'sha512');

	echo "\n\n";

	echo generate_sri_openssl($file, 'sha256');
	echo "\n";
	echo generate_sri_openssl($file, 'sha384');
	echo "\n";
	echo generate_sri_openssl($file, 'sha512');

	echo "\n";


	function generate_sri_hash($file, $algo = 'sha256') {
	  return base64_encode(hash($algo, $file, true));
	}

	function generate_sri_openssl($file, $algo = 'sha256') {
	  return base64_encode(openssl_digest($file, $algo, true));
	}
?>
