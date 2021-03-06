<?php
  ob_start();
  require_once '../includes/dbconnect.php';

  if(empty($_SESSION)) // if the session not yet started 
   session_start();
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: index.php?attempt");
    exit;
  }
  
  if($_POST['studentNo']) {
    $studentNo = strip_tags($_POST['studentNo']);
      
    $stmt = $DB_con->query("SELECT studentNo FROM students WHERE studentNo='$studentNo'");
    $count = $stmt->num_rows;
      
    if ($count > 0) {
      echo "<span class='text-danger'>Student No. already exists !!! <i class='fa fa-times'></i></span>";
    }
  }

?>
<?php ob_end_flush(); ?>