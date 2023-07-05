<?php

//var_dump(extension_loaded("curl"));

require_once 'rest-client.php';

$rest_api_base_url = 'http://localhost';
		
echo "\n" . 'READ' . "\n";
echo '---------------------' . "\n";

//GET - list of departments
$get_endpoint = '/department/read.php';

$response = perform_http_request('GET', $rest_api_base_url . $get_endpoint);

echo 'List Of Departments:' . "\n";
echo $response . "\n";

//GET - single department
/*$get_endpoint = '/api/users/2';

$response = perform_http_request('GET', $rest_api_base_url . $get_endpoint);

echo 'Single Department' . "\n";
echo $response . "\n";*/

echo "\n" . 'CREATE' . "\n";
echo '---------------------' . "\n";

//POST - create new department
$post_endpoint = '/department/create.php';

$request_data = json_encode(array("name" => "FINNCIAL"));

$response = perform_http_request('POST', $rest_api_base_url . $post_endpoint, $request_data);

echo $response . "\n";

//fetch all departments
$response = perform_http_request('GET', $rest_api_base_url . $get_endpoint);

echo 'List Of Departments:' . "\n";
echo $response . "\n";

echo "\n" . 'UPDATE' . "\n";
echo '---------------------' . "\n";

//PUT - update department
$put_endpoint = '/department/update.php';

$request_data = json_encode(array("id" => 41, "name" => "FINANCIAL"));

$response = perform_http_request('PUT', $rest_api_base_url . $put_endpoint, $request_data);

echo $response . "\n";

//fetch all departments
$response = perform_http_request('GET', $rest_api_base_url . $get_endpoint);

echo 'List Of Departments:' . "\n";
echo $response . "\n";

echo "\n" . 'DELETE' . "\n";
echo '---------------------' . "\n";

//DELETE - delete department
$delete_endpoint = '/department/delete.php?id=41';

$response = perform_http_request('DELETE', $rest_api_base_url . $delete_endpoint);

echo $response . "\n";

//fetch all departments
$response = perform_http_request('GET', $rest_api_base_url . $get_endpoint);

echo 'List Of Departments:' . "\n";
echo $response . "\n";


