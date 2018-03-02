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
  
  if($_POST['name']) {
    $userName = strip_tags($_POST['name']);
      
    $stmt = $DB_con->query("SELECT userName FROM users WHERE userName='$userName'");
    $count = $stmt->num_rows;
      
    if ($count > 0) {
      echo "<span class='text-danger'>Username already exists !!! <i class='fa fa-times'></i></span>";
    }
  }

?>
<?php ob_end_flush(); ?>