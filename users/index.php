<?php
  ob_start();
  require_once '../includes/dbconnect.php';
  include '../includes/date_time_diff.php';
  if(empty($_SESSION)) // if the session not yet started 
   session_start();
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: /lu_clinic/index.php?attempt");
    exit;
  }

  if ($DB_con->connect_errno) {
    header('Location: /lu_clinic/no_connection_error.php');
  exit();
  }

  // select loggedin users detail
  $res = "SELECT * FROM users WHERE userId=".$_SESSION['user'];
  $result = $DB_con->query($res);
  $userRow = $result->fetch_array(MYSQLI_BOTH);

  if (isset($_GET['loginSuccess'])) {
    $successMSG = "Hello, <strong>".ucwords($userRow['userName'])."!</strong> You have been signed in successfully!";
  }
  if ($userRow['role'] != 'superadmin') {
    header("Location: /lu_clinic/index.php?attempt");
    exit;
  }

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User Accounts | Laguna University - Clinic | Medical Records System</title>
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
.modal-dialog {
  width: 800px;
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
            <a href="/lu_clinic/"><i class="col-1 fa fa-bar-chart" aria-hidden="true"></i>Dashboard</a>
          </li>
          <li>
            <a href="/lu_clinic/calendar/"><i class="col-1 fa fa-calendar" aria-hidden="true"></i>Activities</a>
          </li>
          <li>
            <a href="/lu_clinic/students/"><i class="col-1 fa fa-graduation-cap" aria-hidden="true"></i>Students</a>
          </li>
          <li>
            <a href="/lu_clinic/faculties/"><i class="col-1 fa fa-briefcase" aria-hidden="true"></i>Faculty and Staff</a>
          </li>
          <li role="presentation" class="have-child">
            <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><i class="col-1 fa fa-book" aria-hidden="true"></i>Records <i class="col-1 fa fa-caret-down" aria-hidden="true"></i></a>
            <ul id="demo" class="panel-collapse collapse">
              <li>
              <a class="med" role="submenuitem" data-toggle="collapse"><i class="col-1 fa fa-medkit" aria-hidden="true"></i>Medical <i class="col-1 fa fa-caret-down" aria-hidden="true"></i></a>
              <ul id="med" class="panel-collapse collapse">
                <li>
                  <a href="/lu_clinic/medical/students/"><i class="col-1 fa fa-graduation-cap" aria-hidden="true"></i>Students</a>
                </li>
                <li>
                  <a href="/lu_clinic/medical/faculties/"><i class="col-1 fa fa-briefcase" aria-hidden="true"></i>Faculty and Staff</a>
                </li>
              </ul>
            </li>  
            <li>
              <a class="den" role="submenuitem" data-toggle="collapse"><i class="col-1 fa fa-smile-o" aria-hidden="true"></i>Dental <i class="col-1 fa fa-caret-down" aria-hidden="true"></i></a>
              <ul id="den" class="panel-collapse collapse">
                <li>
                  <a href="/lu_clinic/dental/students/"><i class="col-1 fa fa-graduation-cap" aria-hidden="true"></i>Students</a>
                </li>
                <li>
                  <a href="/lu_clinic/dental/faculties/"><i class="col-1 fa fa-briefcase" aria-hidden="true"></i>Faculty and Staff</a>
                </li>
              </ul>
            </li>
            </ul>
          </li>
          <?php 
            if ($userRow['role'] == 'superadmin') {?>
            <li class="active">
              <a href="/lu_clinic/users"><i class="col-1 fa fa-user-md" aria-hidden="true"></i>User Accounts</a>
            </li>
          <?php    }
          ?>
        </ul>
      </nav>
    </div>  
    <!-- End of Sidebar --> 

    <!-- Begin Main Screen -->
    <div class="container-fluid"> 
      <div id="page-content-wrapper">

        <!-- Page Heading -->
        <div class="row">
          <h2 class="page-header">User Accounts</h2>
        </div> 

        <div class="row">
          <div class="btn-toolbar" role="toolbar">
            <button type="button" id="add_button" data-toggle="modal" data-target="#modal-add" class="btn btn-success"><i class="fa fa-plus"></i> New</button>
          </div>
        </div>

        <div class="row">
          <div id="list-users"></div>
        </div>

      </div>
    </div>
    <!-- End of Main Screen -->
  
  </div>
  <!-- End of Content -->

  <form method="POST" id="add_user">
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal-add">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add New User</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">   
                  <label>Firstname:</label>
                  <input type="text" name="first_name" class="form-control" minlength="3" id="first_name" autofocus required />
                  <br>
                  <label>Lastname:</label>
                  <input type="text" name="last_name" class="form-control" minlength="3" id="last_name" required />
                  <br>
                  <label>Position:</label>
                  <select class="form-control" name="position" id="position" required>
                    <option value="">Select</option>>
                    <option value="School Nurse">School Nurse</option>
                    <option value="School Physician">School Physician</option>
                    <option value="School Dentist">School Dentist</option>
                  </select>       
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Username:</label>
                  <input type="text" name="name" class="form-control" id="username" minlength="5" required /><span id="result"></span>
                  <br>
                  <label>Password:</label>
                  <input type="password" name="pass" class="form-control" minlength="6" id="password" required /> 
                  <br>
                  <label class="checkbox-inline">
                    <input type="checkbox" class="form-check-input" id="chkShow"/><span class="lbl"></span> Show Password 
                  </label>
                  <br> <br> 
                  <span onclick="$('#password').val(password.generate());"><button class="btn btn-primary" type="button">
                    Generate Password <span class="fa fa-key"></span>
                    </button>
                  </span> <br>
                  <i><small class="text-muted">(Note: You can add your desired password or click 'Generate password' to create a random strong password.)</small></i>
                </div>     
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" name="btn-signup" id="register">Add User</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <footer class="footer">
    <div class="container-fluid">
        <p class="text-muted" align="right"><a href="http://lu.edu.ph/" target="_blank">Laguna University</a> &copy; 2017</p>
    </div>
  </footer>
  
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/custom.js" type="text/javascript"></script>
<script src="../assets/js/form_validate_custom.js"></script> 
<script src="../assets/js/password.js"></script>
<!-- Growl -->
<script src="../assets/js/jquery.bootstrap-growl.js"></script>
<script src="../assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="add_user.js"></script>

</body>
</html>