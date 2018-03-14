<?php
require_once '../../includes/dbconnect.php';

if(isset($_POST['del'])){
		$DID = $_POST['DID'];
		mysqli_query($DB_con,"UPDATE `students_den` SET status = 'deleted', date_deleted = NOW() WHERE DID = '$DID'");
	}
?>