<?php

function user_logout() {
    session_start();
    $_SESSION = array(); // reset session array
    session_destroy();   // destroy session.
    header('Location: /php-session-expiry-message/login.php');
    exit;
}

user_logout();

/*
 * End of file logout.php
 */