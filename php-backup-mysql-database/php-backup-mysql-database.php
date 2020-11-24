<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title></title>
    </head>
<body>
    <p><strong>Starting MySQL Database Backup</strong></p>
    <?php
        db_backup('localhost', 'root', 'root', 'roytuts');
    ?>
    <p style="color:green;"><strong>Database Backup Successfully Done</strong></p>
</body>
</html>