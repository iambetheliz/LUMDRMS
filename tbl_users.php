<?php
  ob_start();
  require_once 'includes/dbconnect.php';
  include 'includes/date_time_diff.php';
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
          <li>
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
              <a href="#"><span class="fa fa-lock"></span>&nbsp;&nbsp; User Accounts</a>
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
                  <div class="alert alert-success"><strong>Add User</strong></div>
                  <?php include 'add_user.php'; ?>
                </div>
              </div>
              <div class="col-lg-8">
              <div id="list-product">
                <div class="alert alert-success">Users Table</div>
                  <table id="userTable" class="table table-bordered" cellpadding="10" cellspacing="1">
                    <thead>
                      <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                      </tr>
                    </thead>
                    <tbody id="ajax-response">
                    <?php
                    $query = $DB_con->query("SELECT * FROM users");
                    while($userRow = $query->fetch_assoc()){ ?>
                      <tr>
                        <td><?php echo $userRow["userId"]; ?></td>
                        <td><?php echo $userRow["userName"]; ?></td>
                        <td><?php echo $userRow["userEmail"]; ?></td>
                        <td><?php echo $userRow["role"]; ?></td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
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
      <p class="text-muted" align="right"><a href="http://lu.edu.ph/" target="_blank">Laguna University</a> &copy; <?php echo date("Y"); ?></p>
  </div>
</footer>
  
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/custom.js" type="text/javascript"></script>
<script src="assets/js/password.js"></script>
<!-- Growl -->
<script src="../assets/js/jquery.bootstrap-growl.js"></script>

</body>
</html>