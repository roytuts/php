<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP File Upload Example</title>
    </head>
    <body>
		<h1>Single File Upload Example using PHP</h1>
        <?php
			if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
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
			}
        ?>

        <form name="upload_form" enctype="multipart/form-data" action="file_upload.php" method="POST">
            <label>File</label>&nbsp;<input type="file" id="file" name="file" /><br/><br/>
            <input type="submit" name="upload" value="Upload"/>
        </form>
    </body>
</html>