<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/db.php';
include_once '../object/department.php';

$database = new Db();
$db = $database->getConnection();

// initialize object
$department = new Department($db);

// get posted data
$data = json_decode(file_get_contents("php://input", true));

// set ID property of department to be updated
$department->id = $data->id;
// set department property value
$department->name = $data->name;

// update the department
if ($department->update()) {
    echo '{';
    echo '"message": "Department was updated."';
    echo '}';
}

// if unable to update the department, tell the user
else {
    echo '{';
    echo '"message": "Unable to update department."';
    echo '}';
}

