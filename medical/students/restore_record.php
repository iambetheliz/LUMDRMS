<?php
require_once '../../includes/dbconnect.php';

if (isset($_POST['restore'])){
	$MedID = $_POST['MedID'];
	mysqli_query($DB_con,"UPDATE `students_med` SET status = 'active' WHERE `students_med`.`MedID` = '$MedID'");
}
?>