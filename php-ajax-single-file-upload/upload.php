<?php
	if (isset($_FILES['file']['name'])) {
		if (0 < $_FILES['file']['error']) {
			echo '<span style="color:red;">Error during file upload ' . $_FILES['file']['error'] . '</span>';
		} else {
			if (file_exists('uploads/' . $_FILES['file']['name'])) {
				echo '<span style="color:red;">File already exists at uploads/' . $_FILES['file']['name'] . '</span>';
			} else {
				move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
				echo '<span style="color:green;">File successfully uploaded to uploads/' . $_FILES['file']['name'] . '</span>';
			}
		}
	} else {
		echo '<span style="color:red;">Please choose a file</span>';
	}
	echo nl2br("\n");
?>