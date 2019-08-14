<?php

require_once 'db.php';

$post_username = $_POST['username'];

if (isset($post_username)) {
	$sql = "SELECT * FROM user WHERE login_username = '" . mysqli_real_escape_string($dbConn, $post_username) . "' LIMIT 1";
	$result = dbQuery($sql);
	
	if (dbNumRows($result) > 0) {
		echo '<span style="color:red;">Username unavailable</span>';
	} else {
		echo '<span style="color:green;">Username available</span>';
	}
	
	closeConn();
} else {
	echo '<span style="color:red;">Username is required field.</span>';
}