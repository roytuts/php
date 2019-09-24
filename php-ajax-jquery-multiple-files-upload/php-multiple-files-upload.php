<?php

if (isset($_FILES['files']) && !empty($_FILES['files'])) {
    $no_files = count($_FILES["files"]['name']);
    for ($i = 0; $i < $no_files; $i++) {
        if ($_FILES["files"]["error"][$i] > 0) {
            echo "Error: " . $_FILES["files"]["error"][$i] . "<br>";
        } else {
            if (file_exists('uploads/' . $_FILES["files"]["name"][$i])) {
                echo 'File already exists : uploads/' . $_FILES["files"]["name"][$i];
            } else {
                move_uploaded_file($_FILES["files"]["tmp_name"][$i], 'uploads/' . $_FILES["files"]["name"][$i]);
                echo 'File successfully uploaded : uploads/' . $_FILES["files"]["name"][$i] . ' ';
            }
        }
    }
} else {
    echo 'Please choose at least one file';
}
    
/* 
 * End of script
 */