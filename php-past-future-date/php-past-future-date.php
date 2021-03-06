<?php

date_default_timezone_set('Asia/Kolkata');
$date_format = 'Y-m-d'; //date format
$date = "2015-02-25"; //date from which the next or past date will be calculated
$curr_date = date('Y-m-d');

$future_date = date($date_format, strtotime($date . ' + 280 days')); //future date after adding 280 days to the above date
echo 'Future Date : ' . $future_date . '(' . $date_format . ')';
echo nl2br("\r\n");
echo 'Future Date with respect to current date: ' . date($date_format, strtotime($curr_date . ' + 280 days'));
echo nl2br("\r\n");
echo "===================================================";
echo nl2br("\r\n");
$past_date = date($date_format, strtotime($date . ' - 30 days')); //past date after subtracting 30 days from the above date
echo 'Past date : ' . $past_date . '(' . $date_format . ')';
echo nl2br("\r\n");
echo 'Past date with respect to current date: ' . date($date_format, strtotime($curr_date . ' - 30 days'));

echo nl2br("\r\n");
echo nl2br("\r\n");
echo 'Other textual values that get converted into Unix timestamps';
echo nl2br("\r\n");
echo "==============================================================";
echo nl2br("\r\n");
echo(strtotime("now") . "<br>");
echo(strtotime("3 October 2005") . "<br>");
echo(strtotime("+5 hours") . "<br>");
echo(strtotime("+1 week") . "<br>");
echo(strtotime("+1 week 3 days 7 hours 5 seconds") . "<br>");
echo(strtotime("next Monday") . "<br>");
echo(strtotime("last Sunday"));