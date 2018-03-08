<?php
require_once '../../includes/dbconnect.php';

if (isset($_POST['restore'])){
	$DID = $_POST['DID'];
	mysqli_query($DB_con,"UPDATE `faculty_den` SET status = 'active' WHERE `faculty_den`.`DID` = '$DID'");
}
?>