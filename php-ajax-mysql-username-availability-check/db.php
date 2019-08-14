<?php
	
	$dbConn = mysqli_connect('localhost', 'root', 'root', 'roytuts') or die('MySQL connect failed. ' . mysqli_connect_error());
	
	function dbQuery($sql) {
		global $dbConn;
		$result = mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));
		return $result;
	}
	
	function dbNumRows($result) {
		return mysqli_num_rows($result);
	}

	function closeConn() {
		global $dbConn;
		mysqli_close($dbConn);
	}