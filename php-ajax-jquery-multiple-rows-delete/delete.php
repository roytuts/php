<?php

/**
* Author : https://www.roytuts.com
*/

require_once 'db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// get posted data
	$data = json_decode(file_get_contents("php://input", true));
	
	$sql = "DELETE FROM product p WHERE p.id IN (" . mysqli_real_escape_string($dbConn, $data->ids) . ")";
	
	$result = dbQuery($sql);
	
	if($result) {
		echo '<span style="color:green;">Product(s) successfully deleted</span>';
	} else {
		echo '<span style="color:red;">Something went wrong during product deletion</span>';
	}
}

//End of file