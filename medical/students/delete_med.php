<?php
require_once '../../includes/dbconnect.php';

if(isset($_POST['del'])){
		$MedID = $_POST['MedID'];
		mysqli_query($DB_con,"UPDATE `students_med` SET status = 'deleted', date_deleted = NOW() WHERE `students_med`.`MedID` = '$MedID'");
	}
?>