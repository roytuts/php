<?php

header("Acess-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Acess-Control-Allow-Methods: POST");
header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods, Authorization");

$data = json_decode(file_get_contents("php://input"), true); // collect input parameters and convert into readable format
	
$fileName  =  $_FILES['sendfile']['name'];
$tempPath  =  $_FILES['sendfile']['tmp_name'];
$fileSize  =  $_FILES['sendfile']['size'];
		
if(empty($fileName)) {
	echo json_encode(array("message" => "please select a file", "status" => false));	
} else {
	$upload_path = 'upload/'; // set upload folder path 
	
	$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // get file extension
	
	// valid file extensions
	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'pdf', 'docx', 'txt'); 
					
	// allow valid file formats
	if(in_array($fileExt, $valid_extensions)) {
		//check file does not exist in the upload folder path
		if(!file_exists($upload_path . $fileName)) {
			// check file size '5MB'
			if($fileSize < 5000000) {
				if(move_uploaded_file($tempPath, $upload_path . $fileName)) { // move file from system temporary path to the upload folder path
					echo json_encode(array("message" => "File Uploaded Successfully", "status" => true));
				} else {
					echo json_encode(array("message" => "File couldn't be uploaded", "status" => false));
				}
			} else {		
				echo json_encode(array("message" => "Sorry, your file is too large, please upload 5 MB size", "status" => false));
			}
		} else {		
			echo json_encode(array("message" => "Sorry, file already exists check upload folder", "status" => false));
		}
	} else {
		echo json_encode(array("message" => "Sorry, only JPG, JPEG, PNG, GIF, PDF, DOCX &amp; TEXT files are allowed", "status" => false));
	}
}

