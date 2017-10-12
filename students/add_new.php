<?php
  ob_start();
  require_once '../dbconnect.php';
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

  $error = false;

  if ( isset($_POST['btn-add']) ) {

  	$last_name = $_POST['last_name'];
  	$first_name = $_POST['first_name'];
  	$middle_name = $_POST['middle_name'];
  	$age = $_POST['age'];
  	$sex = $_POST['sexOption'];
  	$program = $_POST['program'];
  	$yearLevel = $_POST['yearLevel'];
  	$sem = $_POST['semOption'];
  	$acadYear = $_POST['acadYear'];
  	$address = $_POST['address'];
  	$cperson = $_POST['cperson'];
  	$cphone = $_POST['cphone'];
  	$tphone = $_POST['tphone'];

  	if (empty($cphone)) {
  		$cphone = 'none';
  	}

  	if (empty($tphone)) {
  		$tphone = 'none';
  	}

  }

  // if there's no error, continue to signup
  if( !$error ) {
  	$stmt = $DB_con->prepare("INSERT INTO students(last_name,first_name,middle_name,age,sex,program,yearLevel,sem,acadYear,address,cperson,cphone,tphone) VALUES('$last_name','$first_name','$middle_name','$age','$sex','$program','$yearLevel','$sem','$acadYear','$address','$cperson','$cphone','$tphone')");
   	$stmt->bind_param($last_name,$first_name,$middle_name,$age,$sex,$program,$yearLevel,$sem,$acadYear,$address,$cperson,$cphone,$tphone);

   	if (!$stmt) {
      $errMSG = "Something went wrong, try again later..."; 
   	} else {
      $stmt->execute();
      $successMSG = "<span class='glyphicon glyphicon-ok'></span> User created successfully!";
        header("Location: tbl_rec.php");
  	} 
  }

?>
<?php ob_end_flush(); ?>