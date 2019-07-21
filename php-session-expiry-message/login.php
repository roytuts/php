<?php

$errors = '';
$clss = 'error';

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $errors .= "\nUsername and Password required.";
    } else {
        if($username === 'roy' && $password === 'roy') {
			session_start();
			$_SESSION['start_time'] = time();
			$_SESSION['expiry_time'] = $_SESSION['start_time'] + 5; //expiry in 5 sec
			$_SESSION['user_name'] = $username;
			header('Location: /php-session-expiry-message/home.php');
			exit;
		} else {
			$errors .= "\nInvalid Username and Password";
		}
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP Login</title>
        <style type="text/css">
            .error {
                color: red;
            }
            .success {
                color: green;
            }
        </style>
    </head>
    <body>
        <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
			<?php
				if (!empty($errors)) {
					echo "<p class='" . $clss . "'>" . nl2br($errors) . "</p>";
				}
			?>
            <h3>Login</h3>
            <div>
                <input type="text" name="username" title="Username"
                       tabindex="1" autocomplete="off"
                       value="<?php echo @htmlspecialchars($_POST['username']); ?>"/>
            </div>
            <div>
                <input type="password" name="password" title="Password" tabindex="2" autocomplete="off"/>
            </div>
            <div>
                <input type="submit" name="login" value="Login" tabindex="4"/>
            </div>
        </form>
    </body>
</html>