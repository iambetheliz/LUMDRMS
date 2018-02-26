<?php 
  include '../SMS/itext.php';
  include '../includes/dbconnect.php';

  $query1 = $DB_con->query("SELECT phone FROM students WHERE phone = '0935 830 6457'");
  $query2 = $DB_con->query("SELECT * FROM events");
  if ($query2->num_rows > 0){
    while($row2 = $query2->fetch_assoc()){
      $datetime = date('F j, Y', strtotime($row2['start'])). " at " .date('g:i a', strtotime($row2['start']));
      $msg = "From: LU Clinic \n\nThis is to inform you that there will be a " .$row2['title']. " on " .$datetime. "\n\nThank you.";
    }   
  }

  while($row = mysqli_fetch_array($query1)){
    if (!empty($row['phone'])){

      $result = itexmo($row['phone'],$msg,"ST-SHAIR374833_X9NKY");
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
    }   
  }
?>