<?php
require_once 'config.php';

$temp = '';
$errors = '';
$clss = 'error';
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $errors .= "\nEmail/Username and Password required.";
        $temp.="N";
    }

    if (!empty($username) && strlen($username) > 80) {
        $errors .= "\nMax length of Email Address:80";
        $temp.="N";
    }

    if ((!empty($password) && strlen($password) > 20)) {
        $errors .= "\nMax length of Password:25";
        $temp.="N";
    }

    if (empty($temp)) {
        $_POST['password'] = '';
        $_POST['email'] = '';
        //$clss = 'success';
        $result = user_login($username, $password);
        $errors .= $result;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Remember Me Example</title>
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
        <form method="post"
              action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                  <?php
                  if (!empty($errors)) {
                      echo "<p class='" . $clss . "'>" . nl2br($errors) . "</p>";
                  }
                  ?>
            <h3>Login</h3>
            <div>
                <input type="text" name="username" title="Username/Email"
                       tabindex="1" autocomplete="off"
                       value="<?php echo isset($_COOKIE['cookname']) ? $_COOKIE['cookname'] : @htmlspecialchars($_POST['username']); ?>"/>
            </div>
            <div>
                <input type="password" name="password" title="Password" tabindex="2"
                       autocomplete="off" value="<?php echo isset($_COOKIE['cookpass']) ? $_COOKIE['cookpass'] : ''; ?>"/>
            </div>
            <p>
                <label>
                    <input type="checkbox" name="remember_me" tabindex="3"
                           value="1" <?php echo isset($_COOKIE['cookrem']) ? 'checked="checked"' : ''; ?>
                           autocomplete="off"/>&nbsp;Remember me
                </label>
            </p>
            <div>
                <input type="submit" name="login" value="Login" tabindex="4"/>
            </div>
        </form>
    </body>
</html>