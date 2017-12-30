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
            <a href="/lu_clinic/calendar/"><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp; Activities</a>
          </li>
          <li class="active have-child" role="presentation">
            <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp; Records &nbsp;&nbsp;<span class="caret"></span></a>
            <ul id="demo" class="panel-collapse collapse in">
              <li>
                <a href="/lu_clinic/students/"><span class="glyphicon glyphicon-education"></span>&nbsp;&nbsp; Students</a>
              </li>
              <li class="active">
                <a href="/lu_clinic/faculties/"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; Faculties</a>
              </li>
            </ul>
          </li>
          <?php 
            if ($userRow['role'] === 'superadmin') {?>
            <li>
              <a href="tbl_users.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; User Accounts</a>
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

            $DB_con = new mysqli("localhost", "root", "", "records");

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
              <h1 class="page-header">Faculty's Information <span class="text-danger pull-right" id="errmsg"></span></h1>             
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
                  <table class="table table-striped table-bordered">
                    <tr>
                      <td><label>Full Name:</label></td>
                      <td colspan="2"><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name']." ".$row['ext'];?></td>
                      <td><label>Age:</label></td>
                      <td>
                        <?php 
                          if (!empty($row['age'])) {
                            echo $row['age']." years old";
                          }
                          else {
                            echo "unknown";
                          }
                        ?>                            
                      </td>
                      <td><label>Gender:</label></td>
                      <td><?php echo $row['sex'];?></td>
                      <td><label>Faculty No.:</label></td>
                      <td><?php echo $row['facultyNo'];?></td>
                    </tr>
                    <tr>
                      <td><label>Department:</label></td>
                      <td colspan="2"><?php echo $row['dept_name'];?></td>
                      <td></td>
                      <td></td>
                      <td><label>Semester: </label></td>
                      <td><?php echo $row['sem'];?> Semester</td>
                      <td><label>Academic Year:</label></td>
                      <td><?php echo $row['acadYear'];?></td>
                    </tr>
                    <tr>
                      <td><label>Address:</label></td>
                      <td colspan="4"><?php echo $row['address'];?></td>
                      <td><label>Contact Person:</label></td>
                      <td><?php echo $row['cperson'];?></td>
                      <td><label>Cel/Tel No.:</label></td>
                      <td><?php echo $row['cphone'];?></td>
                    </tr>
                  </table>
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
                  <?php 
                    require_once '../includes/dbconnect.php';
                    include '../includes/pagination.php';

                    $DB_con = new mysqli("localhost", "root", "", "records");

                    $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
              
                    if ($page <= 0) $page = 1;
                      $per_page = 5; // Set how many records do you want to display per page.
      
                      if (isset($_GET['FacultyID'])) {
                        $FacultyID = $_GET['FacultyID'];

                        $startpoint = ($page * $per_page) - $per_page;
                        $statement = "`faculty_med` WHERE FacultyID = '".$_GET['FacultyID']."'";
                        $result = mysqli_query($DB_con,"SELECT * FROM $statement ORDER BY {$table_data} {$sort} LIMIT {$startpoint} , {$per_page}"); 
                        $count = $result->num_rows;
                      }
                  ?>
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