<?php 
  include '../SMS/itext.php';
  require_once '../includes/dbconnect.php';

  $sender = $_POST['sender'];
  $message = $_POST['message'];
  $id = $_POST['id'];
  $receiver = $_POST['recipient'];

  if(!empty($_POST) && $receiver == 'faculty') {
    $res = "SELECT phone FROM `faculties` WHERE `faculties`.`status` = 'active' AND FacultyID = '".$id."'";
    $result = $DB_con->query($res);
    $row = $result->fetch_array(MYSQLI_BOTH);
    $phone = $row['phone'];
    $msg = $sender."\n\n".$message;
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
  elseif(!empty($_POST) && $receiver == 'parent') {
    $res = "SELECT cphone FROM `faculties` WHERE `faculties`.`status` = 'active' AND FacultyID = '".$id."'";
    $result = $DB_con->query($res);
    $row = $result->fetch_array(MYSQLI_BOTH);
    $phone = $row['cphone'];
    $msg = $sender."\n\n".$message;
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
?>