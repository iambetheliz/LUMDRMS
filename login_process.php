<?php
	ob_start();
	require_once 'includes/dbconnect.php';
	if(empty($_SESSION)) // if the session not yet started 
	session_start();

	if( isset($_POST) && !empty($_POST) ) {	
		
		// prevent sql injections/ clear user invalid inputs
		$name = $_POST['name'];	
		$name = $DB_con->escape_string($name);

		$pass = $_POST['pass'];
		$pass = $DB_con->escape_string($pass);
		$password = hash('sha256', $pass); // password hashing using sha256
		
		// if there's no error, continue to login	
		$res = "SELECT userId, userName, userPass FROM users WHERE userName='$name'";
		$result = $DB_con->query($res);
		$row = $result->fetch_array(MYSQLI_BOTH);
		$count = $result->num_rows; // if uname/pass correct it returns must be 1 row
		  
  		if( $count == 1 && $row['userName'] == $name && $row['userPass'] == $password ) {
    		$_SESSION['user'] = $row['userId'];
  			echo "ok";
    		if(!empty($_POST["remember"])) {
				setcookie ("user",$_POST["name"],time()+ (10 * 365 * 24 * 60 * 60));
				setcookie ("pass",$_POST["pass"],time()+ (10 * 365 * 24 * 60 * 60));
			} else {
				if(isset($_COOKIE["user"])) {
					setcookie ("user","");
				}
				if(isset($_COOKIE["pass"])) {
					setcookie ("pass","");
				}
			}			
  		} 
  		else {
  			echo "Incorrect login details!";
  		}
				
	}

  ob_end_flush();
	
?>