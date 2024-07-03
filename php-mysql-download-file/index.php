<?php 
// Include the database configuration file  
require_once 'db_config.php';
 
// Get image data from database 
$result = $db->query("SELECT * FROM file ORDER BY id DESC");

$img_types = array('jpg','png','jpeg','gif'); 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP Download File From Database</title>
        <style>
            img {
                display: block;
                max-width:280px;
                max-height:280px;
                width: auto;
                height: auto;
            }
        </style>
    </head>
    <body>

<!-- Display images with BLOB data from database -->
<?php if($result->num_rows > 0){ ?>
    <div class="gallery"> 
        <?php while($row = $result->fetch_assoc()){            
            if(!in_array($row['type'], $img_types)) { ?>
			<label><strong>File Name:</strong> <U><?php echo $row['name']; ?></U></label>&nbsp;&nbsp;<a href="download.php?id=<?php echo $row['id'];?>">Download</a><p/>
		<?php } } ?>
    </div> 
<?php }else{ ?> 
    <p class="status error">File(s) not found...</p> 
<?php } ?>

</body>
</html>
