<?php 
include '../SMS/itext.php';
require_once '../includes/dbconnect.php';

$message = $_POST['message'];

if(isset($_POST["id"])) {
  foreach($_POST["id"] as $id) {
    $res = "SELECT phone FROM `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id` WHERE `faculties`.`status` = 'active' AND FacultyID = '".$id."'";
    $result = $DB_con->query($res);
    $row = $result->fetch_array(MYSQLI_BOTH);
    $phone = $row['phone'];
    $msg = $_POST['sender']."\n\n".$message;
    $result = itexmo($phone,$msg,"ST-SHAIR374833_X9NKY");
    if ($result == ""){
      echo "iTexMo: No response from server!!!";  
    } else if ($result == 0){
      echo "ok";
    }
    else { 
      echo "Something went wrong! <br>Error #". $result . " was encountered!";
    }
  }
}

?>