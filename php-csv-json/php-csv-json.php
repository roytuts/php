<?php

header('Content-type: application/json; charset=UTF-8');

//$file = "student.csv";
//$csv = file_get_contents($file);

$csv = 'student_id,student_dob,student_email,student_address
1,01-01-1980,sumit@email.com,Garifa
2,01-01-1982,gourab@email.com,Garia
3,01-01-1982,debina@email.com,Salt Lake
4,01-01-1992,souvik@email.com,Alipore
5,01-01-1990,liton@email.com,Salt Lake';

$content = array_map("str_getcsv", explode("\n", $csv));

$headers = $content[0];

$json = [];

// iterate through each row in the data
foreach ($content as $row_index => $row_data) {
	// skip the first row, since it's the headers
	if($row_index === 0) continue;

	// iterate through each column in the row
	foreach ($row_data as $col_idx => $col_val) {

		// get the key for each entry
		$label = $headers[$col_idx];

		// add this column's value to this row's index / column's key
		$json[$row_index][$label] = $col_val;
	}
}

//output as JSON string
echo json_encode($json, JSON_PRETTY_PRINT);

//write to JSON file
$fp = fopen('student.json', 'w');
fwrite($fp, json_encode($json, JSON_PRETTY_PRINT));
fclose($fp);