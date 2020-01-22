<?php

function check_login() {
    /* Check if user has been remembered */
    if (isset($_COOKIE['cookname'])) {
        $_SESSION['user_name'] = $_COOKIE['cookname'];
    }

    if (isset($_COOKIE['cookpass'])) {
        $_SESSION['user_pass'] = $_COOKIE['cookpass'];
    }

    if (isset($_COOKIE['cookrem'])) {
        $_SESSION['user_rem'] = $_COOKIE['cookrem'];
    }

    /* Username and password have been set */
    if (isset($_SESSION['user_name']) && isset($_SESSION['user_pass'])) {
        /* Confirm that username and password are valid */
        if (confirm_user($_SESSION['user_name'], $_SESSION['user_pass']) === FALSE) {
            /* Variables are incorrect, user not logged in */
            unset($_SESSION['user_name']);
            unset($_SESSION['user_pass']);
            unset($_SESSION['user_rem']);
            return FALSE;
        }
		
        $row = dbFetchAssoc(confirm_user($_SESSION['user_name'], $_SESSION['user_pass']));
        $_SESSION['user_id'] = $row['account_id'];
        $_SESSION['last_login'] = $row['last_login'];
		
        return TRUE;
    } else {/* User not logged in */
        return FALSE;
    }
}

//user login
function user_login($username, $password) {
	if (check_login() === TRUE) {
		header('Location:' . WEB_ROOT . 'home.php');
		exit;
	} else {
		if (user_exists($username) === FALSE) {
			return "You are not a registered member";
		} else if (confirm_user($username, md5($password)) === FALSE) {
			return "Authentication error";
		} else {
			$_SESSION['user_name'] = $username;
			$_SESSION['user_pass'] = $password;
			
			$row = dbFetchAssoc(confirm_user($username, md5($password)));
			
			$_SESSION['user_id'] = $row['account_id'];
			$_SESSION['last_login'] = $row['last_login'];
			
			if (isset($_POST['remember_me'])) {
				$_SESSION['user_rem'] = $_POST['remember_me'];
				setcookie("cookname", $_SESSION['user_name'], time() + COOKIE_TIME_OUT);
				setcookie("cookpass", $_SESSION['user_pass'], time() + COOKIE_TIME_OUT);
				setcookie("cookrem", $_SESSION['user_rem'], time() + COOKIE_TIME_OUT);
			} else {
				//destroy any previously set cookie
				setcookie("cookname", '', time() - COOKIE_TIME_OUT);
				setcookie("cookpass", '', time() - COOKIE_TIME_OUT);
				setcookie("cookrem", '', time() - COOKIE_TIME_OUT);
			}

			//Login history
			$sql = "UPDATE user_account
					SET last_login=now()
					WHERE account_login='" . $username . "'";

			dbQuery($sql);

			header('Location:' . WEB_ROOT . 'home.php');
			exit;
		}
	}
}

function user_exists($username) {
    $sql = "SELECT ua.account_login,ua.user_name,ua.last_login
            FROM user_account ua
            WHERE (ua.account_login='$username' OR ua.user_email='$username')"
            . " LIMIT 1";

    $result = dbQuery($sql);

    if (!$result || (dbNumRows($result) < 1)) {
        return FALSE; //Indicates username failure
    }

    return $result;
}

function confirm_user($username, $password) {
    /* Verify that user is in database */
    $sql = "SELECT ua.account_login,ua.user_name,ua.last_login
            FROM user_account ua
            WHERE (ua.account_login='$username' OR ua.user_email='$username')
                AND ua.account_password='$password' LIMIT 1";

    $result = dbQuery($sql);

    if (!$result || (dbNumRows($result) < 1)) {
        return FALSE; //Indicates username failure
    }

    return $result;
}

//do user logout
function user_logout() {
    session_start();
    $_SESSION = array(); // reset session array
    session_destroy();   // destroy session
	
    header('Location: ' . WEB_ROOT . 'login.php');
    exit;
}

/*
 * End of common.php
 */