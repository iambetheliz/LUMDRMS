<?php
  include '../includes/dbconnect.php';

    if(!empty($_POST['dept'])){
		$studentNo = $_POST['studentNo'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $ext = $_POST['ext'];
        $age = $_POST['age'];
        $sex = $_POST['sex'];
        $dob = $_POST['dob'];
        $civil = $_POST['civil'];
        $dept = $_POST['dept'];
        $program = $_POST['program'];
        $yearLevel = $_POST['yearLevel'];
        $sem = $_POST['sem'];
        $acadYear = $_POST['acadYear'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $cperson = $_POST['cperson'];
        $cphone = $_POST['cphone'];
        $checked_by = $_POST['checked_by'];
		
		mysqli_multi_query($DB_con,"INSERT INTO students(studentNo,first_name,middle_name,last_name,ext,age,sex,dob,civil,dept,program,yearLevel,sem,acadYear,address,phone,cperson,cphone) VALUES('$studentNo','$first_name','$middle_name','$last_name','$ext','$age','$sex','$dob','$civil','$dept','$program','$yearLevel','$sem','$acadYear','$address','$phone','$cperson','$cphone'); INSERT INTO students_stats(checked_by,studentNo) VALUES('$checked_by','$studentNo');");
    }
?>