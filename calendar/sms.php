<?php 
  include '../SMS/itext.php';
  include '../includes/dbconnect.php';

  $phone = $_POST['cphone'];
  $msg = $_POST['title'];
  $result = itexmo($phone,$msg,"TR-ELIZA306457_AUYQD");

  mysqli_query($DB_con,"START TRANSACTION;");
  mysqli_query($DB_con, "SELECT phone FROM students WHERE phone = '$phone'");
  mysqli_query($DB_con,"SELECT * FROM events WHERE title ='$msg';");
  mysqli_query($DB_con,"COMMIT;");

  if ($result == ""){
    echo "<div class='row'><div class='alert alert-danger'>iTexMo: No response from server!!!
    Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
    Please CONTACT US for help.</div></div>";  
  } else if ($result == 0){
    echo "<div class='row'><div class='alert alert-success'>Message Sent!</div></div>";
  }
  else { 
    echo "<div class='row'><div class='alert alert-danger'>
    Trial version. Maximum of 10 messages per day only! <br>Error #". $result . " was encountered!</div></div>";
  }

  header("Location: /lu_clinic/calendar/");

?>