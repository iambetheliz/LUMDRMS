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

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Change Password | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="../assets/fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../assets/css/dashboard.css" rel="stylesheet" type="text/css">
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/style.css" rel="stylesheet" type="text/css">
<style type="text/css">  
label.error {
  color: indianred;
  font-weight: 500;
}
.form-control.error {
  border-color: indianred;
}
</style>
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
          <li>
            <a href="/LUMDRMS/"><i class="fa fa-bar-chart col-1"></i>Dashboard</a>
          </li>
          <li>
            <a href="/LUMDRMS/calendar/"><i class="fa fa-calendar col-1"></i>Activities</a>
          </li>
          <li>
            <a href="/LUMDRMS/students/"><i class="fa fa-graduation-cap col-1"></i>Students</a>
          </li>
          <li>
            <a href="/LUMDRMS/faculties/"><i class="fa fa-briefcase col-1"></i>Faculty and Staff</a>
          </li>
          <li role="presentation" class="have-child">
            <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><i class="fa fa-book col-1"></i>Records <i class="fa fa-caret-down col-1"></i></a>
            <ul id="demo" class="panel-collapse collapse">
              <li>
              <a class="med" role="submenuitem" data-toggle="collapse"><i class="fa fa-medkit col-1"></i>Medical <i class="fa fa-caret-down col-1"></i></a>
              <ul id="med" class="panel-collapse collapse">
                <li>
                  <a href="/LUMDRMS/medical/students/"><i class="fa fa-graduation-cap col-1"></i>Students</a>
                </li>
                <li>
                  <a href="/LUMDRMS/medical/faculties/"><i class="fa fa-briefcase col-1"></i>Faculty and Staff</a>
                </li>
              </ul>
            </li>  
            <li>
              <a class="den" role="submenuitem" data-toggle="collapse"><i class="fa fa-smile-o col-1"></i>Dental <i class="fa fa-caret-down col-1"></i></a>
              <ul id="den" class="panel-collapse collapse">
                <li>
                  <a href="/LUMDRMS/dental/students/"><i class="fa fa-graduation-cap col-1"></i>Students</a>
                </li>
                <li>
                  <a href="/LUMDRMS/dental/faculties/"><i class="fa fa-briefcase col-1"></i>Faculty and Staff</a>
                </li>
              </ul>
            </li>
            </ul>
          </li>
          <?php 
            if ($userRow['role'] === 'superadmin') {?>
            <li class="active">
              <a href="/LUMDRMS/users"><i class="fa fa-lock col-1"></i>User Accounts</a>
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
              <h2 class="page-header"><i class="fa fa-unlock-alt"></i> Change Password</h2>
            </div>
          </div> 

    			<div class="row">
    				<div class="container-fluid">	

    					<form name="formchange" method = "POST" data-toggle="validator" id="change_pass_form" role="form" class="auth-form" >
    					  
    						<div class="form-group">
    							<label>Username:</label>
    							<input id="username" type="text" value="<?php echo $userRow['userName'] ; ?>" name="username" class="form-control" readonly />
    							<br>
    							<label>Enter Current Password:</label>
    							<input id="current_password" type="text" name="current_password" class="form-control" data-minlength="5" autofocus required/>
    						</div>
    						<hr>
    						<div class="form-group">
    							<label>Enter New Password:
    							</label>
    							<input id="new_password" type="text" name="new_password" class="form-control" data-minlength="5" required/>
    							<br>
    							<label>Confirm New Password:
    							</label>
    							<input id="retype_password" type="text" name="retype_password" class="form-control" data-minlength="5" required />
    						</div>
    						<br>
    						<div class="form-group" align="center">
    							<a type="cancel" href="/LUMDRMS/users/changepswd.php" class="btn btn-default">CANCEL
    							</a>
    							<button id="change" name="change" align="middle" type="submit" class="btn btn-primary"> SAVE 
    							</button>
    						</div> 
    					  </div>
    					</form>

              <div id="msg" class="alert alert-info auth-form" style="display: none;">
                <p>Your password was changed. This means you need to sign in again. Redirecting to login page ...</p>
              </div>

    				</div>
    			</div>

    		</div>  
      </div>
    </div>
    <!-- End of Main Screen -->
  
  </div>
  <!-- End of Content -->

  <footer class="footer">
	  <div class="container-fluid">
	      <p class="text-muted" align="right"><a href="http://lu.edu.ph/" target="_blank">Laguna University</a> &copy; 2017</p>
	  </div>
  </footer>
  
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/custom.js"></script> 
<script src="../assets/js/jquery.bootstrap-growl.js"></script>
<script src="../assets/js/jquery.validate.min.js"></script>
<script src="change_pass.js"></script>

</body>
</html>