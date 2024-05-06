<?php 
// Include the database configuration file  
require_once 'db_config.php';
// Include utility function file
require_once 'utils.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP Save File To Database</title>
    </head>
    <body>

    <?php
    // If file upload form is submitted 
    $status = $status_msg = ''; 

    if(isset($_POST["submit"])){ 
        $status = 'error'; 
        if(!empty($_FILES["file"]["name"])) { 
            // Get file info 
            $file_name = basename($_FILES["file"]["name"]); 
            $fileType = pathinfo($file_name, PATHINFO_EXTENSION);

            clearstatcache();
            $file_size = fileSizeConvert($_FILES["file"]["size"]);
            
            $file = $_FILES['file']['tmp_name'];
            $imgContent = addslashes(file_get_contents($file)); 
            
            // Insert file content into database 
            $insert = $db->query("INSERT into file (name, content, size, type, created) VALUES ('$file_name', '$imgContent', '$file_size', '$fileType', NOW())");

            if($insert){
                $status = 'success'; 
                $status_msg = '<span style="color:green;">File uploaded successfully.</span>'; 
            }else{ 
                $status_msg = '<span style="color:red;">File upload failed, please try again.</span>'; 
            }
        }else{ 
            $status_msg = '<span style="color:red;">Please select a file to upload.</span>'; 
        } 
    }

    // Display status message 
    echo $status_msg; 
    ?>

    <p/>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label>Select A File:</label>
        <input type="file" name="file">
        <input type="submit" name="submit" value="Upload">
    </form>

</body>
</html>
