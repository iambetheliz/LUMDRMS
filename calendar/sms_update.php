<?php 
  include '../SMS/itext.php';
  include '../includes/dbconnect.php';

  $query1 = $DB_con->query("SELECT phone FROM students WHERE status = 'active'");
  $query2 = $DB_con->query("SELECT * FROM events");

  if ($query1->num_rows > 0){
    while($row = $query1->fetch_assoc()){
      $phone = $row['phone'];
    }   
  }
  if ($query2->num_rows > 0){
    while($row = $query2->fetch_assoc()){
      $datetime = date('F j, Y; g:i a', strtotime($row['start']));
      $msg = "This is to inform you that " .$row['title']. " was moved on " .$datetime. "\n\n- LU Clinic\n";
    }   
  }
  $result = itexmo($phone,$msg,"TR-SHAIR374833_PHL2Z");

  if ($result == ""){
    echo "<div class='row'><div class='alert alert-danger'>iTexMo: No response from server!!!
    Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
    Please CONTACT US for help.</div></div>";  
  } else if ($result == 0){
    echo "<div class='row'><div class='alert alert-success'>Message Sent!</div></div>";
  }
  else { 
    echo "<div class='row'><div class='alert alert-danger'>Error #". $result . " was encountered! Please try again later</div></div>";
  }

header("Location: /lu_clinic/calendar/");
?>