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
                <a href="/lu_clinic/students/"><span class="fa fa-graduation-cap"></span>&nbsp;&nbsp; Students</a>
              </li>
              <li>
                <a href="/lu_clinic/faculties/"><span class="fa fa-briefcase"></span>&nbsp;&nbsp; Faculty and Staffs</a>
              </li>
              <li>
              <a class="med" role="submenuitem" data-toggle="collapse" href="#med" data-parent="#med"><span class="fa fa-medkit"></span>&nbsp;&nbsp; Medical <span class="caret"></span></a>
              <ul id="med" class="panel-collapse collapse">
                <li>
                  <a href="/lu_clinic/medical/students/"><span class="fa fa-graduation-cap"></span>&nbsp;&nbsp; Students</a>
                </li>
                <li>
                  <a href="/lu_clinic/medical/faculties/"><span class="fa fa-briefcase"></span>&nbsp;&nbsp; Faculty and Staffs</a>
                </li>
              </ul>
            </li>  
            <li>
              <a class="den" role="submenuitem" data-toggle="collapse" href="#den" data-parent="#den"><span class="fa fa-smile-o"></span>&nbsp;&nbsp; Dental <span class="caret"></span></a>
              <ul id="den" class="panel-collapse collapse">
                <li>
                  <a href="/lu_clinic/dental/students/"><span class="fa fa-graduation-cap"></span>&nbsp;&nbsp; Students</a>
                </li>
                <li>
                  <a href="/lu_clinic/dental/faculties/"><span class="fa fa-briefcase"></span>&nbsp;&nbsp; Faculty and Staffs</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="den" role="submenuitem" data-toggle="collapse" href="#soap" data-parent="#soap"><span class="fa fa-file-text-o"></span>&nbsp;&nbsp; S.O.A.P. <span class="caret"></span></a>
              <ul id="soap" class="panel-collapse collapse">
                <li>
                  <a href="/lu_clinic/soap/students/"><span class="fa fa-graduation-cap"></span>&nbsp;&nbsp; Students</a>
                </li>
                <li>
                  <a href="/lu_clinic/soap/faculties/"><span class="fa fa-briefcase"></span>&nbsp;&nbsp; Faculty and Staffs</a>
                </li>
              </ul>
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
                <div class="col-lg-12">
                    <h2 class="page-header">User Accounts</h2>
                </div>
            </div> 

            <div class="row container-fluid">
              <div class="col-lg-4">
                <div id="add-product">
                  <div class="panel panel-success">
                    <div class="panel-heading">
                      <div class="panel-title"><Strong>ADD USER</Strong></div>
                    </div>
                    <div class="panel-body">
                      <form method="POST" id="add_user" autocomplete />
                        <fieldset>                                
                            <?php
                              if ( isset($errMSG) ) { ?>
                                <div class="form-group">
                                  <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
                                    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                                  </div>
                                </div><?php
                              }
                            ?>
                
                            <div class="form-group">
                              <label>Username:</label>
                              <input type="text" name="name" class="form-control"  id="username" minlength="5" autofocus required />
                            </div>

                            <div class="form-group">
                              <label>Firstname:</label>
                              <input type="text" name="first_name" class="form-control" maxlength="50" id="first_name" required />
                            </div>

                            <div class="form-group">
                              <label>Lastname:</label>
                              <input type="text" name="last_name" class="form-control" maxlength="50" id="last_name" required />
                            </div>
                            
                            <div class="form-group">
                              <label>Position:</label>
                              <select class="form-control" name="position" id="position" required>
                                <option>Select</option>>
                                <option value="School Nurse">School Nurse</option>
                                <option value="School Physician">School Physician</option>
                                <option value="School Dentist">School Dentist</option>
                              </select>       
                            </div>
                            
                            <div class="form-group">
                              <label>Password:</label>
                              <input type="password" name="pass" class="form-control"  maxlength="15" id="password" required /> 
                            </div>

                            <div class="form-check">
                              <label class="checkbox-inline">
                                <input type="checkbox" class="form-check-input" id="chkShow"/>Show Password
                              </label>
                            </div>
                            
                            <div class="form-group">
                              <hr />
                            </div>
                            
                            <div class="form-group">
                              <button type="submit" class="btn btn-success" name="btn-signup" id="register">Add User</button>
                              <span class="pull-right" onclick="$('#password').val(password.generate());"><button class="btn btn-primary" type="button">
                                Generate Password <span class="fa fa-key"></span>
                                </button>
                              </span>
                            </div>

                            <i><small class="text-muted">(Note: You can add your desired password or click 'Generate password' to create a random strong password.)</small></i>
                        </fieldset>   
                      </form> 
                    </div>  
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
              <div id="list-users">
                         
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
<script src="../assets/js/custom.js" type="text/javascript"></script>
<script src="../assets/js/password.js"></script>
<!-- Growl -->
<script src="../assets/js/jquery.bootstrap-growl.js"></script>
<script src="../assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="add_user.js"></script>

</body>
</html>