<?php

function isEmailValid1($email) {
	$pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

    if (preg_match($pattern, trim($email))) {
        return true;
    }
	
    return false;
}

//filter_var() available in PHP 5.2.0+
function isEmailValid2($email){ 
	return filter_var($email, FILTER_VALIDATE_EMAIL) !== false; //will not validate TLD in PHP 5.2.0
    //return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email); //fix for "will not validate TLD in PHP 5.2.0"
}


//Usages
echo 'Method 1 - isEmailValid1()';
echo "\r\n";
echo "\r\n";

$email = "abc";
$valid = isEmailValid1($email);
echo $valid ? "True" : "False";

echo "\r\n";

$email = "abc@";
$valid = isEmailValid1($email);
echo $valid ? "True" : "False";

echo "\r\n";

$email = "abc@roytuts.com";
$valid = isEmailValid1($email);
echo $valid ? "True" : "False";

echo "\r\n";

$email = "abc@roytuts.com.com";
$valid = isEmailValid1($email);
echo $valid ? "True" : "False";

echo "\r\n";

$email = "bazmega@kapa";
$valid = isEmailValid1($email);
echo $valid ? "True" : "False";

echo "\r\n";
echo "\r\n";
echo 'Method 2 - isEmailValid2()';
echo "\r\n";
echo "\r\n";

$email = "abc";
$valid = isEmailValid2($email);
echo $valid ? "True" : "False";

echo "\r\n";

$email = "abc@";
$valid = isEmailValid2($email);
echo $valid ? "True" : "False";

echo "\r\n";

$email = "abc@roytuts.com";
$valid = isEmailValid2($email);
echo $valid ? "True" : "False";

echo "\r\n";

$email = "abc@roytuts.com.com";
$valid = isEmailValid2($email);
echo $valid ? "True" : "False";

echo "\r\n";

$email = "bazmega@kapa";
$valid = isEmailValid2($email);
echo $valid ? "True" : "False";

echo "\r\n";