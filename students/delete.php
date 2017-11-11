<?php
  require_once '../includes/dbconnect.php';
$DB_con = mysqli_connect("localhost", "root", "", "records");

if(isset($_POST['del'])){
		$StudentID=$_POST['StudentID'];
		mysqli_query($DB_con,"delete from `students` where StudentID='$StudentID'");
	}
?>