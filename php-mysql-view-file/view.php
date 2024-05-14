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
        <title>PHP Retrieve File From Database</title>
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
            if(in_array($row['type'], $img_types)) { ?>
            <label><strong>Image Name:</strong> <U><?php echo $row['name']; ?></U></label><p/>
            <img src="data:image/<?php echo $row['type']; ?>;charset=utf8;base64,<?php echo base64_encode($row['content']); ?>" alt="<?php echo $row['name']; ?>" />
            <p/>
        <?php } } ?>
    </div> 
<?php }else{ ?> 
    <p class="status error">Image(s) not found...</p> 
<?php } ?>

</body>
</html>
