<?php

try {
	require "../includes/dbconnect.php";
} catch(Exception $e) {
	exit('Unable to connect to database.');
}

$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];
$color = $_POST['color'];
$category = $_POST['category'];

$sql = "INSERT INTO events(title, start, end, color) values ('$title', '$start', '$end', '$color')";
$q = $DB_con->prepare($sql);
$q->execute();

if ($category == 'public') {
	header("Location: sms.php");
}

?>