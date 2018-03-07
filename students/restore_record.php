<?php
require_once '../includes/dbconnect.php';

if(isset($_POST['restore'])){
	$StudentID = $_POST['StudentID'];
	$status = 'active';
	mysqli_query($DB_con,"UPDATE `students` SET status = 'active' WHERE StudentID = '$StudentID'");
}
?>