<?php
require_once '../includes/dbconnect.php';

if(isset($_POST['del'])){
		$userId = $_POST['userId'];
		mysqli_query($DB_con,"DELETE FROM `users` WHERE userId = '$userId'");
	}
?>