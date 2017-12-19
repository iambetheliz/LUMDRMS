<?php
  include('../includes/dbconnect.php');
  $DB_con = mysqli_connect("localhost", "root", "", "records");

  if(!empty($_POST)) {
    if($_POST["FacultyID"] != '')  
      { 
        $facultyNo = $_POST['facultyNo'];
        $last_name = $_POST['last_name'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $ext = $_POST['ext'];
        $age = $_POST['age'];
        $sex = $_POST['sex'];
        $dept = $_POST['dept'];
        $sem = $_POST['sem'];
        $acadYear = $_POST['acadYear'];
        $address = $_POST['address'];
        $cperson = $_POST['cperson'];
        $cphone = $_POST['cphone'];
        $FacultyID = $_POST['FacultyID'];
    		
        mysqli_query($DB_con,'UPDATE `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` SET last_name="'.$last_name.'", first_name="'.$first_name.'", middle_name="'.$middle_name.'", ext="'.$ext.'", age="'.$age.'", sex="'.$sex.'", dept="'.$dept.'", sem="'.$sem.'", acadYear="'.$acadYear.'", address="'.$address.'", cperson="'.$cperson.'", cphone="'.$cphone.'" WHERE FacultyID="'.$FacultyID.'"');	
    }
}
?>