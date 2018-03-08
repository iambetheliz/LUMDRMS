<?php
require_once '../../includes/dbconnect.php';

if(isset($_POST['del'])){
		$DID = $_POST['DID'];
		mysqli_query($DB_con,"UPDATE `faculty_den` SET status = 'deleted' WHERE DID = '$DID'");
	}
?>