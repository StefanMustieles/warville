<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/emailconfig.php'; 

$url = EMAIL_URL;
$user = EMAIL_USERNAME;
$pass = EMAIL_PASSWORD; 

$name = @trim(stripslashes($_POST['name'])); 
$email = @trim(stripslashes($_POST['email'])); 
$subject = @trim(stripslashes($_POST['subject'])); 
$message = @trim(stripslashes($_POST['message'])); 

$params = array(
  'api_user' => $user,
  'api_key' => $pass,
  'to' => EMAIL_CONTACT,
  'subject' => $subject,
  'html' => $message,
  'text' => $message,
  'from' => $email,
);

$request = $url.'api/mail.send.json';

// Generate curl request
$session = curl_init($request);

$options = array(
        CURLOPT_RETURNTRANSFER => true,   // return web page
        CURLOPT_HEADER         => false,  // don't return headers
        CURLOPT_POST           => true,   // use HTTP POST
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POSTFIELDS     => $params // body of the POST
    );

curl_setopt_array($session, $options);

// obtain response
$response = curl_exec($session);

// Check for errors and display the error message
if($errno = curl_errno($session)) {
    $error_message = curl_strerror($errno);
    echo "cURL error ({$errno}):\n {$error_message} ";
}

curl_close($session);

$decodedResponse = json_decode($response, true);

if($response && $decodedResponse['message'] == 'success') {
    exit('Your message was sent sucessfully.');    
}
else {
    exit('Your message was not sent. Please try again later.');
}