<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	// it will never let you open index(login) page if session is set
	if ( isset($_SESSION['user'])!="" ) {
		header("Location: dashboard.php");
		exit;
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
			$nameError = "Please enter your username.";
		} else if (strlen($name) < 3) {
			$error = true;
			$nameError = "Username must have atleat 3 characters.";
		} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$error = true;
			$nameError = "Username must contain alphabets and space.";
		}

		// password validation
		if (empty($pass)){
			$error = true;
			$passError = "Please enter your password.";
		} else if(strlen($pass) < 6) {
			$error = true;
			$passError = "Password must have atleast 6 characters.";
		}
		
		// if there's no error, continue to login
		if (!$error) {
			
			$password = hash('sha256', $pass); // password hashing using SHA256
		
			$res = "SELECT userId, userName, userPass FROM users WHERE userName='$name'";
			$result = $DB_con->query($res);
			$row = $result->fetch_array(MYSQLI_BOTH);
			$count = $result->num_rows; // if uname/pass correct it returns must be 1 row

			if($row)   
  {  
   if(!empty($_POST["remember"]))   
   {  
    setcookie ("member_login",$name,time()+ (10 * 365 * 24 * 60 * 60));  
    setcookie ("pass",$password,time()+ (10 * 365 * 24 * 60 * 60));
    $_SESSION['user'] = $row['userId'];
   }  
   else  
   {  
    if(isset($_COOKIE["member_login"]))   
    {  
     setcookie ("member_login","");  
    }  
    if(isset($_COOKIE["password"]))   
    {  
     setcookie ("pass","");  
    }  
   }  
   header("location:dashboard.php"); 
  }  
  else  
  {  
   $message = "Invalid Login";  
  } 
 }
				else
 {
  $message = "Both are Required Fields";
 }	
			if( $count == 1 && $row['userPass']==$password ) {
				$_SESSION['user'] = $row['userId'];
				header("Location: dashboard.php");
			} else {
				$errMSG = "Incorrect username or password.";
			}
				
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
<link rel="stylesheet" href="assets/css/style.css" type="text/css" />
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        
          <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" style="color: white;" href="/lu_clinic">
              <img src="images/logo.png" width="35" style="margin-top: -7px;" class="d-inline-block align-top" align="left" alt="">&nbsp;&nbsp;Laguna University - Clinic | Medical Records System
            </a>
          </div>

          <!-- Top Menu Items -->
            <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <?php
                    if(!empty($userRow)){?>
                        <li><?php echo $account; ?></li>
                        <li><?php echo $logout; ?></li>
                <?php }?>
            </ul> 
            </ul>
            </div> 
          
    </div>
  </nav>

<!-- Main Screen -->
<div id="wrapper">
	<div class="container">

	<!-- Login Form -->
	<div class="row">
	<div class="mainbox col-sm-6 col-md-3 col-md-offset-9 col-sm-offset-6" style="margin-top:60px;padding-right: 20px;">
	<div class="panel panel-success">
		<div class="panel-heading">
			<div class="panel-title">Sign in to continue</div>
		</div>
	<div class="panel-body">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete />
    	<fieldset>
    		<div class="row">
    			<div class="center-block">
    				<img class="profile-img" src="images/logo.png">
    			</div>
			</div>           
            <?php
			if ( isset($errMSG) ) {
				
				?>
            	<div class="alert alert-danger">
					<?php echo $errMSG; ?>
                </div>
                <?php
			}
			?>           
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            	<input type="text" name="name" class="form-control" placeholder="Username" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" maxlength="40" autofocus />
                </div>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Password" value="<?php if(isset($_COOKIE["pass"])) { echo $_COOKIE["pass"]; } ?>"  maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>

            <div class="input-group">
                <div class="checkbox">
                    <label>
                        <input id="login-remember" type="checkbox" name="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> /> Remember me
                    </label>
                </div>
            </div>
            
            <div class="form-group">
            	<button type="submit" class="btn btn-success" name="btn-login">Sign In</button> &nbsp; <a href="register.php"><button type="button" class="btn btn-primary" name="btn-login">Sign Up</button></a>
            </div>
    	</fieldset>   
    </form>  
    </div>
    <div class="panel-footer">
        <a href="#">Forgot Password?</a>
    </div> 
    </div></div></div>
    <!-- End of Login Form -->

    </div>
</div>
<!-- End of Main Screen -->

</body>
</html>
<?php ob_end_flush(); ?>