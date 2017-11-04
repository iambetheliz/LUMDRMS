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
    //Render facebook profile data
    $output = '';
    if(!empty($userRow)){
        $account = '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;'. ucwords($userRow['userName']).'&nbsp;&nbsp;<b class="caret"></b></a>';
        $logout = '<a href="logout.php?logout"><i class="glyphicon glyphicon-off">'.'</i>&nbsp;&nbsp;Logout</a>';
    }else{
        $output .= '<h3 class="alert alert-danger">Your google account does not exists in our database!<br>Redirecting to login page ...</h3>';
        header("Refresh:3; logout.php?logout");
    }

    $errorMSG = '';
    if (isset($_GET['error'])) {
        $errorMSG = "<div class='alert alert-danger'>Invalid!</div>";
        header('Refresh:3; new_student.php');
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
<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
#form input.error {
border:1px solid red;
}
.col-2 {
  padding-right: 20px;
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
            <a href="../activities.php"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp; Activities</a>
          </li>
          <li class="active have-child" role="presentation">
            <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><i class="fa fa-table" aria-hidden="true"></i>&nbsp;&nbsp; Records &nbsp;&nbsp;<span class="caret"></span></a>
            <ul id="demo" class="panel-collapse collapse in">
              <li class="active">
                <a href="/lu_clinic/students/records.php"><span class="glyphicon glyphicon-education"></span>&nbsp;&nbsp; Students</a>
              </li>
              <li>
                <a href="/lu_clinic/faculties/records.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; Faculties</a>
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
    
    	      <!-- Page Heading -->
            <div class="row">
              <div class="container-fluid">             
                <h3 class="page-header">Add New Student
                  <small><span class="text-danger pull-right" id="errmsg"></span></small></h3>
              </div>
            </div>
            <!-- End of Page Heading --> 

            <div class="row">
              <div class="container-fluid">
                <?php echo $errorMSG; ?>
              </div>
            </div>
            
          <!-- Start of Form -->
          <form action="action.php" id="form" name="form" method="post" autocomplete="">

            <!-- Basic Info -->
            <div class="row">
              <div class="container-fluid"> 
                <div class="panel panel-success">
                  <div class="panel-heading">
                    <div class="panel-title">BASIC INFORMATION</div>
                  </div>
                  <div class="panel-body">
                    <div class="col-lg-3">     
                      <div class="form-group row"> 
                        <label for="studentNo">Student No.: </label>
                        <input type="text" class="form-control" placeholder="000-0000" name="studentNo" id="studentNo" autofocus="">
                      </div>
                      <div class="form-group row">
                        <label for="first_name">First Name: </label> 
                        <input type="text" class="form-control" placeholder="Juan" name="first_name" id="first_name">
                      </div>
                      <div class="form-group row">
                        <label for="inlineFormInput">Middle Name: </label> 
                        <input type="text" class="form-control" placeholder="Magdayao" name="middle_name" id="middle_name">
                      </div>
                      <div class="form-group row">
                        <label for="inlineFormInput">Last Name: </label> 
                        <input type="text" class="form-control" placeholder="Dela Cruz" name="last_name" id="last_name">
                      </div>
                      <div class="form-group row">
                        <label>Extension Name: </label> <small class="text-muted pull-right">(leave if none)</small>
                        <input type="text" class="form-control" placeholder="Jr" name="ext" maxlength="3" id="ext">
                      </div>   
                    </div>

                    <div class="col-lg-1"></div>

                    <div class="col-lg-2">
                      <div class="form-group row">
                        <label class="col-2">Age</label> <span class="text-danger pull-right" id="errmsg"></span>
                        <input class="form-control" type="text" placeholder="00" name="age" id="age" maxlength="2">
                      </div>
                      <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">Gender</label>
                          <select class="form-control" name="sexOption">
                            <option value="undefined">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                      </div>
                    </div>

                    <div class="col-lg-1"></div>

                    <div class="col-lg-3">
                      <div class="form-inline row">
                        <label class="col-2">Program</label>
                        <select class="form-control" name="program">
                          <option value="unknown">Select</option>
                          <option value="BSA">BS Accountancy</option>
                          <option value="BSAct">BS Accounting</option>
                          <option value="BAC">AB in Communication</option>
                          <option value="BSCS">BS Computer Science</option>
                          <option value="BEED">BE Education</option>
                          <option value="BSED">BS Education</option>
                          <option value="BSE">BS Entrepreneurship</option>
                          <option value="BSIT">BS Information Technology</option>
                          <option value="BSME">BS Mechanical Engineering</option>
                          <option value="BSTM">BS Tourism Management</option>
                          <option value="HCS">Health Care Services</option>
                          <option value="MID">Midwifery</option>
                          <option value="SHS11">Senior High: Grade 11</option>
                          <option value="SHS12">Senior High: Grade 12</option>
                        </select>
                      </div>         
                    </div>

                    <div class="col-lg-2">
                      <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">Year</label>
                        <select class="form-control" name="yearLevel">
                          <option value="unknown">Select</option>
                          <option value="1st">1st Year</option>
                          <option value="2nd">2nd Year</option>
                          <option value="3rd">3rd Year</option>
                          <option value="4th">4th Year</option>
                        </select>
                      </div>     
                    </div>

                    <div class="col-lg-1"></div>

                    <div class="col-lg-2"> 
                      <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">Semester</label>
                        <select class="form-control" name="semOption">
                          <option value="unknown">Select</option>
                          <option value="1st">1st</option>
                          <option value="2nd">2nd</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-lg-1"></div>

                    <div class="col-lg-2">
                      <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">Academic Year</label>
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

                    <div class="col-lg-1"></div>

                    <div class="col-lg-8">
                      <br><hr>
                    </div>

                    <div class="col-lg-1"></div>

                    <div class="col-lg-8">
                      <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">Address</label>
                        <textarea class="form-control" name="address" id="address"></textarea>
                      </div>
                    </div>

                    <div class="col-lg-1"></div>

                    <div class="col-lg-4">
                      <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">Contact Person in case of Emergency</label>
                        <input type="text" class="form-control" name="cperson" id="cperson">
                      </div>
                    </div>

                    <div class="col-lg-1"></div>

                    <div class="col-lg-3">
                      <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">Cellphone/Telephone No.</label>
                        <input type="text" name="cphone" id="cphone" class="form-control" placeholder="09358306457">
                      </div>
                    </div>
                  </div>
                  <!-- End Panel Body -->
                  <div class="panel-footer">
                    <div class="form-group">
                      <input type="hidden" name="action_type" value="add"/>
                      <input type="submit" class="btn btn-primary" id="add" name="btn-add" value="Add Record" />
                    </div>
                  </div>
                </div>
                <!-- End of Basic Info -->

              </div>
            </div>

          </form>
          <!-- End of Form -->
    
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
<script src="../assets/js/index.js"></script>
<script type="text/javascript">
  $('#add').on('click', function() {
    valid = true;   

    if (valid && $('#studentNo').val() == '') {
      $("#errmsg").html("Please enter your Student Number!").show();
      $("#studentNo").addClass('error');
        valid = false;
    } else {
      $("#errmsg").fadeOut("slow");
      $("#studentNo").removeClass('error');
       valid = true;
    }

    return valid;
});
</script>

</body>
</html>
<?php ob_end_flush(); ?>