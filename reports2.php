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
    
    $result = $DB_con->query("SELECT `sysRev`, COUNT(*) as `total` FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` GROUP BY `program`");

    $diseases = $row['sysRev'];
    $array  = explode(",", $diseases);

    print_r($array);
    
    $no = 1;
foreach ($array as $line) {
    echo $no . ". " . $line . PHP_EOL;
    $no++;
};

    while($row = mysqli_fetch_array($result)) {
      $point = array("label" => $pieces, "y" => $row['total']);      
      array_push($data_points, $point);        
    }
    
    echo json_encode($data_points, JSON_NUMERIC_CHECK);
  }
  mysqli_close($DB_con);
?>