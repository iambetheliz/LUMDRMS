<?php
  require_once '../includes/dbconnect.php';
  include '../includes/date_time_diff.php';
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Faculty Information | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/css/panel-tabs.css" rel="stylesheet" type="text/css">
<link href="../assets/style.css" rel="stylesheet" type="text/css">
<style type="text/css">  
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
        <ul class="sidebar-nav">                    
          <li>
            <a href="/lu_clinic"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp; Dashboard</a>
          </li>
          <li>
            <a href="/lu_clinic/calendar/"><span class="fa fa-calendar"></span>&nbsp;&nbsp; Activities</a>
          </li>
          <li class="active have-child" role="presentation">
            <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><span class="fa fa-book"></span>&nbsp;&nbsp; Records <i class="fa fa-caret-down"></i></a>
            <ul id="demo" class="panel-collapse collapse in">
              <li>
                <a href="/lu_clinic/students/"><span class="fa fa-graduation-cap"></span>&nbsp;&nbsp; Students</a>
              </li>
              <li class="active">
                <a href="/lu_clinic/faculties/"><span class="fa fa-briefcase"></span>&nbsp;&nbsp; Faculty and Staffs</a>
              </li>
              
              <li>
                <a class="med" role="submenuitem" data-toggle="collapse" href="#med" data-parent="#med"><span class="fa fa-medkit"></span>&nbsp;&nbsp; Medical <i class="fa fa-caret-down"></i></a>
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
                <a class="den" role="submenuitem" data-toggle="collapse" href="#den" data-parent="#den"><span class="fa fa-smile-o"></span>&nbsp;&nbsp; Dental <i class="fa fa-caret-down"></i></a>
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
                <a class="den" role="submenuitem" data-toggle="collapse" href="#soap" data-parent="#soap"><span class="fa fa-file-text-o"></span>&nbsp;&nbsp; S.O.A.P. <i class="fa fa-caret-down"></i></a>
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
            <li>
              <a href="/lu_clinic/users"><span class="fa fa-lock"></span>&nbsp;&nbsp; User Accounts</a>
            </li>
            <?php    }
            ?>
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

            if (isset($_GET['FacultyID']) && is_numeric($_GET['FacultyID']) && $_GET['FacultyID'] > 0) {

              $FacultyID = $_GET['FacultyID'];
              $res = "SELECT * FROM `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id` WHERE FacultyID=".$_GET['FacultyID'];
              $result = $DB_con->query($res);
              $row = $result->fetch_array(MYSQLI_BOTH);
           
              if(!empty($row)) { ?>
    
                <!-- Page Heading -->
                <div class="row">
                  <div class="container-fluid">
                    <h1 class="page-header">Faculty's Information 
                      <span class="pull-right text-success" data-toggle="tooltip" title="Student Number" data-placement="left">FN: <?php echo $row['facultyNo'];?></span>
                    </h1>             
                  </div>
                </div>
                <!-- End of Page Heading -->

                <div class="container-fluid">
                  <div class="row">     
                    <!-- Basic Info -->
                    <div class="panel panel-success panel-table">
                      <div class="panel-heading">
                        <div class="panel-title">
                          <strong>BASIC INFORMATION</strong>
                        </div>
                      </div>
                      <div class="panel-body">  
                        <div class="row">   
                          <div class="container-fluid">               
                            <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td colspan="4"><strong>FULL NAME:</strong></td>
                          </tr>
                          <tr>
                            <td><?php echo $row['first_name'] ;?><br>
                            <span class="text-muted"><small><i>First Name</i></small></span></td>
                            <td><?php echo $row['middle_name'] ;?><br>
                            <span class="text-muted"><small><i>Middle Name</i></small></span></td>
                            <td><?php echo $row['last_name'];?><br>
                              <span class="text-muted"><small><i>Last Name</i></small></span></td>
                            <td><?php echo $row['ext'];?><br>
                              <span class="text-muted"><small><i>Extended Name (e.g. Jr.)</i></small></span></td>
                          </tr>
                          <tr>
                            <td><label>Age:</label></td>
                            <td><?php if (!empty($row['age'])) {
                              echo $row['age']." years old";
                            }?></td>
                            <td><label>Gender:</label></td>
                            <td><?php echo $row['sex'];?></td>
                          </tr>
                          <tr>
                            <td><label>Date of Birth:</label></td>
                            <td><?php if (!empty($row['dob'])) echo date('F j, Y', strtotime($row['dob'])) ;?></td>
                            <td><label>Marital Status:</label></td>
                            <td><?php echo $row['stat'] ;?></td>
                          </tr>
                          <tr>
                            <td><label>Department:</label></td>
                            <td><?php echo $row['dept_name'];?></td>
                            <td><label>Semester: </label> <?php echo $row['sem'];?> Semester</td>
                            <td><label>Academic Year:</label> <?php echo $row['acadYear'];?></td>
                          </tr>
                          <tr>
                            <td><label>Address:</label></td>
                            <td colspan="3"><?php echo $row['address'];?></td>
                          </tr>
                          <tr>
                            <td><label>Contact Person:</label></td>
                            <td><?php echo $row['cperson'];?></td>
                            <td><label>Cel/Tel No.:</label></td>
                            <td><?php echo $row['cphone'];?></td>
                          </tr>
                        </tbody>
                      </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End of Basic Infor --> 
                  </div>
                </div>

                <div class="container-fluid">
                  <div class="row">

                    <div class="panel with-nav-tabs panel-success">
                      <div class="panel-heading">
                        <strong>
                          <ul class="nav nav-tabs panel-title" id="myTab">
                            <li class="active">
                              <a href="#medical" data-toggle="tab">MEDICAL</a>
                            </li>
                            <li>
                              <a href="#dental" data-toggle="tab">DENTAL</a>
                            </li>
                          </ul>
                        </strong>
                      </div>
                      <div class="panel-body">
                        <div class="tab-content">
                          <div class="tab-pane fade in active" id="medical">
                            <?php include 'faculty_med.php';?>
                          </div>
                          <div class="tab-pane fade" id="dental">
                            <?php include 'faculty_den.php';?>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

                <?php 
              }
            }
          ?>
    
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
<script type="text/javascript">
$(document).ready(function(){
  $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
  });
  var activeTab = localStorage.getItem('activeTab');
  if(activeTab){
    $('#myTab a[href="' + activeTab + '"]').tab('show');
  }
});
</script>
    
</body>
</html>
<?php ob_end_flush(); ?>