<?php
  include '../includes/dbconnect.php';
	$DB_con = mysqli_connect("localhost", "root", "", "records");

    if(isset($_POST['add'])){
		$studentNo = $_POST['studentNo'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $ext = $_POST['ext'];
        $age = $_POST['age'];
        $sex = $_POST['sexOption'];
        $dept = $_POST['dept'];
        $program = $_POST['program'];
        $yearLevel = $_POST['yearLevel'];
        $sem = $_POST['semOption'];
        $acadYear = $_POST['acadYear'];
        $address = $_POST['address'];
        $cperson = $_POST['cperson'];
        $cphone = $_POST['cphone'];
        $med = $_POST['med'];
        $dent = $_POST['dent'];

        if (empty($cphone)) {
            $cphone = 'none';
        }
		
		mysqli_multi_query($DB_con,"INSERT INTO students(studentNo,first_name,middle_name,last_name,ext,age,sex,dept,program,yearLevel,sem,acadYear,address,cperson,cphone) VALUES('$studentNo','$first_name','$middle_name','$last_name','$ext','$age','$sex','$dept','$program','$yearLevel','$sem','$acadYear','$address','$cperson','$cphone'); INSERT INTO students_stats(med,dent,studentNo) VALUES('$med','$dent','$studentNo');");
	}
?>