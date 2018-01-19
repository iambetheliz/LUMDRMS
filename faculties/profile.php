<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Faculty Profile | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
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
            <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><span class="fa fa-book"></span>&nbsp;&nbsp; Records &nbsp;&nbsp;<span class="caret"></span></a>
            <ul id="demo" class="panel-collapse collapse in">
              <li>
                <a href="/lu_clinic/students/"><span class="glyphicon glyphicon-education"></span>&nbsp;&nbsp; Students</a>
              </li>
              <li class="active">
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
            <li>
              <a href="/lu_clinic/users"><span class="fa fa-lock"></span>&nbsp;&nbsp; User Accounts</a>
            </li>
          <?php    }
          ?>
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

            if (isset($_GET['FacultyID']) && is_numeric($_GET['FacultyID']) && $_GET['FacultyID'] > 0) {

              $FacultyID = $_GET['FacultyID'];
              $res = "SELECT * FROM `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id` WHERE FacultyID=".$_GET['FacultyID'];
              $result = $DB_con->query($res);
              $row = $result->fetch_array(MYSQLI_BOTH);
           
              if(!empty($row)){
          ?>
    
  	      <!-- Page Heading -->
          <div class="row">
            <div class="col-lg-12">
              <h1 class="page-header">Faculty's Information
                <span class="pull-right text-success" data-toggle="tooltip" title="Faculty Number" data-placement="left">FN: <?php echo $row['facultyNo'];?></span>
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
              <!-- End of Basic Info -->
            </div>
          </div>

          <!-- Physical Exam -->
          <div class="container-fluid">
            <div class="row">
              <div class="panel panel-success">
                <div class="panel-heading">Previous Checkups</div>
                <div class="panel-body">
                  <!-- Buttons -->
                  <div class="container-fluid">
                    <div class="row">
                      <!-- Start btn-toolbar -->
                      <div class="btn-toolbar">
                        <a href="medical_form.php?FacultyID=<?php echo $row['FacultyID']; ?>" class="btn btn-success">New</a>
                      </div>
                      <!-- End btn-toolbar -->
                    </div>
                  </div>
                  <!-- End of Buttons -->
                  <br>
                  <div class="table-responsive">
                    <?php
                    if ($result->num_rows != 0) { ?>
                    <table class="table  table-striped table-bordered" id="myTable">
                      <thead style="background-color:#eee;cursor: pointer;">
                        <tr>
                          <th style="display: none;"></th>
                          <th>Review of System</th>
                          <th>Past History</th>
                          <th>Drinker</th>
                          <th>Smoker</th>
                          <th>Drug User</th>
                          <th>Weight</th>
                          <th>Height</th>
                          <th>BMI</th>
                          <th>Last Checkup</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        // displaying records.
                        while ($row = $result->fetch_assoc()){ ?>
                        <tr>
                          <td style="display: none;"><input type="checkbox" name="chk[]" class="chk-box" value="<?php echo $row['FacultyID']; ?>"  /></td>
                          <td><?php echo $row['sysRev']; ?></td>
                          <td><?php echo $row['medHis']; ?></td>
                          <td><?php echo $row['drinker']; ?></td>
                          <td><?php echo $row['smoker']; ?></td>
                          <td><?php echo $row['drug_user']; ?></td>
                          <td><?php echo $row['weight']; ?></td>
                          <td><?php echo $row['height']; ?></td>
                          <td><?php echo $row['bmi']; ?></td>
                          <td><?php echo date('F j, Y \a\\t g:i a', strtotime($row['date_updated'])); ?></td>
                        </tr>
                        <?php }
                          } 
                          else {
                            $errMSG = "No records found.";
                          }?>
                      </tbody>
                    </table>
                    <?php 
                      if(isset($errMSG)){ 
                    ?>
                    <div class="alert alert-warning">
                      <span class="glyphicon glyphicon-info"></span> 
                      <?php echo $errMSG; ?>
                    </div>                              
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End -->

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