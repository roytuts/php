<?php

/**
* Author : https://www.roytuts.com
*/

require_once 'db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");

if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
	$sql = "DELETE FROM company WHERE id = " . mysqli_real_escape_string($dbConn, $_GET['id']);
	dbQuery($sql);
}

//End of file