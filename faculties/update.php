<?php
  include('../includes/dbconnect.php');

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
        $dob = $_POST['dob'];
        $civil = $_POST['civil'];
        $dept = $_POST['dept'];
        $sem = $_POST['sem'];
        $acadYear = $_POST['acadYear'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $cperson = $_POST['cperson'];
        $cphone = $_POST['cphone'];
        $FacultyID = $_POST['FacultyID'];
    		
        mysqli_query($DB_con,'UPDATE `faculties` SET facultyNo="'.$facultyNo.'", last_name="'.$last_name.'", first_name="'.$first_name.'", middle_name="'.$middle_name.'", ext="'.$ext.'", age="'.$age.'", sex="'.$sex.'", dob="'.$dob.'", civil="'.$civil.'", dept="'.$dept.'", sem="'.$sem.'", acadYear="'.$acadYear.'", address="'.$address.'", phone="'.$phone.'", cperson="'.$cperson.'", cphone="'.$cphone.'" WHERE FacultyID="'.$FacultyID.'"');	
    }
}
?>