<?php

 // Request sending

	$url = "https://www.proovl.com/api/send.php";

	$postfields = array(
		'user' => "$user",
		'token' => "$token",
		'route' => "$route",
		'from' => "$from",
		'to' => "$to",
		'text' => "$text"
	);

	if (!$curld = curl_init()) {
		exit;
	}

	curl_setopt($curld, CURLOPT_POST, true);
	curl_setopt($curld, CURLOPT_POSTFIELDS, $postfields);
	curl_setopt($curld, CURLOPT_URL,$url);
	curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);

	$output = curl_exec($curld);

	curl_close ($curld);



 // Handle the response

	$result = explode(';',$output);

	if ($result[0] == "Error") {
		echo "Error message: $result[1]";
		die;
	} else {
		echo "Message ID: $result[1]; Status: $result[0]";
	}

?>