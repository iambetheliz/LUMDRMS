<?php
require_once '../includes/dbconnect.php';
$DB_con = mysqli_connect("localhost", "root", "", "records");

if(isset($_POST['restore'])){
	$StudentID = $_POST['StudentID'];
	$status = 'active';
	mysqli_query($DB_con,"UPDATE `students` SET status = 'active' WHERE StudentID = '$StudentID'");
}
?>