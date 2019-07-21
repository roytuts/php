<?php
    session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>My Home</title>
		
		<script type="text/javascript">
			function overlay() {
				el = document.getElementById("overlay");
				el.style.visibility = (el.style.visibility == "visible") ? "hidden"
						: "visible";
				setTimeout(function() {
					window.location = "/php-session-expiry-message/login.php";
				}, 5000);
			}
			var secondsBeforeExpire = <?php echo ($_SESSION['expiry_time'] - $_SESSION['start_time']);?>; //5 sec expiry time
			setTimeout(function() {
				overlay();
			}, secondsBeforeExpire * 1000);
		</script>
		
		<style type="text/css">
			#overlay {
				visibility: hidden;
				position: absolute;
				left: 0px;
				top: 0px;
				width: 100%;
				height: 100%;
				text-align: center;
				z-index: 1000;
			}

			#overlay div {
				width: 300px;
				height: 100px;
				margin: 100px auto;
				background-color: #fff;
				border: 2px solid #000;
				padding: 15px;
				text-align: center;
				font-size: 16px;
				font-weight: bold;
			}
		</style>
	</head>
	<body>
<?php	
	if(!isset($_SESSION['user_name'])) {
		header('Location: /php-session-expiry-message/login.php');
		exit;
	} else {
        $now = time(); // Checking the time now when home page starts.
        if ($now > $_SESSION['expiry_time']) {
			$_SESSION = array();
            session_destroy();
            echo "Your session has expired! <a href='/php-session-expiry-message/login.php'>Login here</a>";
        } else {
?>
		Welcome <?php echo $_SESSION['user_name']; ?>. You have successfully logged in.
		<a href="/php-session-expiry-message/logout.php" onclick="return confirm('Are you sure want to logout?')">Logout</a>
<?php
		}
	}
?>
		<div id="overlay">
			<p>
				Your session has expired!<br /><br />Please <a href="login.php">Click Here</a>
				to go back to Login Page. <br />
				<br />
				<br /> You will be automatically redirected after 5 seconds...
			</p>
		</div>
	</body>
</html>