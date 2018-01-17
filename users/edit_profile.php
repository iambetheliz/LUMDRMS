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

	if ($DB_con->connect_errno) {
		header('Location: /lu_clinic/no_connection_error.php');
		exit();
	}

	if (isset($_POST['edit_prof'])) {
		$curr_pass = (isset($_POST['current_password']) ? $_POST['current_password'] : null);
		$userName = (isset($_POST['userName']) ? $_POST['userName'] : null);
		$first_name = (isset($_POST['first_name']) ? $_POST['first_name'] : null);
		$last_name = (isset($_POST['last_name']) ? $_POST['last_name'] : null);
		$position = (isset($_POST['position']) ? $_POST['position'] : null);
  
	    if ($userName!="" && $first_name!="" && $last_name!="" && $position!="") {
			$res = "SELECT * FROM users WHERE userId=".$_SESSION['user'];
			$result = $DB_con->query($res);
			$userRow = $result->fetch_array(MYSQLI_BOTH);
      		$old_pwd = $userRow['userPass'];

      		$curr_pwd = hash('sha256', $curr_pass);

      		if ($old_pwd == $curr_pwd) {
				mysqli_query($DB_con, "UPDATE users SET userName='$userName', first_name='$first_name', last_name='$last_name', position='$position' WHERE userId=".$_SESSION['user']) or die ('cannot connect to the server');

				header("Location: user_profile.php");	
			}	
			else { 
				echo "Your current password is incorrect.";
			}	 
		}
		else { 
			echo "Cannot update profile.";
		}
	}
?>