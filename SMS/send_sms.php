<?php

$phone = $_POST["cphone"];
$message = $_POST["message"];

send_sms($phone, $message);

function send_sms($phone, $message) {
$username = "639264223340";
$password = "6853";
$mobile = $phone;
$sender = "Sunshine";
$message = $message;
$url = "http://sendpk.com/api/sms.php?username=".$username."&password=".$password."&mobile=".$mobile."&sender=".urlencode($sender)."&message=".urlencode($message)."";

$ch = curl_init();
$timeout = 30;
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
$responce = curl_exec($ch);
curl_close($ch);
/*Print Responce*/
echo $responce;
}