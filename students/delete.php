<?php
require_once '../includes/dbconnect.php';

if(isset($_POST['del'])){
	$StudentID = $_POST['StudentID'];
	mysqli_query($DB_con,"UPDATE `students` SET status = 'deleted', date_deleted = NOW() WHERE StudentID = '$StudentID'");
}
?>