<?php

header("Acess-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Acess-Control-Allow-Methods: POST");
header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods, Authorization");

$data = json_decode(file_get_contents("php://input"), true); // collect input parameters and convert into readable format
		
if(empty($_FILES['sendfile']['name'][0])) {
	echo json_encode(array("message" => "please select a file"));	
} else {
	$upload_path = 'upload/'; // set upload folder path 
	
	// valid file extensions
	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'pdf', 'docx', 'txt');
	
	$total = count($_FILES['sendfile']['name']);
	
	$msg = array();
	
	for( $i=0 ; $i < $total ; $i++ ) {
		$fileName  =  $_FILES['sendfile']['name'][$i];
		$tempPath  =  $_FILES['sendfile']['tmp_name'][$i];
		$fileSize  =  $_FILES['sendfile']['size'][$i];
	
		$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // get file extension
		
		// allow valid file formats
		if(in_array($fileExt, $valid_extensions)) {
			//check file does not exist in the upload folder path
			if(!file_exists($upload_path . $fileName)) {
				// check file size '5MB'
				if($fileSize < 5000000) {
					if(move_uploaded_file($tempPath, $upload_path . $fileName)) { // move file from system temporary path to the upload folder path
						$msg[$i] = "File Uploaded Successfully: " . $fileName;
					} else {
						$msg[$i] = "File couldn't be uploaded: " . $fileName;
					}
				} else {
					$msg[$i] = "Sorry, your file is too large, please upload up to 5 MB in size: " . $fileName;
				}
			} else {
				$msg[$i] = "Sorry, file already exists check upload folder: " . $fileName;
			}
		} else {
			$msg[$i] = "Sorry, only JPG, JPEG, PNG, GIF, PDF, DOCX &amp; TEXT files are allowed: " . $fileName;
		}
	}

	echo json_encode($msg);
}

