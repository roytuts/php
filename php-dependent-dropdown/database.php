<?php

	$dbConn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName) or die('MySQL connect failed. ' . mysqli_connect_error());
	
	function dbQuery($sql) {
		global $dbConn;
		$result = mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));
		return $result;
	}
	
	function dbFetchAssoc($result) {
		return mysqli_fetch_assoc($result);
	}
	
	function dbFetchRow($result) {
		return mysqli_fetch_row($result);
	}
	
	function dbNumRows($result) {
		return mysqli_num_rows($result);
	}
/*
* End of file database.php
*/