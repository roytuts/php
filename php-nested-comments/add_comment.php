<?php

	require("config.php");
	require("helper.php");

	if (isset($_POST)) {
		$parent_id = ($_POST['reply_id'] == NULL || $_POST['reply_id'] == '') ? 0 : $_POST['reply_id'];
		$comment_text = $_POST['comment_text'];
		$depth_level = ($_POST['depth_level'] == NULL || $_POST['depth_level'] == '') ? 0 : $_POST['depth_level'];;
		$sql = "INSERT INTO comment(comment_text, parent_id) VALUES('$comment_text', $parent_id)";
		$query = dbQuery($sql);
		$inserted_id = dbInsertId();
		$sql = "SELECT * FROM comment WHERE comment_id=" . $inserted_id;
		$results = dbQuery($sql);
		if ($results) {
			while ($row = dbFetchAssoc($results)) {
				if ($depth_level < 3) {
					$reply_link = "<a href=\"#\" class=\"reply_button\" id=\"{$row['comment_id']}\">reply</a><br/>";
				} else {
					$reply_link = '';
				}
				$depth = $depth_level + 1;
				echo "<li id=\"li_comment_{$row['comment_id']}\" data-depth-level=\"{$depth}\">" .
				"<span class=\"comment_date\">{$row['comment_date']}</span></div>" .
				"<div style=\"margin-top:4px;\">{$row['comment_text']}</div>" .
				$reply_link . "</li>";
			}
			echo '<div class="success">Comment successfully posted</div>';
		} else {
			echo '<div class="error">Error in adding comment</div>';
		}
	} else {
		echo '<div class="error">Please enter required fields</div>';
	}
?>