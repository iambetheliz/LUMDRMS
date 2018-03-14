<?php
require_once '../../includes/dbconnect.php';

if(isset($_POST['del'])){
	$MedID = $_POST['MedID'];
	mysqli_query($DB_con,"UPDATE `faculty_med` SET status = 'deleted', date_deleted = NOW() WHERE `faculty_med`.`MedID` = '$MedID'");
}
?>