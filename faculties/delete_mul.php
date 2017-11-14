<?php
  ob_start();
  require_once '../includes/dbconnect.php';
  if(empty($_SESSION)) // if the session not yet started 
   session_start();
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: ../index.php?attempt");
    exit;
  }

  $DB_con = new mysqli("localhost", "root", "", "records");

    if ($DB_con->connect_errno) {
      echo "Connect failed: ", $DB_con->connect_error;
    exit();
    }
 
 $chk = $_POST['chk'];
 $chkcount = count($chk);
 
 if(!isset($chk)) {
    header("Location:index.php?deleteError");
 }
 else {
  for($i=0; $i<$chkcount; $i++) {
    $del = $chk[$i];
    $sql = $DB_con->query("DELETE FROM faculties WHERE FacultyID=".$del);
  } 
  
  if($sql) {
   ?>
   <script>
   alert('<?php echo $chkcount; ?> Records Was Deleted !!!');
   window.location.href='index.php';
   </script>
   <?php
  }
  else {
   header("Location:index.php?deleteError");
  }
  
 }
?>