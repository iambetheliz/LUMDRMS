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

  // select loggedin users detail
  $res = "SELECT * FROM users WHERE userId=".$_SESSION['user'];
  $result = $DB_con->query($res);
  $userRow = $result->fetch_array(MYSQLI_BOTH);

  if (isset($_GET['loginSuccess'])) {
    $successMSG = "Hello, <strong>".ucwords($userRow['userName'])."!</strong> You have been signed in successfully!";
  }

	$error = false;

	if ( isset($_POST) && !empty($_POST) ) {
		
		// prevent sql injections/ clear user invalid inputs
		$name = $_POST['name'];	
		$name = $DB_con->escape_string($name);

		$pass = $_POST['pass'];
		$pass = $DB_con->escape_string($pass);
		$password = hash('sha256',$pass); // password hashing using sha256		
		
		$first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
		$position = $_POST['position'];
      
	    $stmt = $DB_con->query("SELECT userName FROM users WHERE userName='$name'");
	    $count = $stmt->num_rows;
	      
	    if ($count > 0) {
	      echo "<span class='text-danger'>User already exists !!! <i class='fa fa-times'></i></span>";
	    }
	    else {
	    	// if there's no error, continue to signup
			$stmt = $DB_con->query("INSERT INTO users (userName, first_name, last_name, userPass, position) VALUES ('$name','$first_name','$last_name','$password','$position')");
			
			echo "ok";
	    }
		
	}
	else {
		echo "Error creating user account";
	}
?>
	
<?php ob_end_flush(); ?>