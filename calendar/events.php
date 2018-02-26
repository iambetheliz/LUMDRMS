<?php

 	$json = array();

 	$events = "SELECT * FROM events ORDER BY id";

 	try {
 		require "includes/dbconnect.php";
 	} catch(Exception $e) {
    	exit('Unable to connect to database.');
 	}

 	$result = $DB_con->query($events) or die(print_r($DB_con->errorInfo()));

 	echo json_encode($result->fetchAll(PDO::FETCH_ASSOC));
 	
?>