<?php
	ob_start();
	require_once 'includes/dbconnect.php';

	if(empty($_SESSION)) // if the session not yet started 
	  session_start();
	  
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
	header("Location: index.php?attempt");
	exit;
	}

	$DB_con = new mysqli("localhost", "root", "", "records");

	if ($DB_con->connect_errno) {
	  echo "Connect failed: ", $DB_con->connect_error;
	exit();
	}

	$new_password  = $_POST['new_password'];
	$password = hash('sha256', $new_password);

	mysqli_query($DB_con,"UPDATE users SET userPass = '$password' WHERE userId=".$_SESSION['user']);
?>