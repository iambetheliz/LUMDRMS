<?php include '../SMS/itext.php';
require_once '../includes/dbconnect.php';

if(isset($_POST["id"])) {
  foreach($_POST["id"] as $id) {
    $res = "SELECT phone FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE `students`.`status` = 'active' AND CONCAT(med = 'Pending' OR dent = 'Pending') AND StudentID = '".$id."'";
    $result = $DB_con->query($res);
    $row = $result->fetch_array(MYSQLI_BOTH);
    $phone = $row['phone'];
    $msg = "From: LU Clinic \n\nYour Medical and Dental Records are still marked 'Pending'. Please see Nurse Carol to update your records. Thank you.";
    $result = itexmo($phone,$msg,"ST-SHAIR374833_X9NKY");
    if ($result == ""){
      echo "iTexMo: No response from server!!!";  
    } else if ($result == 0){
      echo "ok";
    }
    else { 
      echo "Trial version. Maximum of 10 messages per day only! <br>Error #". $result . " was encountered!";
    }
  }
}

?>