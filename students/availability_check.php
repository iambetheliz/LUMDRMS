<?php
  ob_start();
  $host="localhost";
  $user="root";
  $pass="";
  $dbname="records";
  
  $DB_con = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);

  if(empty($_SESSION)) // if the session not yet started 
   session_start();
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: index.php?attempt");
    exit;
  }
  
  if($_POST) {
    $studentNo = strip_tags($_POST['studentNo']);
      
    $stmt = $DB_con->prepare("SELECT studentNo FROM students WHERE studentNo=:studentNo");
    $stmt->execute(array(':studentNo'=>$studentNo));
    $count = $stmt->rowCount();
      
    if ($count > 0) {
      echo "<span class='text-danger'>Student No. already exists !!! <i class='fa fa-times'></i></span>";
    }
  }

?>
<?php ob_end_flush(); ?>