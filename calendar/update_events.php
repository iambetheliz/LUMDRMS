<?php

try {
 	require "../includes/dbconnect.php";
} catch(Exception $e) {
	exit('Unable to connect to database.');
}

if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])){
	
	$id = $_POST['Event'][0];
	$start = $_POST['Event'][1];
	$end = $_POST['Event'][2];

	$private = $_POST['private'];
	$public = $_POST['public'];

	$sql = "UPDATE events SET  start = '$start', end = '$end' WHERE id = $id ";

	$query = $DB_con->prepare( $sql );
	$sth = $query->execute();
	header("Location: sms_update.php");
}

else {
	$id = $_POST['id'];
	$title = $_POST['title'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];
	$category = $_POST['category'];

	$sql = "UPDATE events SET  title = '$title', color = '$color', start = '$start', end = '$end' WHERE id = '$id' ";
	$q = $DB_con->prepare($sql);
	$q->execute();
	if ($category == 'public') {
		header("Location: sms_update.php");
	}
}

?>