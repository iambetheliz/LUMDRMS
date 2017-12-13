<?php

$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];

try {
	require "includes/dbconnect.php";
} catch(Exception $e) {
	exit('Unable to connect to database.');
}

$sql = "INSERT INTO events (title, start, end) VALUES (:title, :start, :end )";
$q = $DB_con->prepare($sql);
$q->execute(array(':title'=>$title, ':start'=>$start, ':end'=>$end));

?>