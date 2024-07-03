<?php
// Include the database configuration file  
require_once 'db_config.php';

$id = $_GET['id'];

$query = "SELECT * FROM file WHERE id = $id";
$result = $db->query($query);

list($id, $name, $content, $size, $type) = mysqli_fetch_array($result);

header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header("Content-Transfer-Encoding: binary");
header('Pragma: public');
header("Content-length: $size");
header("Content-type: $type");
header("Content-Disposition: attachment; filename=$name");
echo $content;
