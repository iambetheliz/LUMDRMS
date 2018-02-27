<?php
require_once '../includes/dbconnect.php';
$DB_con = mysqli_connect("localhost", "root", "", "records");

if (isset($_POST['restore'])){
	$FacultyID = $_POST['FacultyID'];
	mysqli_query($DB_con,"UPDATE `faculties` SET status = 'active' WHERE FacultyID = '$FacultyID'");
}
?>