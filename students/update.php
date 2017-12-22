<?php
  include('../includes/dbconnect.php');
  $DB_con = mysqli_connect("localhost", "root", "", "records");

  if(!empty($_POST)) {
    if($_POST["StudentID"] != '')  
      { 
        $studentNo = $_POST['studentNo'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $ext = $_POST['ext'];
        $age = $_POST['age'];
        $sex = $_POST['sex'];
        $dept = $_POST['dept'];
        $program = $_POST['program'];
        $yearLevel = $_POST['yearLevel'];
        $sem = $_POST['sem'];
        $acadYear = $_POST['acadYear'];
        $address = $_POST['address'];
        $cperson = $_POST['cperson'];
        $cphone = $_POST['cphone'];
        $StudentID = $_POST['StudentID'];
        $physician = $_POST['physician'];
    		
        mysqli_query($DB_con,'UPDATE `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` SET first_name="'.$first_name.'", middle_name="'.$middle_name.'", last_name="'.$last_name.'",  ext="'.$ext.'", age="'.$age.'", sex="'.$sex.'", dept="'.$dept.'", program="'.$program.'", yearLevel="'.$yearLevel.'", sem="'.$sem.'", acadYear="'.$acadYear.'", address="'.$address.'", cperson="'.$cperson.'", cphone="'.$cphone.'", physician="'.$physician.'" WHERE StudentID="'.$StudentID.'"');	
    }
}
?>