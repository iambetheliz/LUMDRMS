<?php

$id = $_POST['id'];
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];

try {
 	require "../includes/dbconnect.php";
} catch(Exception $e) {
	exit('Unable to connect to database.');
}

$sql = "UPDATE events SET title=?, start=?, end=? WHERE id=?";
$q = $DB_con->prepare($sql);
$q->execute(array($title,$start,$end,$id));

?>