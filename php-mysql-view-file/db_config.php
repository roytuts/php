<?php  
// Database connection details
$db_host     = "localhost";
$db_username = "root";
$db_password = "root";
$db_name     = "roytuts";
  
// Database connection
$db = new mysqli($db_host, $db_username, $db_password, $db_name);
  
// Verify connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
