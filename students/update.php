<?php
  include('../includes/dbconnect.php');
  $DB_con = mysqli_connect("localhost", "root", "", "records");

  if(isset($_POST['edit'])) {
    $studentNo = $_POST['studentNo'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $ext = $_POST['ext'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $dept = $_POST['dept'];
    $program = $_POST['program'];
    $sem = $_POST['sem'];
    $acadYear = $_POST['acadYear'];
    $address = $_POST['address'];
    $cperson = $_POST['cperson'];
    $cphone = $_POST['cphone'];
    $StudentID = $_POST['StudentID'];

    $med = $_POST['med'];
    $dent = $_POST['dent'];
		
    mysqli_query($DB_con,'UPDATE `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` SET last_name="'.$last_name.'", first_name="'.$first_name.'", middle_name="'.$middle_name.'", ext="'.$ext.'", age="'.$age.'", sex="'.$sex.'", dept="'.$dept.'", program="'.$program.'", sem="'.$sem.'", acadYear="'.$acadYear.'", address="'.$address.'", cperson="'.$cperson.'", cphone="'.$cphone.'", med="'.$med.'", dent="'.$dent.'" WHERE StudentID="'.$StudentID.'"');	
}
?>