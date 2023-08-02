<?php
    
/*$data = array('sendfile[0]' =>
		curl_file_create('C:\Cognizant\MyDocs\java-math-round-issue.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'Word-doc.docx'),
		'sendfile[1]' => curl_file_create('C:\Cognizant\MyDocs\myphoto.jpg', 'image/jpeg', 'mine.jpg'));*/
		
/*$data = array('sendfile[0]' =>
		new cURLFile('C:\Cognizant\MyDocs\java-math-round-issue.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'Word-doc.docx'),
		'sendfile[1]' => new cURLFile('C:\Cognizant\MyDocs\myphoto.jpg', 'image/jpeg', 'mine.jpg'));*/

$data = array();
$data['sendfile[0]'] = curl_file_create('C:\Cognizant\MyDocs\java-math-round-issue.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'Word-doc.docx');
$data['sendfile[1]'] = curl_file_create('C:\Cognizant\MyDocs\myphoto.jpg', 'image/jpeg', 'mine.jpg');

$ch = curl_init();     
curl_setopt($ch, CURLOPT_URL, 'http://localhost/php-rest-api-files-upload.php');
curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: multipart/form-data'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($ch);
curl_close($ch);
