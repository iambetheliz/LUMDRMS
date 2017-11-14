<?php
  require_once '../includes/dbconnect.php';
$DB_con = mysqli_connect("localhost", "root", "", "records");

if(isset($_POST['del'])){
		$FacultyID=$_POST['FacultyID'];
		mysqli_query($DB_con,"delete from `faculties` where FacultyID='$FacultyID'");
	}
?>