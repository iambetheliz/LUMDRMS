<?php
  ob_start();
  session_start();
  require_once 'dbconnect.php';
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: index.php");
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
    
    //Render facebook profile data
    $output = '';
    if(!empty($userRow)){
        $account = '<a href="#"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;'. ucwords($userRow['userName']).'</a>';
        $logout = '<a href="logout.php?logout"><i class="glyphicon glyphicon-off">'.'</i>&nbsp;&nbsp;Logout</a>';
    }else{
        $output .= '<h3 class="alert alert-danger">Your google account does not exists in our database!<br>Redirecting to login page ...</h3>';
        header("Refresh:3; logout.php?logout");
    }

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucwords($userRow['userName']); ?> | Dashboard</title>
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<!-- Navbar -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        
          <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <img style="margin-top: 5px;" class="img-fluid" alt="Brand" src="images/logo.png" width="40" align="left">
            <a class="navbar-brand" style="color: white;" href="/lu_clinic">&nbsp;&nbsp;Laguna University - Clinic | Student Medical Records System</a>
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
  <!-- End of Navbar -->

  <!-- Content -->
	<div id="wrapper" class="toggled">
	<div class="container">

        <!-- Sidebar Menu Items -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">                    
                <li class="active">
                    <a href="/lu_clinic"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp; Dashboard</a>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp; Tables &nbsp;&nbsp;<span class="caret"></span></a>
                    <ul id="demo" class="collapse">
                        <li>
                            <a href="tbl_materials"><span class="glyphicon glyphicon-file"></span>&nbsp;&nbsp; Students</a>
                        </li>
                        <li>
                            <a href="tbl_materials"><span class="glyphicon glyphicon-file"></span>&nbsp;&nbsp; Faculty</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>  
        <!-- End of Sidebar --> 

        <!-- Main Screen -->
        <div id="page-content-wrapper">
            <div class="container">
    
    	          <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Welcome to your dashboard!</h1>
                    </div>
                </div>
                <div class="row">                    
                    <div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button><p>Displaying total numbers of patients who visited per day, week, month and year</p>
                    </div>
                </div>
                <!-- End of Page Heading -->
        
        <div class="row">
          <div class="col-lg-12">
            <h3>Insert badges/charts here ...</h3>
          </div>
        </div>
    
        </div>  
        </div>
        <!-- End of Main Screen -->

  </div></div>
  <!-- End of Content -->

<footer id="footer" style="display: none;">
    <div class="container">
        <p align="right">Laguna University &copy; <?php echo date("Y"); ?></p>
    </div>
</footer>
    
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- Menu Toggle Script -->
    <script>
    $( document ).ready(function() {
        $("#wrapper").addClass("toggled");
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    });
    </script>
<!-- End -->
    
</body>
</html>
<?php ob_end_flush(); ?>