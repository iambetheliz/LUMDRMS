<?php
  ob_start();
  header('Content-Type: application/json');
  require_once 'includes/dbconnect.php';
  if(empty($_SESSION)) // if the session not yet started 
   session_start();
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: index.php?attempt");
    exit;
  }

  $DB_con = new mysqli("localhost", "root", "", "records");

  if ($DB_con->connect_errno) {
    echo "Connect failed: ", $DB_con->connect_error;
  exit();
  }
  else {
    $data_points = array();
    
    $result = $DB_con->query("SELECT `diseases`, `identity`, COUNT(*) as `total` FROM `tbl_diseases` GROUP BY `diseases`, `identity`") or die(mysqli_error());

    while($row = mysqli_fetch_array($result)) {
      if (!empty($row['diseases'])) {
        $point = array("label" => $row['diseases'], "y" => $row['total']);      
        array_push($data_points, $point);    
      }    
    }
    
    echo json_encode($data_points, JSON_NUMERIC_CHECK);
  }
  mysqli_close($DB_con);
?>