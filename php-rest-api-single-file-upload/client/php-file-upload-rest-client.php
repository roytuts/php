<?php
    
$data = array('sendfile' => curl_file_create('C:\MyDocs\java-math-round-issue.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'Word-doc.docx'));

$ch = curl_init();     
curl_setopt($ch, CURLOPT_URL, 'http://localhost/php-rest-api-file-upload.php');
curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: multipart/form-data'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($ch);
curl_close($ch);
