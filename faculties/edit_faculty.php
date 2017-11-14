<?php
  ob_start();
  require_once '../includes/dbconnect.php';
  if(empty($_SESSION)) // if the session not yet started 
   session_start();
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: ../index.php?attempt");
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
<title>Edit Faculty Record | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/style.css" rel="stylesheet" type="text/css">
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
        <ul class="sidebar-nav">                    
          <li>
            <a href="/lu_clinic"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp; Dashboard</a>
          </li>
          <li>
            <a href="../activities.php"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp; Activities</a>
          </li>
          <li class="active have-child" role="presentation">
            <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><i class="fa fa-table" aria-hidden="true"></i>&nbsp;&nbsp; Records &nbsp;&nbsp;<span class="caret"></span></a>
            <ul id="demo" class="panel-collapse collapse in">
              <li>
                <a href="/lu_clinic/students/"><span class="glyphicon glyphicon-education"></span>&nbsp;&nbsp; Students</a>
              </li>
              <li class="active">
                <a href="/lu_clinic/faculties/"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; Faculties</a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>  
    <!-- End of Sidebar -->
	      
    <!-- Start of Main Screen -->
    <div id="page-content-wrapper">
      <div class="page-content">
        <div class="container-fluid">

          <?php 
            require_once '../includes/dbconnect.php';

            $DB_con = new mysqli("localhost", "root", "", "records");

            if (isset($_GET['FacultyID']) && is_numeric($_GET['FacultyID']) && $_GET['FacultyID'] > 0) {

              $FacultyID = $_GET['FacultyID'];
              $res = "SELECT * FROM `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` WHERE FacultyID=".$_GET['FacultyID'];
              $result = $DB_con->query($res);
              $row = $result->fetch_array(MYSQLI_BOTH);
           
              if(!empty($row)){
          ?>

          <!-- Start of Form -->
          <form action="action.php" method="post" autocomplete="">
    
    	      <!-- Page Heading -->
            <div class="row">
              <div class="col-lg-12">
                <h1 class="page-header">Edit Faculty's Medical Record <span class="text-danger pull-right" id="errmsg"></span></h1>             
              </div>
            </div>
            <!-- End of Page Heading -->

                <div class="row">
                    <div class="col-lg-12">
                        <ul class="breadcrumb">
                          You are here: 
                            <li class="breadcrumb-item"><a href="index.php">Faculty</a></li>
                            <li class="breadcrumb-item active">Edit Form</li>
                        </ul>
                    </div>
                </div>

            <!-- Faculty Status Form -->
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group row">   
                  <div class="col-lg-2"> 
                    <label>Faculty No.</label>
                    <input type="text" class="form-control pull-right" value="<?php echo $row['facultyNo'];?>" name="facultyNo" readonly>
                  </div>
                  <div class="col-lg-6"></div>
                  <div class="col-lg-2"> 
                    <label>Medical Status</label>
                    <select class="form-control" name="med" id="med">
                      <option value="<?php echo $row['med'];?>"><?php echo $row['med'];?></option>
                      <option value="Pending">Pending</option>
                      <option value="Ok">OK</option>
                    </select>
                  </div> 
                  <div class="col-lg-2"> 
                    <label>Dental Status</label>
                      <select class="form-control" name="dent" id="dent">
                        <option value="<?php echo $row['dent'];?>"><?php echo $row['dent'];?></option>
                        <option value="Pending">Pending</option>
                        <option value="Ok">OK</option>
                      </select>
                  </div>
                </div>
              </div>
            </div>
            <!-- End of Faculty Status-->

            <div class="row">
              <div class="col-lg-12">     
                <!-- Basic Info -->
                <div class="panel panel-success">
              <div class="panel-heading">
                BASIC INFORMATION 
              </div>
              <div class="panel-body">
                <div class="form-group row">   
                  <div class="col-lg-3">          
                    <label class="col-2 col-form-label">Surname</label>
                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" value="<?php echo $row['last_name'];?>" name="last_name" autofocus="">                    
                  </div>
                  <div class="col-lg-3">
                    <label class="col-2 col-form-label" for="inlineFormInput">First Name</label>
                    <input type="text" class="form-control" value="<?php echo $row['first_name'];?>" name="first_name">
                  </div>
                  <div class="col-lg-2">
                    <label class="col-2 col-form-label" for="inlineFormInput">Middle Name</label>
                    <input type="text" class="form-control" value="<?php echo $row['middle_name'];?>" name="middle_name">
                  </div>    
                  <div class="col-lg-1">
                    <label class="col-2 col-form-label" for="inlineFormInput">Ext.</label> <span class="text-danger pull-right" id="errmsg"></span>
                    <input type="text" class="form-control" placeholder="Jr" name="ext" maxlength="2" id="ext" value="<?php echo $row['ext'];?>">
                  </div>  
                  <div class="col-lg-1">
                    <label for="example-number-input" class="col-2 col-form-label">Age</label>
                    <input class="form-control" type="text" value="<?php echo $row['age'];?>" name="age">
                  </div>
                  <div class="col-lg-2">
                    <label for="example-date-input" class="col-2 col-form-label">Sex</label>
                    <select class="form-control" name="sexOption">
                      <option value="<?php echo $row['sex'];?>"><?php echo $row['sex'];?></option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label class="col-2 col-form-label">Program</label>
                    <select class="form-control" name="program">
                      <option value="<?php echo $row['program'];?>"><?php echo $row['program'];?></option>
                      <option value="BSA">BS Accountancy</option>
                      <option value="BSAct">BS Accounting</option>
                      <option value="BAC">Bachelor in Arts and Communication</option>
                      <option value="BSCS">BS Computer Science</option>
                      <option value="BEED">Bachelor in Elementary Education</option>
                      <option value="BSED">Bachelor in Secondary Education</option>
                      <option value="BSE">BS Entrepreneurship</option>
                      <option value="BSIT">BS Information Technology</option>
                      <option value="BSME">BS Mechanical Engineering</option>
                      <option value="BSTM">BS Tourism Management</option>
                      <option value="HCS">Health Care Services</option>
                      <option value="MID">Midwifery</option>
                      <option value="SHS11">Senior High School: Grade 11</option>
                      <option value="SHS12">Senior High School: Grade 12</option>
                    </select>
                  </div>
                  <div class="col-lg-2">
                    <label for="example-date-input" class="col-2 col-form-label">Year Level</label>
                    <select class="form-control" name="yearLevel">
                      <option value="<?php echo $row['yearLevel'];?>"><?php echo $row['yearLevel'];?></option>
                      <option value="1st">1st Year</option>
                      <option value="2nd">2nd Year</option>
                      <option value="3rd">3rd Year</option>
                      <option value="4th">4th Year</option>
                    </select>
                  </div>
                  <div class="col-lg-2">
                    <label class="col-2 col-form-label">Semester</label> 
                    <select class="form-control" name="semOption">
                      <option value="<?php echo $row['sem'];?>"><?php echo $row['sem'];?></option>
                      <option value="1st">1st</option>
                      <option value="2nd">2nd</option>
                    </select>
                  </div>
                  <div class="col-lg-2">
                    <label class="col-2 col-form-label">Academic Year:</label>                     
                    <?php
                      $currently_selected = date('Y'); 
                      $earliest_year = 2006; 
                      $latest_year = date('Y');
                    ?>
                    <select class="form-control" name="acadYear" id="acadYear">
                    <?php 
                      foreach ( range( $latest_year, $earliest_year ) as $i ) {
                        print '<option value="'.$i.' - '.++$i.'"'.(--$i === $currently_selected ? 'selected="selected"' : '').'>'.$i.' - '.++$i.'';
                        print '</option>';
                      }
                        print '</select>';
                    ?> 
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-12">
                    <label class="col-2 col-form-label">Address:</label> 
                    <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label class="col-2 col-form-label">Contact Person in case of Emergency:</label>
                    <input type="text" class="form-control" name="cperson" value="<?php echo $row['cperson'];?>"> 
                  </div>
                  <div class="col-lg-3">
                    <label class="col-2 col-form-label">Cellphone No.:</label> 
                    <input type="text" name="cphone" class="form-control" value="<?php echo $row['cphone'];?>">
                  </div>
                  <div class="col-lg-3">
                    <label class="col-2 col-form-label">Telephone No.:</label> 
                    <input type="text" name="tphone" class="form-control" value="<?php echo $row['tphone'];?>">
                  </div>
                </div>
              </div>
            </div>
            <!-- End of Basic Infor -->

              <div class="form-group">
                <input type="hidden" name="FacultyID" value="<?php echo $row['FacultyID']; ?>"/>
                <input type="hidden" name="action_type" value="edit"/>
                <input type="submit" class="btn btn-success" name="submit" value="Update Record"/>
              </div>

          </div>
        </div>
        <!-- End -->

        </form>
        <!-- End of Form -->

        <?php }}?>
    
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
    
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/index.js" type="text/javascript"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>