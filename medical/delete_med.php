<?php
require_once '../includes/dbconnect.php';
$DB_con = mysqli_connect("localhost", "root", "", "records");

if(isset($_POST['del'])){
		$MedID = $_POST['MedID'];
		mysqli_query($DB_con,"DELETE FROM `students_med` WHERE MedID = '$MedID'");
	}
?>