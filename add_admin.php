<?php
  ob_start();
  include_once 'includes/dbconnect.php';
  if(empty($_SESSION)) // if the session not yet started 
      session_start();
  
  if( isset($_SESSION['user'])!="" ){
    header("Location: dashboard.php");
  }

  $DB_con = new mysqli("localhost", "root", "", "records");

    if ($DB_con->connect_errno) {
      echo "Connect failed: ", $DB_con->connect_error;
    exit();
    }

  $error = false;

  if ( isset($_POST['btn-signup']) ) {
    
    // clean user inputs to prevent sql injections
    $name = trim($_POST['userName']);
    $name = strip_tags($name);
    $name = htmlspecialchars($name);
    
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
    
    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    
    // basic name validation
    if (empty($name)) {
      $error = true;
      $nameError = "Please enter your full name.";
    } else if (strlen($name) < 3) {
      $error = true;
      $nameError = "Name must have atleat 3 characters.";
    } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
      $error = true;
      $nameError = "Name must contain alphabets and space.";
    }
    
    //basic email validation
    if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
      $error = true;
      $emailError = "Please enter valid email address.";
    } else {
      // check email exist or not
      $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
      $result = $DB_con->query($query);
      if($result->num_rows != 0){
        $error = true;
        $emailError = "Provided Email is already in use.";
      }
    }
    // password validation
    if (empty($pass)){
      $error = true;
      $passError = "Please enter password.";
    } else if(strlen($pass) < 6) {
      $error = true;
      $passError = "Password must have atleast 6 characters.";
    }
    
    // password encrypt using SHA256();
    $password = hash('sha256', $pass);
    $role = 'superadmin';
    
    // if there's no error, continue to signup
    if( !$error ) {
      
      $stmt = mysqli_query($DB_con,"INSERT INTO users(userName,userEmail,userPass,role) VALUES('$name','$email','$password','$role')");
        
      if (!$stmt) {
        $errTyp = "danger";
        $errMSG = "Something went wrong, try again later...";
      } else {  
        $errTyp = "success";
        $successMSG = "<div class='alert alert-success'>Admin successfully added, you may login now</div>";
        unset($name);
        unset($email);
        unset($pass);
        header("Refresh:3; /lu_clinic");
      } 
        
    }
    
    
  }
?>
<?php ob_end_flush(); ?>