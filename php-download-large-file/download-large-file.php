<?php

//Remove max execution time exceeded
ini_set('max_execution_time', '0');

// Download a file chunk by chunk
function download_file_chunked($path) {
	$file_name = basename($path);

	// get the file's mime type to send the correct content type header
	//$finfo = finfo_open(FILEINFO_MIME_TYPE); //For remote file, it may not work
	//$mime_type = finfo_file($finfo, $path); //For remote file, it may not work
	$mime_type = mime_type($file_name);

	$attachment = (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE")) ? "" : " attachment"; // IE 5.5 fix.

	// send the headers	
	header("Content-Type: $mime_type");
	header('Content-Transfer-Encoding: binary');
	//header('Content-Length: ' . filesize($path)); //PHP Warning: filesize(): stat failed for remote file
	//header("Content-Disposition: attachment; filename=$file_name;");
	header("Content-Disposition: $attachment; filename=$file_name;");

	$options = array(
		"ssl"=>array(
			"verify_peer"=>false,
			"verify_peer_name"=>false,
		),
	);
	
	$context  = stream_context_create($options);

    //$handle = fopen($path, 'rb');	
	$handle = fopen($path, 'rb', false, $context);
	
	ob_end_clean();//output buffering is disabled, so you won't hit your memory limit
	
	//$newfname = basename($path);
	//$newf = fopen ($newfname, "wb");

	$chunkSize = 1024 * 1024;
	$buffer = '';

	ob_start();
    while (!feof($handle)) {
        $buffer = fread($handle, $chunkSize);		
        echo $buffer;
        ob_flush();
        flush();
		
		//fwrite($newf, $buffer, $chunkSize);
    }
	
    fclose($handle);
	
	//fclose($newf);
	
	exit;
}

//Download File
download_file_chunked('https://research.nhm.org/pdfs/10840/10840.pdf');

function download_large_file($path) {
	// the file name of the download, change this if needed
	$file_name = basename($path);

	// get the file's mime type to send the correct content type header
	//$finfo = finfo_open(FILEINFO_MIME_TYPE); //For remote file, it may not work
	//$mime_type = finfo_file($finfo, $path); //For remote file, it may not work
	$mime_type = mime_type($file_name);

	$attachment = (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE")) ? "" : " attachment"; // IE 5.5 fix.

	// send the headers	
	header("Content-Type: $mime_type");
	//header('Content-Length: ' . filesize($path)); //PHP Warning: filesize(): stat failed for remote file
	//header("Content-Disposition: attachment; filename=$file_name;");
	header("Content-Disposition: $attachment; filename=$file_name;");

	//Disable SSL verification
	$options=array(
		"ssl"=>array(
			"verify_peer"=>false,
			"verify_peer_name"=>false,
		),
	);
	
	$context  = stream_context_create($options);

	// stream the file
	//$fp = fopen($path, 'rb');
	$fp = fopen($path, 'rb', false, $context);
	
	ob_end_clean();//output buffering is disabled, so you won't hit your memory limit
	
	fpassthru($fp);
	
	fclose($fp);
	
	exit;
}

//download_large_file('https://research.nhm.org/pdfs/10840/10840.pdf');

function mime_type($filename) {

	$mime_types = array(

		'txt' => 'text/plain',
		'htm' => 'text/html',
		'html' => 'text/html',
		'php' => 'text/html',
		'css' => 'text/css',
		'js' => 'application/javascript',
		'json' => 'application/json',
		'xml' => 'application/xml',
		'swf' => 'application/x-shockwave-flash',
		'flv' => 'video/x-flv',

		// images
		'png' => 'image/png',
		'jpe' => 'image/jpeg',
		'jpeg' => 'image/jpeg',
		'jpg' => 'image/jpeg',
		'gif' => 'image/gif',
		'bmp' => 'image/bmp',
		'ico' => 'image/vnd.microsoft.icon',
		'tiff' => 'image/tiff',
		'tif' => 'image/tiff',
		'svg' => 'image/svg+xml',
		'svgz' => 'image/svg+xml',

		// archives
		'zip' => 'application/zip',
		'rar' => 'application/x-rar-compressed',
		'exe' => 'application/x-msdownload',
		'msi' => 'application/x-msdownload',
		'cab' => 'application/vnd.ms-cab-compressed',

		// audio/video
		'mp3' => 'audio/mpeg',
		'qt' => 'video/quicktime',
		'mov' => 'video/quicktime',

		// adobe
		'pdf' => 'application/pdf',
		'psd' => 'image/vnd.adobe.photoshop',
		'ai' => 'application/postscript',
		'eps' => 'application/postscript',
		'ps' => 'application/postscript',

		// ms office
		'doc' => 'application/msword',
		'rtf' => 'application/rtf',
		'xls' => 'application/vnd.ms-excel',
		'ppt' => 'application/vnd.ms-powerpoint',

		// open office
		'odt' => 'application/vnd.oasis.opendocument.text',
		'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
	);

	$tmp = explode('.',$filename);
	$ext = strtolower(end($tmp));
	
	if (array_key_exists($ext, $mime_types)) {
		return $mime_types[$ext];
	}else if (function_exists('finfo_open')) {
		$finfo = finfo_open(FILEINFO_MIME);
		$mimetype = finfo_file($finfo, $filename);
		finfo_close($finfo);
		return $mimetype;
	} else {
		return 'application/octet-stream';
	}
}