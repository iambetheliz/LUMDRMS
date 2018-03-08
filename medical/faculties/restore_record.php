<?php
require_once '../../includes/dbconnect.php';

if (isset($_POST['restore'])){
	$MedID = $_POST['MedID'];
	mysqli_query($DB_con,"UPDATE `faculty_med` SET status = 'active' WHERE `faculty_med`.`MedID` = '$MedID'");
}
?>