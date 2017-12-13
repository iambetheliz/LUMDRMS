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
    
    $result = mysqli_query($DB_con, "SELECT *, COUNT(*) FROM `students` JOIN `program` ON `students`.`program`=`program`.`program_id` GROUP BY program_name");
    
    while($row = mysqli_fetch_array($result))
    {        
        $point = array("label" => $row['alias'] , "y" => $row['COUNT(*)']);
        
        array_push($data_points, $point);        
    }
    
    echo json_encode($data_points, JSON_NUMERIC_CHECK);
  }
  mysqli_close($DB_con);
?>