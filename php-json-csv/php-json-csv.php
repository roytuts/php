<?php

header('Content-type: text/plain; charset=UTF-8');

$file = "student.json";
$json = file_get_contents($file);

$fcsv = fopen('student.csv', 'w');

/*$json = '{
    "1": {
        "student_id": "1",
        "student_dob": "01-01-1980",
        "student_email": "sumit@email.com",
        "student_address": "Garifa"
    },
    "2": {
        "student_id": "2",
        "student_dob": "01-01-1982",
        "student_email": "gourab@email.com",
        "student_address": "Garia"
    },
    "3": {
        "student_id": "3",
        "student_dob": "01-01-1982",
        "student_email": "debina@email.com",
        "student_address": "Salt Lake"
    },
    "4": {
        "student_id": "4",
        "student_dob": "01-01-1992",
        "student_email": "souvik@email.com",
        "student_address": "Alipore"
    },
    "5": {
        "student_id": "5",
        "student_dob": "01-01-1990",
        "student_email": "liton@email.com",
        "student_address": "Salt Lake"
    }
}';*/

$array = json_decode($json, true);

$csv = '';

$header = false;
foreach ($array as $line) {	
    if (empty($header)) {
        $header = array_keys($line);
        fputcsv($fcsv, $header);
		$csv .= implode(',', $header);
        $header = array_flip($header);		
    }
	
	$line_array = array();
	
	foreach($line as $value) {
		array_push($line_array, $value);
	}
	
	$csv .= "\n" . implode(',', $line_array);

    fputcsv($fcsv, $line_array);
}

//output as CSV string
echo $csv;

//close CSV file after write
fclose($fcsv);