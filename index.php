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
			  
      		if( $count == 1 && $row['userName']==$name && $row['userPass']==$password ) {
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

  	if (isset($_GET['loginError'])) {
    	$errMSG = "Incorrect Username or Password.";
  	}
	
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="images/favicon.ico">
<link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="assets/style.css" type="text/css" />
</head>
<body style="background-color: #dbfcd1;">

<!-- Main Screen -->
<div class="container">

	<!-- Login Form -->
    <div class="row vertical-offset-100">      
      <div class="auth-form well">
      		<table class="table table-borderless">
      			<tr>
      				<td><a href="/lu_clinic"><img class="profile-img" src="images/logo.png" alt=""></a></td>
      				<td><h3 style="padding-bottom: 10px;">Laguna University Clinic</h3></td>
      			</tr>
      		</table>
        <?php
            if (isset($errMSG)) { ?>
              	<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            	<?php echo $errMSG; ?>
              	</div>
         	<?php }
        ?>
        <div class="panel panel-default">
          <div class="panel-body">
            <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete />
    	        <fieldset>          
              <div class="form-group">
                <label>Username</label>
            	  <input type="text" name="name" class="form-control" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" maxlength="40" autofocus />
                <small><span class="text-danger"><?php echo $nameError; ?></span></small>
              </div>
            
              <div class="form-group">
                <label>Password</label>
            	  <input type="password" name="pass" class="form-control" value="<?php if(isset($_COOKIE["pass"])) { echo $_COOKIE["pass"]; } ?>"  maxlength="15" />
                <small><span class="text-danger"><?php echo $passError; ?></span></small>
              </div>
            
              <div class="form-group">
            	  <button type="submit" class="btn btn-success btn-block" name="btn-login">Sign In</button>
              </div>
    	        </fieldset>   
            </form> 
          </div>
        </div>
      </div>
    </div>
  <!-- End of Login Form -->

</div>
<!-- End of Main Screen -->

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/custom.js"></script>

</body>
</html>
<?php ob_end_flush(); ?>