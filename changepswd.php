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
  if(!empty($userRow)) {
  	$account = '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;'. ucwords($userRow['userName']).'&nbsp;&nbsp;<b class="caret"></b></a>';
	    $logout = '<a href="logout.php?logout"><i class="glyphicon glyphicon-off">'.'</i>&nbsp;&nbsp;Logout</a>';
  } else {
  	$output .= '<h3 class="alert alert-danger">Your google account does not exists in our database!<br>Redirecting to login page ...</h3>';
  	header("Refresh:3; logout.php?logout");
  }

  if (isset($_POST['change'])) {
  $curr_pass = (isset($_POST['current_password']) ? $_POST['current_password'] : null);
  $new_pass = (isset($_POST['new_password']) ? $_POST['new_password'] : null);
  $retype_pass = (isset($_POST['retype_password']) ? $_POST['retype_password'] : null);
	
	if ($curr_pass!="" && $new_pass!="" && $retype_pass!="") {
		$res = "SELECT userPass FROM users WHERE userId=".$_SESSION['user'];
	    $result = $DB_con->query($res);
	    $userRow = $result->fetch_array(MYSQLI_BOTH);
		$old_pwd = $userRow['userPass'];
	 	
	  	$curr_pwd = hash('sha256', $curr_pass);
		
        if ($old_pwd == $curr_pwd) {
			//echo $pssw;
			if ($new_pass == $retype_pass) {
				
				$new_pwd = hash('sha256',$new_pass);
 
				mysqli_query($DB_con, "UPDATE users SET userPass='$new_pwd' WHERE userId=".$_SESSION['user']) or die ('cannot connect to the server');

				header("Location: changepswd.php?success");
			}
			else if ($new_pass != $retype_pass) {
				header("Location: changepswd.php?match");
			}
		}
    	else { 
			header("Location: changepswd.php?fail");
		} 
	}
  }
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Change Password | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="images/favicon.ico">
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="assets/fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="assets/css/dashboard.css" rel="stylesheet" type="text/css">
<link href="assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="assets/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<!-- Navbar -->
<?php include 'header.php'; ?>
<!-- End of Navbar -->

<!-- Content -->
  <div id="wrapper">

    <!-- Sidebar Menu Items -->
    <div id="sidebar-wrapper">
      <nav id="spy">
        <ul class="sidebar-nav" role="menu">                    
          <li class="active">
              <a href="/lu_clinic"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp; Dashboard</a>
          </li>
          <li>
              <a href="/lu_clinic/calendar/"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp; Activities</a>
          </li>
          <li role="presentation" class="have-child">
            <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><i class="fa fa-table" aria-hidden="true"></i>&nbsp;&nbsp; Records &nbsp;&nbsp;<span class="caret"></span></a>
            <ul id="demo" class="panel-collapse collapse">
              <li>
                  <a href="/lu_clinic/students/"><span class="glyphicon glyphicon-education"></span>&nbsp;&nbsp; Students</a>
              </li>
              <li>
                  <a href="/lu_clinic/faculties/"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; Faculties</a>
              </li>
            </ul>
          </li>
          <?php 
            if ($userRow['role'] === 'superadmin') {?>
            <li>
              <a href="tbl_users.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; User Accounts</a>
            </li>
          <?php    }
          ?>
        </ul>
      </nav>
    </div>  
    <!-- End of Sidebar --> 

    <!-- Begin Main Screen -->
    <div id="page-content-wrapper">
      <div class="page-content">
        <div class="container-fluid"> 
			<!-- Page Heading -->
            <div class="row">
                <div class="container-fluid">
                    <h2 class="page-header">Change Password</h2>
                </div>
            </div> 
			<div class="row">
				<div class="container-fluid">					
			 		<?php if(isset($_GET['success'])){ ?>
			    	<div class="alert alert-success">
			    		Successfully changed password!
			    	</div>   
					<?php } else if(isset($_GET['fail'])){?>
			        <div class="alert alert-danger">
			    		Wrong password!
			    	</div>
					<?php } else if(isset($_GET['match'])){ // end else fail?>
			        <div class="alert alert-warning">
			    		Passwords do not match!
			    	</div>
					<?php }  ?>
				</div>
			</div>
			<div class="container-fluid">
				<form name="formchange" method = "POST" action="changepswd.php" data-toggle="validator" role="form" class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-sm-5">Username:
						</label>
						<div class="col-xs-2">
							<input id="userName" type="text" value="<?php echo $userRow['userName'] ; ?>" name="userName" class="form-control" readonly />
						</div>
						<div class="help-block with-errors">
						</div>
					</div>	
					<div class="form-group row">
						<label class="control-label col-sm-5">Enter Current Password:
						</label>
						<div class="col-xs-2">
							<input id="current_password" type="text" name="current_password" class="form-control" data-minlength="5" required/>
						</div>
						<div class="help-block with-errors">
						</div>
					</div>
					<hr>
					<div class="form-group row">
						<label class="control-label col-sm-5">Enter New Password:
						</label>
						<div class="col-xs-2">
							<input id="new_password" type="text" name="new_password" class="form-control" data-minlength="5" required/>
						</div>
						<div class="help-block with-errors">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-sm-5">Re-enter New Password:
						</label>
						<div class="col-xs-2">
							<input id="retype_password" type="text" name="retype_password" class="form-control" data-minlength="5" required/>
						</div>
						<div class="help-block with-errors">
						</div>
					</div>
					<div class="form-group" align="center">
						<a type="cancel" href="mainmenu2.php" class="btn btn-default">CANCEL
						</a>
						<button id="change" name="change" align="middle" type="submit" class="btn btn-primary"> SAVE 
						</button>
					</div> 
				</form>
			</div>	
		</div>
	</div>
</div>
</body>
</html>