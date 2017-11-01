<?php
  ob_start();
  require_once '../dbconnect.php';
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
<title>Edit Student Record | Laguna University - Clinic | Medical Records System</title>
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
	<div id="wrapper">

    <!-- Sidebar Menu Items -->
    <div id="sidebar-wrapper">
      <nav id="spy">
        <ul class="sidebar-nav">                    
          <li>
            <a href="/lu_clinic"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp; Dashboard</a>
          </li>
          <li>
            <a href="../activities.php"><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp; Activities</a>
          </li>
          <li class="active have-child" role="presentation">
            <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp; Records &nbsp;&nbsp;<span class="caret"></span></a>
            <ul id="demo" class="panel-collapse collapse in">
              <li class="active">
                <a href="/lu_clinic/students/tbl_rec.php"><span class="glyphicon glyphicon-education"></span>&nbsp;&nbsp; Students</a>
              </li>
              <li>
                <a href="/lu_clinic/faculties/add_new.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; Faculties</a>
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
            require_once '../dbconnect.php';

            $DB_con = new mysqli("localhost", "root", "", "records");

            if (isset($_GET['StudentID']) && is_numeric($_GET['StudentID']) && $_GET['StudentID'] > 0) {

              $StudentID = $_GET['StudentID'];
              $res = "SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` WHERE StudentID=".$_GET['StudentID'];
              $result = $DB_con->query($res);
              $row = $result->fetch_array(MYSQLI_BOTH);
           
              if(!empty($row)){
          ?>

          <!-- Start of Form -->
          <form action="action.php" method="post" autocomplete="">
    
    	      <!-- Page Heading -->
            <div class="row">
              <div class="col-lg-12">
                <h1 class="page-header">Edit Student's Medical Record <span class="text-danger pull-right" id="errmsg"></span></h1>             
              </div>
            </div>
            <!-- End of Page Heading -->

                <div class="row">
                    <div class="col-lg-12">
                        <ul class="breadcrumb">
                          You are here: 
                            <li class="breadcrumb-item"><a href="tbl_rec.php">Students</a></li>
                            <li class="breadcrumb-item active">Edit Form</li>
                        </ul>
                    </div>
                </div>

            <!-- Student Status Form -->
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group row">   
                  <div class="col-lg-2"> 
                    <label>Student No.</label>
                    <input type="text" class="form-control pull-right" value="<?php echo $row['studentNo'];?>" name="studentNo" readonly>
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
            <!-- End of Student Status-->

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
                  <div class="col-lg-2">
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
                      <option value="undefined">Choose...</option>
                      <option value="BS Accountancy">BS Accountancy</option>
                      <option value="BS Computer Science">BS Computer Science</option>
                      <option value="BS Communication Arts">BS Communication Arts</option>
                      <option value="BS Education">BS Education</option>
                      <option value="BS Entrepreneurship">BS Entrepreneurship</option>
                      <option value="BS Information Technology">BS Information Technology</option>
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
                <input type="hidden" name="StudentID" value="<?php echo $row['StudentID']; ?>"/>
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