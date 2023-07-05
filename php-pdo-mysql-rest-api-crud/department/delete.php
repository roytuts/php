<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object files
include_once '../config/db.php';
include_once '../object/department.php';

$database = new Db();
$db = $database->getConnection();

// initialize object
$department = new Department($db);

// set ID property of department to be deleted
$department->id = filter_input(INPUT_GET, 'id');

// delete the department
if ($department->delete()) {
    echo '{';
    echo '"message": "Department was deleted."';
    echo '}';
}

// if unable to delete the department
else {
    echo '{';
    echo '"message": "Unable to delete department."';
    echo '}';
}

