<?php
  include '../includes/dbconnect.php';

    if(!empty($_POST['dept'])){
		$facultyNo = $_POST['facultyNo'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $ext = $_POST['ext'];
        $age = $_POST['age'];
        $sex = $_POST['sex'];
        $dob = $_POST['dob'];
        $civil = $_POST['civil'];
        $dept = $_POST['dept'];
        $sem = $_POST['sem'];
        $acadYear = $_POST['acadYear'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $cperson = $_POST['cperson'];
        $cphone = $_POST['cphone'];
        
        $status = $_POST['status'];
        $checked_by = $_POST['checked_by'];
		
		mysqli_multi_query($DB_con,"INSERT INTO faculties(facultyNo,first_name,middle_name,last_name,ext,age,sex,dob,civil,dept,sem,acadYear,address,phone,cperson,cphone) VALUES('$facultyNo','$first_name','$middle_name','$last_name','$ext','$age','$sex','$dob','$civil','$dept','$sem','$acadYear','$address','$phone','$cperson','$cphone'); INSERT INTO faculty_stats(checked_by,facultyNo) VALUES('$checked_by','$facultyNo');");
	}
?>