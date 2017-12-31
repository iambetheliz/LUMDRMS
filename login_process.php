<?php
  ob_start();
  require_once 'includes/dbconnect.php';
  if(empty($_SESSION)) // if the session not yet started 
   session_start();
	
  // it will never let you open index(login) page if session is set
  if ( isset($_SESSION['user'])!="" ) {
	header("Location: dashboard.php");
	exit;
  }

  if (isset($_GET['attempt'])) {
    $errMSG = "You need to login first!";
  }

	$DB_con = new mysqli("localhost", "root", "", "records");

  	if ($DB_con->connect_errno) {
    	echo "Connect failed: ", $DB_con->connect_error;
  	exit();
  	}
	
	$error = false;
	
	if( isset($_POST['btn-login']) ) {	
		
		// prevent sql injections/ clear user invalid inputs
		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		// prevent sql injections / clear user invalid inputs
		
		// basic name validation
		if (empty($name)) {
			$error = true;
      		$nameError = "Username cannot be empty.";
		} else if (strlen($name) < 3) {
			$error = true;
			$nameError = "Username must have atleat 3 characters.";
		} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$error = true;
			$nameError = "Username must contain alphabets and space.";
		}
		
		// if there's no error, continue to login
		if (!$error) {
			
			$password = hash('sha256', $pass); // password hashing using SHA256
		
			$res = "SELECT userId, userName, userPass FROM users WHERE userName='$name'";
			$result = $DB_con->query($res);
			$row = $result->fetch_array(MYSQLI_BOTH);
			$count = $result->num_rows; // if uname/pass correct it returns must be 1 row
			  
      		if( $count == 1 && $row['userName'] == $name && $row['userPass'] == $password ) {
        		$_SESSION['user'] = $row['userId'];
        		header("Location: dashboard.php?loginSuccess");
      		} 
      		else {
      			header("Location: index.php?loginError");
      		}
    	}
		else {
      		header("Location: index.php?loginError");
    	}	
				
	}		

  ob_end_flush();
	
?>