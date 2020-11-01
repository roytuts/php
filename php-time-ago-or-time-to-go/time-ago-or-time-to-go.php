<?php

echo nl2br('Current Date and Time -> '.date('Y-m-d H:i:s')."\n");

$date = '2014-04-10 14:20:15';
echo nl2br($date. ' -> ' . time_ago($date)."\n");

$date = '2016-07-20 14:20:15';
echo nl2br($date. ' -> ' . time_ago($date)."\n");

$date = '2019-08-13 05:43:45';
echo nl2br($date. ' -> ' . time_ago($date)."\n");


function time_ago($date) {
	$is_valid = is_date_time_valid($date);
	
	if ($is_valid) {
		$timestamp = strtotime($date);
		$difference = time() - $timestamp;
		$periods = array("sec", "min", "hour", "day", "week", "month", "year", "decade");
		$lengths = array("60", "60", "24", "7", "4.35", "12", "10");

		if ($difference > 0) { // this was in the past time
			$ending = "ago";
		} else { // this is in the future time
			$difference = -$difference;
			$ending = "to go";
		}
		
		for ($j = 0; $difference >= $lengths[$j]; $j++)
			$difference /= $lengths[$j];
		
		$difference = round($difference);
		
		if ($difference > 1)
			$periods[$j].= "s";
		
		$text = "$difference $periods[$j] $ending";
		
		return $text;
	} else {
		return 'Date Time must be in "yyyy-mm-dd hh:mm:ss" format';
	}
}

function is_date_time_valid($date) {
	
	if (date('Y-m-d H:i:s', strtotime($date)) == $date) {
		return TRUE;
	} else {
		return FALSE;
	}
}