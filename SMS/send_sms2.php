<?php
$from = $_POST['from'];
$to = $_POST['to'];
$carrier = $_POST['carrier'];
$message = stripslashes($_POST['message']);

if ((empty($from)) || (empty($to)) || (empty($message))) {
	echo "error";
}

else if ($carrier == "verizon") {
$formatted_number = $to."@pmms.globe.com.ph";
mail("$formatted_number", "SMS", "$message"); 
// Currently, the subject is set to "SMS". Feel free to change this.

header ("Location: text.php");
}

else if ($carrier == "tmobile") {
$formatted_number = $to."@tomomail.net";
mail("$formatted_number", "SMS", "$message");

header ("Location: text.php");
}

else if ($carrier == "sprint") {
$formatted_number = $to."@messaging.sprintpcs.com";
mail("$formatted_number", "SMS", "$message");

header ("Location: text.php");
}

else if ($carrier == "att") {
$formatted_number = $to."@txt.att.net";
mail("$formatted_number", "SMS", "$message");
header ("Location: text.php");
}

else if ($carrier == "virgin") {
$formatted_number = $to."@vmobl.com";
mail("$formatted_number", "SMS", "$message");

header ("Location: text.php");
}
?>