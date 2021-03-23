<?php
require_once 'config.php';

if (!isset($_SESSION['user_name']) && !isset($_SESSION['user_pass'])) {
	header('Location:' . WEB_ROOT . 'login.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>My Home</title>
    </head>
    <body>
		Welcome! You have successfully logged in. Thank you.
		<a href="<?php echo WEB_ROOT; ?>logout.php" onclick="return confirm('Are you sure want to logout?')">Logout</a>
    </body>
</html>