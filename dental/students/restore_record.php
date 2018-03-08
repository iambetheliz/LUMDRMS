<?php
require_once '../../includes/dbconnect.php';

if (isset($_POST['restore'])){
	$DID = $_POST['DID'];
	mysqli_query($DB_con,"UPDATE `students_den` SET status = 'active' WHERE `students_den`.`DID` = '$DID'");
}
?>