<?php
require_once '../../includes/dbconnect.php';
$DB_con = mysqli_connect("localhost", "root", "", "records");

if(isset($_POST['del'])){
		$DID = $_POST['DID'];
		mysqli_query($DB_con,"DELETE FROM `students_den` WHERE DID = '$DID'");
	}
?>