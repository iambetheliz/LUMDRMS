<?php
  include '../includes/date_time_diff.php';
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student Information | Laguna University - Clinic | Medical Records System</title>
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
#settings {
  display: inline-block;
  overflow: hidden;
  white-space: nowrap;
  vertical-align: middle;
  height: 30px;
  width: 0px;
}
#settings.in {
  width: auto;
  margin-right: 10px;
  transition: all 0.4s ease 0s;
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
            <a href="/lu_clinic/calendar/"><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp; Activities</a>
          </li>
          <li class="active have-child" role="presentation">
            <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp; Records &nbsp;&nbsp;<span class="caret"></span></a>
            <ul id="demo" class="panel-collapse collapse in">
              <li class="active">
                <a href="/lu_clinic/students/"><span class="glyphicon glyphicon-education"></span>&nbsp;&nbsp; Students</a>
              </li>
              <li>
                <a href="/lu_clinic/faculties/"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; Faculties</a>
              </li>
            </ul>
            <?php 
              if ($userRow['role'] === 'superadmin') {?>
              <li>
                <a href="/lu_clinic/tbl_users.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; User Accounts</a>
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
            require_once '../includes/dbconnect.php';

            $DB_con = new mysqli("localhost", "root", "", "records");

            if (isset($_GET['StudentID']) && is_numeric($_GET['StudentID']) && $_GET['StudentID'] > 0) {

              $StudentID = $_GET['StudentID'];
              $res = "SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE StudentID=".$_GET['StudentID'];
              $result = $DB_con->query($res);
              $row = $result->fetch_array(MYSQLI_BOTH);
           
              if(!empty($row)){
          ?>
    
    	      <!-- Page Heading -->
            <div class="row">
              <div class="container-fluid">
                <h1 class="page-header">Student's Information 
                  <span class="pull-right text-success" data-toggle="tooltip" title="Student Number" data-placement="left">SN: <?php echo $row['studentNo'];?></span>
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
                              <td><?php echo $row['age'];?> years old</td>
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
                              <td><label>Program:</label></td>
                              <td><?php echo $row['program_name'];?></td>
                              <td><label>Year Level:</label></td>
                              <td><?php echo $row['yearLevel'];?> Year</td>
                            </tr>
                            <tr>
                              <td><label>Semester: </label></td>
                              <td><?php echo $row['sem'];?> Semester</td>
                              <td><label>Academic Year:</label></td>
                              <td><?php echo $row['acadYear'];?></td>
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

            <?php 
              require_once '../includes/dbconnect.php';
              $DB_con = new mysqli("localhost", "root", "", "records");

                if (isset($_GET['StudentID'])) {
                  $StudentID = $_GET['StudentID'];

                  $statement = "`students_med` WHERE StudentID = '".$_GET['StudentID']."'";
                  $result = mysqli_query($DB_con,"SELECT * FROM $statement"); 
                  $count = $result->num_rows;
                }
            ?>

            <div class="container-fluid">
              <div class="row">

                <div class="panel with-nav-tabs panel-success">
                  <div class="panel-heading">
                    <strong>
                      <ul class="nav nav-tabs panel-title">
                        <li class="active">
                          <a href="#tab-contents" data-toggle="tab">MEDICAL</a>
                        </li>
                        <li>
                          <a href="#tab2default" data-toggle="tab">DENTAL</a>
                        </li>
                        <li>
                          <a href="#tab3default" data-toggle="tab">S.O.A.P</a>
                        </li>
                      </ul>
                    </strong>
                  </div>
                  <div class="panel-body">
                    <div class="tab-content">
                      <div class="tab-pane fade in active" id="tab-contents">
                        <?php
                        if ($result->num_rows == 0) {
                          $errMSG = "No records found."; ?>
                          <a href="medical_form.php?StudentID=<?php echo $row['StudentID']; ?>" id="add_med" class="btn btn-success"> <i class="fa fa-plus"></i> ADD RECORD</a><br><br>
                        <?php }
                        else { 
                          $query = mysqli_query($DB_con,"SELECT date_checked_up FROM students_med");
                            while ($row = $query->fetch_assoc()){ 
                              $update = date('F j, Y; h:i a', strtotime($row['date_checked_up']));
                            } ?>
                        <div class="btn-toolbar">  
                          <?php echo $add_btn; ?>
                          <a href="#" id="edit_med" class="btn btn-info">
                            <i class="fa fa-pencil"></i> EDIT RECORD
                          </a>                  
                          
                          <i><span class="pull-right text-muted" id="date_time" style="line-height: 15px;padding: 10px;">Last updated: <?php echo $update;?></span></i>
                        </div>

                        <br>                       
                        
                        <table class="table table-bordered">
                          <thead>
                            <th colspan="2">CURRENT SYSTEM</th>
                            <th colspan="2">PAST MEDICAL HISTORY</th>
                          </thead>
                          <?php 
                          // displaying records.
                          while ($row = $result->fetch_assoc()){ ?>
                          <tbody>
                            <tr>
                              <td colspan="2"><?php echo $row['sysRev'];?></td>
                              <td colspan="2"><?php echo $row['medHis'];?></td>
                            </tr>
                          </tbody>
                          <thead>
                            <th colspan="4">PHYSICAL</th>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                <label>Height:</label> <?php echo $row['height'] ;?> cm.
                              </td>
                              <td>
                                <label>Weight:</label> <?php echo $row['weight'] ;?> kg.
                              </td>
                              <td><label>BMI:</label> <?php echo $row['bmi']. ' - ' .$row['bmi_cat'];?></td>
                              <td><label>Blood Pressure:</label> <?php echo $row['bp'] ;?></td>
                            </tr>
                            <tr>
                              <td><label>Cardiac Rate:</label> <span data-toggle="tooltip" title="Beats per minute" style="cursor: pointer;"><?php echo $row['cr']. ' bpm.' ;?></span></td>
                              <td><label>Respirtory Rate:</label> <span data-toggle="tooltip" title="Breaths per minute" style="cursor: pointer;"><?php echo $row['rr']. " bpm." ;?></span></td>
                              <td colspan="2"><label>Temperature:</label> <?php echo $row['temp']. " &#x2103;" ;?></td>
                            </tr>
                          </tbody>
                          <thead>
                            <tr>
                              <th colspan="4"><label>PERSONAL AND SOCIAL HISTORY</label></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            if ($row['drinker'] == 'Yes') {
                              echo "<tr>
                                      <td colspan='2' id='drinker'>Alcoholic Drinker</td>
                                    </tr>";
                            } else if ($row['smoker'] == 'Yes') {
                              echo "<tr>
                                      <td colspan='2' id='smoker'>Smoker</td>
                                    </tr>";
                            } else if ($row['drug_user'] == 'Yes') {
                              echo "<tr>
                                      <td colspan='2' id='drug_user'>Drug User</td>
                                    </tr>";
                            }
                            else {
                              echo "<tr>
                                      <td colspan='4'>None</td>
                                    </tr>";
                            }
                          ?>
                          </tbody>
                          <thead>
                            <tr>                          
                              <th colspan="4"><label>O.B. GYNE</label></th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                            if (!empty($row['mens'])) {
                              echo "<tr>
                                      <th>Menstrual Period:</th>
                                      <td colspan='3'>" .$row['mens']. "</td>
                                    </tr>";
                              echo "<tr>
                                      <th>Duration:</th>
                                      <td colspan='3'>" .$row['duration']. "</td>
                                    </tr>";
                            }
                            else {
                              echo "<tr>
                                      <td colspan='4'>Not Applicable</td>
                                    </tr>";
                            }
                          ?>                        
                          </tbody>
                        </table>  
                        <br>
                        <?php }
                          } 
                          if(isset($errMSG)){ ?>

                          <div class="alert alert-warning">
                            <span class="glyphicon glyphicon-info"></span> <?php echo $errMSG; ?>
                          </div>
                                
                        <?php }
                        ?>
                      </div>
                      <div class="tab-pane fade" id="tab2default">
                        <div class="btn-toolbar">
                          <a href="dental_form.php?StudentID=<?php echo $row['StudentID']; ?>" class="btn btn-success"> <i class="fa fa-plus"></i> ADD RECORD</a>
                        </div>
                        <br>
                        <div class="alert alert-warning">
                          No records found
                        </div>
                      </div>
                      <div class="tab-pane fade" id="tab3default">
                        <div class="btn-toolbar">
                          <a href="dental_form.php?StudentID=<?php echo $row['StudentID']; ?>" class="btn btn-success"> <i class="fa fa-plus"></i> ADD RECORD</a>
                        </div>
                        <br>
                        <div class="alert alert-warning">
                          No records found
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>

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
<script src="../assets/js/custom.js"></script> 
    
</body>
</html>
<?php ob_end_flush(); ?>