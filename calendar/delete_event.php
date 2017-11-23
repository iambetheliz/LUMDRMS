<?php

$id = $_POST['id'];

try {
	require "../includes/dbconnect.php";
} catch(Exception $e) {
	exit('Unable to connect to database.');
}

$sql = "DELETE from events WHERE id=".$id;
$q = $DB_con->prepare($sql);
$q->execute();

?>