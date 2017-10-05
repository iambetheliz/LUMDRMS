<?php
  ob_start();
  session_start();
  require_once '../dbconnect.php';
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: ../index.php");
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
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Add New Student Record | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="../assets/fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/style.css" rel="stylesheet" type="text/css">
</head>
<body>

  <!-- Navbar -->
    <?php include 'header.php'; ?>
  <!-- End of Navbar -->

  <!-- Content -->
	<div id="wrapper" class="toggled">

        <!-- Sidebar Menu Items -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">                    
                <li>
                    <a href="/lu_clinic"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp; Dashboard</a>
                </li>
                <li class="active">
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp; Tables &nbsp;&nbsp;<span class="caret"></span></a>
                    <ul id="demo" class="collapse in">
                        <li>
                            <a href="/lu_clinic/students/add_new.php"><span class="glyphicon glyphicon-education"></span>&nbsp;&nbsp; Students</a>
                        </li>
                        <li>
                            <a href="/lu_clinic/faculties/add_new.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; Faculties</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>  
        <!-- End of Sidebar -->
	      
        <!-- Start of Main Screen -->
        <div id="page-content-wrapper">
        <div class="container-fluid">
    
    	  <!-- Page Heading -->
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">Add New Student Record</h1>
          </div>
        </div>
        <!-- End of Page Heading -->
        
        <!-- Start of Form -->
        <form>

        <div class="row">
          <div class="col-lg-12">     

                <div class="form-group row">   
                  <div class="col-lg-3">          
                    <label class="col-2 col-form-label" for="inlineFormInput">Surname</label>
                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" placeholder="Dela Cruz">
                  </div>
                  <div class="col-lg-3">
                    <label class="col-2 col-form-label" for="inlineFormInput">First Name</label>
                    <input type="text" class="form-control" id="inlineFormInput" placeholder="Juan">
                  </div>
                  <div class="col-lg-2">
                    <label class="col-2 col-form-label" for="inlineFormInput">Middle Name</label>
                    <input type="text" class="form-control" id="inlineFormInput" placeholder="Magdayao">
                  </div>
                  <div class="col-lg-2">
                    <label class="col-2 col-form-label" for="inlineFormInput">Extended Name</label>
                    <input type="text" class="form-control" id="inlineFormInput" placeholder="Jr.">  
                  </div>        
                  <div class="col-lg-2">
                    <label for="example-number-input" class="col-2 col-form-label">Student No.</label>
                    <input class="form-control" type="text" id="inlineFormInput" placeholder="000-0000">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-3">
                    <label for="example-date-input" class="col-2 col-form-label">Program</label>
                    <input type="text" class="form-control" id="inlineFormInput" placeholder="(e.g. BSIT)">
                  </div>
                  <div class="col-lg-3">
                    <label for="example-date-input" class="col-2 col-form-label">Year</label>
                    <input type="text" class="form-control" id="inlineFormInput" placeholder="(e.g. 1st)">
                  </div>
                  <div class="form-group col-lg-3">
                    <label for="example-date-input" class="col-2 col-form-label">Semester</label>
                    <input type="text" class="form-control" id="inlineFormInput" placeholder="(e.g. 2nd)">
                  </div>
                  <div class="form-group col-lg-3">
                    <label for="example-date-input" class="col-2 col-form-label">Academic Year</label>
                    <input type="text" class="form-control" id="inlineFormInput" placeholder="2017-2018">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-3">
                    <label for="example-date-input" class="col-2 col-form-label">Civil Status</label>
                    <select class="form-control" id="exampleSelect1">
                      <option selected>Choose...</option>
                      <option value="1">Single</option>
                      <option value="2">Married</option>
                      <option value="3">Widow</option>
                    </select>
                  </div>
                  <div class="col-lg-3">
                    <label for="example-date-input" class="col-2 col-form-label">Birthday</label>
                    <input type="date" class="form-control" id="inlineFormInput" placeholder="(e.g. 1st)">
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="example-date-input" class="col-2 col-form-label">Birthplace</label>
                    <input type="text" class="form-control" id="inlineFormInput" placeholder="Sta. Cruz, Laguna">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-3">
                    <label for="example-date-input" class="col-2 col-form-label">Regligion</label>
                    <input type="text" class="form-control" id="inlineFormInput" placeholder="Roman Catholic">
                  </div>
                  <div class="col-lg-3">
                    <label for="example-date-input" class="col-2 col-form-label">Gender</label>
                    <select class="form-control" id="exampleSelect1">
                      <option selected>Choose...</option>
                      <option value="1">Male</option>
                      <option value="2">Female</option>
                    </select>
                  </div>
                  <div class="form-group col-lg-3">
                    <label for="example-date-input" class="col-2 col-form-label">Contact No.</label>
                    <input class="form-control" type="tel" placeholder="09358306457" id="example-tel-input">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label for="example-date-input" class="col-2 col-form-label">Guardian</label>
                    <input type="text" class="form-control" id="inlineFormInput" placeholder="(e.g. BSIT)">
                  </div>
                  <div class="col-lg-6">
                    <label for="example-date-input" class="col-2 col-form-label">Address</label>
                    <input type="text" class="form-control" id="inlineFormInput" placeholder="(e.g. 1st)">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label for="example-date-input" class="col-2 col-form-label">Father</label>
                    <input type="text" class="form-control" id="inlineFormInput" placeholder="Ramon B. Dela Cruz">
                  </div>
                  <div class="col-lg-6">
                    <label for="example-date-input" class="col-2 col-form-label">Occupation</label>
                    <input type="text" class="form-control" id="inlineFormInput" placeholder="Janitor">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label for="example-date-input" class="col-2 col-form-label">Mother</label>
                    <input type="text" class="form-control" id="inlineFormInput" placeholder="Ramona A. Dela Cruz">
                  </div>
                  <div class="col-lg-6">
                    <label for="example-date-input" class="col-2 col-form-label">Occupation</label>
                    <input type="text" class="form-control" id="inlineFormInput" placeholder="Teacher">
                  </div>
                </div>

          </div>
        </div>

        </form>
        <!-- End of Form -->
    
        </div>  
        </div>
        <!-- End of Main Screen -->

  </div>
  <!-- End of Content -->

  <footer class="footer">
    <div class="container">
        <p class="text-muted" align="right"><a href="http://lu.edu.ph/" target="_blank">Laguna University</a> &copy; <?php echo date("Y"); ?></p>
    </div>
  </footer>
    
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>