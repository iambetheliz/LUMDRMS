<?php
  require_once '../includes/dbconnect.php';

if(isset($_POST['del'])){
		$FacultyID=$_POST['FacultyID'];
		$status = 'deleted';
		mysqli_query($DB_con,"UPDATE `faculties` SET status = 'deleted' WHERE FacultyID = '$FacultyID'");
	}
?>