<?php

/**
* Author : https://www.roytuts.com
*/

require_once 'db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
	// get posted data
	$data = json_decode(file_get_contents("php://input", true));
	
	$sql = "UPDATE company SET name = '" . mysqli_real_escape_string($dbConn, $data->name) . "' WHERE id = " . $data->id;
	dbQuery($sql);
}

//End of file