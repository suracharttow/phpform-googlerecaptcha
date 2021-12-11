<?php

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$token = $_POST['token'];

if(!empty($name) && !empty($email) && !empty($message) && !empty($token)) {

   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
   curl_setopt($ch, CURLOPT_POST, 1);
   curl_setopt($ch, CURLOPT_POSTFIELDS,
      "secret=YOUR_SERVER_KEY&response=$token");
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   $server_output = curl_exec($ch);
   curl_close ($ch);

   $json = json_decode($server_output);
   echo $json->success ? 1:2;
}
else {
   echo 'Please input form';
}

?>