<?php

function josephWinner($noOfPeople, $remStartPos) {
	$arr = array();
	for($i = 0; $i < $noOfPeople; $i++) {
		array_push($arr, ($i+1));
	}

	$calRemPos = $remStartPos - 1;
	$iterations = $noOfPeople - 1;
	while($iterations > 0) {
		unset($arr[$calRemPos]);

		$arr = array_values($arr);

		$calRemPos += $remStartPos - 1;
		if ($calRemPos > (count($arr) - 1)) {
			$calRemPos = $calRemPos % count($arr);
		}
		$iterations--;
	}
	return current($arr);
}

$winner = josephWinner(5, 3);
echo ('winner is ' . $winner);
echo nl2br("\n");
$winner = josephWinner(10, 3);
echo ('winner is ' . $winner);
echo nl2br("\n");
$winner = josephWinner(5, 2);
echo ('winner is ' . $winner);
echo nl2br("\n");
$winner = josephWinner(7, 3);
echo ('winner is ' . $winner);
echo nl2br("\n");

?>
