<?php
	ob_start();
  require_once 'includes/dbconnect.php';
  if(empty($_SESSION)) // if the session not yet started 
   session_start();
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: index.php?attempt");
    exit;
  }

  $DB_con = new mysqli("localhost", "root", "", "records");

  if ($DB_con->connect_errno) {
    echo "Connect failed: ", $DB_con->connect_error;
  exit();
  }

  // select loggedin users detail
  $res = "SELECT * FROM users WHERE userId=".$_SESSION['user'];
  $result = $DB_con->query($res);
  $userRow = $result->fetch_array(MYSQLI_BOTH);

  if (isset($_GET['loginSuccess'])) {
    $successMSG = "Hello, <strong>".ucwords($userRow['userName'])."!</strong> You have been signed in successfully!";
  }
    
    //Render facebook profile data
    $output = '';
    if(!empty($userRow)){
        $account = '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;'. ucwords($userRow['userName']).'&nbsp;&nbsp;<b class="caret"></b></a>';
        $logout = '<a href="logout.php?logout"><i class="glyphicon glyphicon-off">'.'</i>&nbsp;&nbsp;Logout</a>';
    }else{
        $output .= '<h3 class="alert alert-danger">Your google account does not exists in our database!<br>Redirecting to login page ...</h3>';
        header("Refresh:3; logout.php?logout");
    }

	$error = false;

	if ( isset($_POST['btn-signup']) ) {
		
		// clean user inputs to prevent sql injections
		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
		
		$position = $_POST['position'];
		
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
		} else {
			// check username exist or not
			$query = "SELECT userName FROM users WHERE userName='$name'";
			$result = $DB_con->query($query);
			if($result->num_rows != 0){
				$error = true;
				$nameError = "Username is already in use.";
			}
		}
		//position
		if (empty($position)) {
			$error = true;
			$positionError = "Please select your position.";
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
			
			$stmt = mysqli_query($DB_con,"INSERT INTO users(userName,userPass,position) VALUES('$name','$password','$position')");
				
			if ($stmt) {
				unset($name);
				unset($pass);
				unset($position);
			}	
				
		}	
		
	}
?>
	
	<div class="panel panel-success">
		<div class="panel-body">
	    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete />
	    	<fieldset>
				<div class=""> 
	            
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
		            	<label>Username:</label>
		            	<input type="text" name="name" class="form-control" maxlength="50" value="<?php echo $name ?>" autofocus />
		                <span class="text-danger"><?php echo $nameError; ?></span>
		            </div>
		            
		            <div class="form-group">
		            	<label>Position:</label>
		            	<select class="form-control" name="position" id="position">
		            		<option value="<?php echo $position ?>">Select</option>
		            		<option value="Nurse">Nurse</option>
		            		<option value="Physician">Physician</option>
		            		<option value="Dentist">Dentist</option>
		            	</select>		                
		            	<span class="text-danger"><?php echo $positionError; ?></span>         
		            </div>
		            
		            <div class="form-group">
		            	<label>Password:</label>
		            	<div class="input-group">
                        <input type="text" name="pass" class="form-control"  maxlength="15" id="password" />  
                        <span class="input-group-btn" onclick="$('#password').val(password.generate());">
                        	<button class="btn btn-default" type="button" data-toggle="tooltip" title="Click to generate password" data-placement="right">
		                        <span class="fa fa-lock"></span>
		                    </button>                          
                        </span>
                      </div>
		                <span class="text-danger"><?php echo $passError; ?></span>
		            </div>
		            
		            <div class="form-group">
		            	<hr />
		            </div>
		            
		            <div class="form-group">
		            	<button type="submit" class="btn btn-success" name="btn-signup">Add User</button>
		            </div>
		        
		        </div>
		    </fieldset>   
	    </form> 
	</div>  </div>
<?php ob_end_flush(); ?>