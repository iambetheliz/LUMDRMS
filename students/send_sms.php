<?php include '../SMS/itext.php';
require_once '../includes/dbconnect.php';

if(isset($_POST["id"])) {
  foreach($_POST["id"] as $id) {
    $res = "SELECT phone FROM students WHERE StudentID = '".$id."'";
    $result = $DB_con->query($res);
    $row = $result->fetch_array(MYSQLI_BOTH);
    $phone = $row['phone'];
    $msg = "Hello World!";
    $result = itexmo($phone,$msg,"TR-SHAIR374833_PHL2Z");
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