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

  error_reporting( ~E_NOTICE );

  // select loggedin users detail
  $res = "SELECT * FROM users WHERE userId=".$_SESSION['user'];
  $result = $DB_con->query($res);
  $userRow = $result->fetch_array(MYSQLI_BOTH);

  if (isset($_GET['loginSuccess'])) {
    $successMSG = "Hello, <strong>".ucwords($userRow['userName'])."!</strong> You have been signed in successfully!";
  }

	$error = false;

	if ( !empty($_POST['name']) ) {
		
		// clean user inputs to prevent sql injections
		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
		
		$first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
		$position = $_POST['position'];
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		
		// password encrypt using SHA256();
		$password = hash('sha256', $pass);
		
		// if there's no error, continue to signup
		$stmt = mysqli_query($DB_con,"INSERT INTO users(userName,first_name,last_name,userPass,position) VALUES('$name','$first_name','$last_name','$password','$position')");
				
		if ($stmt) {
			unset($name);
			unset($pass);
			unset($position);
			echo "ok";
		}
		
	}
?>
	
<?php ob_end_flush(); ?>