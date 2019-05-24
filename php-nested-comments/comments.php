<?php
	require("config.php");
	require("helper.php");

	$sql = 'SELECT * FROM comment';
	$results = dbQuery($sql);
	$items = array();
	while ($row = dbFetchAssoc($results)) {
		$items[] = $row;
	}
	$comments = format_comments($items);
?>