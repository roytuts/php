<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/db.php';
include_once '../object/department.php';

// instantiate database and department object
$database = new Db();
$db = $database->getConnection();

// initialize object
$department = new Department($db);

// query department
$stmt = $department->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {
    // department array
    $department_arr = array();
    $department_arr["records"] = array();

    // retrieve table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        extract($row);
		
        $department_item = array(
            "id" => $row['dept_id'],
            "name" => $row['dept_name']
        );
		
        array_push($department_arr["records"], $department_item);
    }
	
    echo json_encode($department_arr);
} else {
    echo json_encode(
            array("message" => "No record found for department.")
    );
}

