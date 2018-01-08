<?php
  include '../includes/dbconnect.php';
	$DB_con = mysqli_connect("localhost", "root", "", "records");

    if(!empty($_POST['dept'])){
		$facultyNo = $_POST['facultyNo'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $ext = $_POST['ext'];
        $age = $_POST['age'];
        $sex = $_POST['sex'];
        $dob = $_POST['dob'];
        $stat = $_POST['stat'];
        $dept = $_POST['dept'];
        $sem = $_POST['sem'];
        $acadYear = $_POST['acadYear'];
        $address = $_POST['address'];
        $cperson = $_POST['cperson'];
        $cphone = $_POST['cphone'];
        $med = $_POST['med'];
        $dent = $_POST['dent'];

        if (empty($cphone)) {
            $cphone = 'none';
        }
		
		mysqli_multi_query($DB_con,"INSERT INTO faculties(facultyNo,first_name,middle_name,last_name,ext,age,sex,dob,stat,dept,sem,acadYear,address,cperson,cphone) VALUES('$facultyNo','$first_name','$middle_name','$last_name','$ext','$age','$sex','$dob','$stat','$dept','$sem','$acadYear','$address','$cperson','$cphone'); INSERT INTO faculty_stats(med,dent,facultyNo) VALUES('$med','$dent','$facultyNo');");
	}
?>