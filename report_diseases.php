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

  if ($DB_con->connect_errno) {
    echo "Connect failed: ", $DB_con->connect_error;
  exit();
  }
  else {
    $data_points = array();

    $whereSQL = '';

    if (isset($_POST['go'])) {
      $whereSQL = ' WHERE date_diag >= "'.$_POST['filter_start'].'" AND date_diag <= "'.$_POST['filter_end'].'" ';
    }

    if(isset($_POST['year'])) { 
      $whereSQL = ' WHERE YEAR(date_diag) = YEAR(NOW()) ';
    }
    if (isset($_POST['month'])) {
      $whereSQL = ' WHERE YEAR(date_diag) = YEAR(NOW()) AND MONTH(date_diag) = MONTH(NOW()) ';
    }
    if (isset($_POST['week'])) {
      $whereSQL = ' WHERE WEEKOFYEAR(date_diag) = WEEKOFYEAR(NOW()) ';
    }
    if (isset($_POST['day'])) {
      $whereSQL = ' WHERE DAY(date_diag) = DAY(NOW()) ';
    } 
    
    $result = $DB_con->query("SELECT `diseases`, `identity`, COUNT(*) as `total` FROM `tbl_diseases` $whereSQL GROUP BY `diseases`, `identity`") or die(mysqli_error());

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