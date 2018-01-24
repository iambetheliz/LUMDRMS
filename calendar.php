<?php
  ob_start();
  require_once 'includes/dbconnect.php';
  if(empty($_SESSION)) // if the session not yet started 
   session_start();
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: index.php?attempt");
    exit;
  }

  // select loggedin users detail
  $res = "SELECT * FROM users WHERE userId=".$_SESSION['user'];
  $result = $DB_con->query($res);
  $userRow = $result->fetch_array(MYSQLI_BOTH);

  require_once('calendar/bdd.php');

  $sql = "SELECT id, title, start, end, color FROM events ";

  $req = $bdd->prepare($sql);
  $req->execute();

  $events = $req->fetchAll();

?>

<?php ob_end_flush(); ?>