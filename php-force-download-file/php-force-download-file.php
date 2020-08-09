<?php
require_once 'common.php';

if (isset($_POST['download'])) {
    force_download('pclzip.lib.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <h3>Force Download File</h3>
            <div>
                <input type="submit" name="download" value="Download"/>
            </div>
        </form>
    </body>
</html>