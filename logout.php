<?php
	session_start();
	
	if (!isset($_SESSION['user'])) {
		header("Location: index.php?attempt");
	} else if(isset($_SESSION['user'])!="") {
		header("Location: dashboard.php?loginSuccess");
	}
	
	if (isset($_GET['logout'])) {
		unset($_SESSION['user']);
		session_unset();
		session_destroy();
		header("Location: /lu_clinic");
		exit;
	}
?>