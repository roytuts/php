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
	
	$sql = "INSERT INTO company(name) VALUES('" . mysqli_real_escape_string($dbConn, $data->name) . "')";
	dbQuery($sql);
}

//End of file