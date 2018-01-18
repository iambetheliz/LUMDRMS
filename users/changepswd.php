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
              <a href="/lu_clinic"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp; Dashboard</a>
          </li>
          <li>
              <a href="/lu_clinic/calendar/"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp; Activities</a>
          </li>
          <li role="presentation" class="have-child">
            <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp; Records &nbsp;&nbsp;<span class="caret"></span></a>
            <ul id="demo" class="panel-collapse collapse">
              <li>
                  <a href="/lu_clinic/students/"><span class="glyphicon glyphicon-education"></span>&nbsp;&nbsp; Students</a>
              </li>
              <li>
                  <a href="/lu_clinic/faculties/"><span class="fa fa-briefcase"></span>&nbsp;&nbsp; Faculties</a>
              </li>
              <li>
                <a href="/lu_clinic/medical/"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp; Medical</a>
              </li>
              <li>
                <a href="/lu_clinic/dental/"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; Dental</a>
              </li>
            </ul>
          </li>
          <?php 
            if ($userRow['role'] === 'superadmin') {?>
            <li class="active">
              <a href="/lu_clinic/users"><span class="fa fa-lock"></span>&nbsp;&nbsp; User Accounts</a>
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

    					<form name="formchange" method = "POST" data-toggle="validator" id="change_pass_form" role="form" class="auth-form" >
    					  
    						<div class="form-group">
    							<label>Username:</label>
    							<input id="userName" type="text" value="<?php echo $userRow['userName'] ; ?>" name="userName" class="form-control" readonly />
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
    							<a type="cancel" href="javascript:history.go(-1)" class="btn btn-default">CANCEL
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
<script src="../assets/js/validation.min.js"></script>
<script src="change_pass.js"></script>

</body>
</html>