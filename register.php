<?php
	ob_start();
	session_start();
	include_once 'header.php';
	include_once 'dbconnect.php';
	
	if( isset($_SESSION['user'])!="" ){
		header("Location: home.php");
	}

	$DB_con = new mysqli("localhost", "root", "", "records");

  	if ($DB_con->connect_errno) {
    	echo "Connect failed: ", $DB_con->connect_error;
  	exit();
  	}

	$error = false;

	if ( isset($_POST['btn-signup']) ) {
		
		// clean user inputs to prevent sql injections
		$name = trim($_POST['name']);
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
		
		// if there's no error, continue to signup
		if( !$error ) {
			
			$stmt = $DB_con->prepare("INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')");
			$stmt->bind_param($name,$email,$password);
				
			if (!$stmt) {
				$errTyp = "danger";
				$errMSG = "Something went wrong, try again later...";
			} else {	
				$stmt->execute();
				$errTyp = "success";
				$errMSG = "Successfully registered, you may login now";
				unset($name);
				unset($email);
				unset($pass);
			}	
				
		}
		
		
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coding Cage - Login & Registration System</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<style type="text/css">  
#login-form {
  max-width:500px;
}

.profile-img {
	width: 96px;
	margin: 0 auto 10px;
	display: block;
	-moz-border-radius:50%;
	-webkit-border-radius:50%;
	border-radius:50%;
}
</style>
<body>

<div id="wrapper">
	<div class="container">

	<div id="login-form">
	<div class="row">
	<div class="col-sm-2 col-md-8 col-md-offset-12">
	<div class="panel panel-success">
		<div class="panel-heading">
			Sign up
		</div>
	<div class="panel-body">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete />
    	<fieldset>
    		<div class="row">
    			<div class="center-block">
    				<img class="profile-img" src="images/logo.png">
    			</div>
			</div><br>
			<div class="col-md-12"> 
            
            <?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            	<input type="text" name="name" class="form-control" placeholder="Enter Username" maxlength="50" value="<?php echo $name ?>" autofocus />
                </div>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
                </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-success" name="btn-signup">Sign Up</button>
            	<a href="index.php">Sign in Here...</a>
            </div>
        
        </div>
    	</fieldset>   
    </form> </div>  

    </div></div></div></div></div>

    </div></div>

</body>
</html>
<?php ob_end_flush(); ?>