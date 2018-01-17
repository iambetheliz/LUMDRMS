<?php
	ob_start();
	require_once 'includes/dbconnect.php';
	if(empty($_SESSION)) // if the session not yet started 
	session_start();

	if( isset($_POST['btn-login']) ) {	
		
		// prevent sql injections/ clear user invalid inputs
		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		// prevent sql injections / clear user invalid inputs
		
		// if there's no error, continue to login
			
		$password = hash('sha256', $pass); // password hashing using SHA256
	
		$res = "SELECT userId, userName, userPass FROM users WHERE userName='$name'";
		$result = $DB_con->query($res);
		$row = $result->fetch_array(MYSQLI_BOTH);
		$count = $result->num_rows; // if uname/pass correct it returns must be 1 row
		  
  		if( $count == 1 && $row['userName'] == $name && $row['userPass'] == $password ) {
  			echo "ok";
    		$_SESSION['user'] = $row['userId'];
  		} 
  		else {
  			echo "Incorrect login details!";
  		}
				
	}		

  ob_end_flush();
	
?>