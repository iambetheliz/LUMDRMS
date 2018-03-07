<?php
require_once '../../includes/dbconnect.php';

if(isset($_POST['del'])){
		$DID = $_POST['DID'];
		mysqli_query($DB_con,"DELETE FROM `students_den` WHERE DID = '$DID'");
	}
?>