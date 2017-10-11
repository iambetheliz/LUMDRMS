<?php
	session_start();
	
	if (!isset($_SESSION['user'])) {
		header("Location: /lu_clinic");
	} else if(isset($_SESSION['user'])!="") {
		header("Location: dashboard.php");
	}
	
	if (isset($_GET['logout'])) {
		unset($_SESSION['user']);
		session_unset();
		session_destroy();
		header("Location: /lu_clinic");
		exit;
	}
?>