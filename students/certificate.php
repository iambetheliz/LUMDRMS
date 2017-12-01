<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SOAP Form | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/style.css" rel="stylesheet" type="text/css">
</head>
<style type="text/css">
  span.error {
  color: red;
}
</style>
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
            <a href="/lu_clinic/calendar/"><span class="fa fa-calendar"></span>&nbsp;&nbsp; Activities</a>
          </li>
          <li class="active have-child" role="presentation">
            <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><span class="fa fa-book"></span>&nbsp;&nbsp; Records &nbsp;&nbsp;<span class="caret"></span></a>
            <ul id="demo" class="panel-collapse collapse in">
              <li class="active">
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
            <li>
              <a href="/lu_clinic/tbl_users.php"><span class="fa fa-lock"></span>&nbsp;&nbsp; User Accounts</a>
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

            if (isset($_GET['StudentID']) && is_numeric($_GET['StudentID']) && $_GET['StudentID'] > 0) {

              $StudentID = $_GET['StudentID'];

              //Student Info
              $res = "SELECT * FROM `students` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE StudentID=".$StudentID;
              $result = $DB_con->query($res);
              $row = $result->fetch_array(MYSQLI_BOTH);
           
              if(!empty($row)) {
                $student = $row['first_name']." ".$row['middle_name']." ".$row['last_name']." ".$row['ext'];
                if ($row['sex'] == 'Female') {
                  $gender = 'She';
                }
                else {
                  $gender = 'He';
                }
              }

              //SOAP Details
              $query = "SELECT * FROM `students_soap` WHERE StudentID=".$StudentID;
              $result = $DB_con->query($query);
              $soap = $result->fetch_array(MYSQLI_BOTH);
              if (!empty($soap)) {
                $update = date('F j, Y; h:i a', strtotime($soap['date_checked']));
                $current_sys = $soap['sysRev'];
                $assess = $soap['assess'];
              }
              else {
                $update = "_______________________________________";
                $current_sys = "_______________________________________";
                $assess = "_______________________________________";
              }
            }
          ?>
    
          <!-- Page Heading -->
          <div class="row">
            <div class="container-fluid">             
              <h1 class="page-header">Medical Certificate <span class="text-danger pull-right" id="errmsg"><?php echo $errorMSG; ?></span></h1>
            </div>
          </div>            
          <!-- End of Page Heading -->  

          <!-- Start of Form -->
          <form action="action.php" method="post" autocomplete="">

            <div class="row">
              <div class="container-fluid">
                <!-- Current System -->
                <div class="panel panel-success">
                  <div class="panel-body">
                    <p><strong>Date:</strong> <?php echo date('M. d, Y') ;?></p>
                    <br><br>
                    <p>To whom it may concern,</p><br>
                    <p>This is to certify that 
                      <strong style="text-decoration: underline;"><?php echo $student; ?></strong> was seen and examined on <?php echo $update ;?> due to <?php echo $current_sys; ?> and was found to have <?php echo $assess; ?>.
                    </p>
                    <p><?php echo $gender; ?> was advised to take medications and rest for: <input type="text" class="form-control input-sm" name="rest" style="width: auto;" /></p><br>
                    <p>Resolution:</p>
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" name="resolution" value="Return to class"> Return to class
                      </label>                         
                    </div>
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" name="resolution" value="Sent home"> Sent home
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" name="resolution" value="To hospital of choice"> To hospital of choice
                      </label>
                    </div><br />
                    <div class="form-group">
                      <label>School Physician:</label>
                      <select class="form-control input-sm">
                        <option></option>
                      </select>
                      <br>
                      <input type="hidden" name="studentNo" value="<?php echo $row['studentNo']; ?>"/>
                      <input type="hidden" name="StudentID" value="<?php echo $row['StudentID']; ?>"/>
                      <input type="hidden" name="action_type" value="save_cert"/>
                      <input type="submit" class="btn btn-primary" id="save_soap" name="btn-save" value="Save Record" />
                    </div>
                  </div>
                </div>
              </div>
              <!-- End-->

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
        <p class="text-muted" align="right"><a href="http://lu.edu.ph/" target="_blank">Laguna University</a> &copy; 2017</p>
    </div>
  </footer>
    
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/custom.js"></script> 
<script src="../assets/js/form_validate_custom.js"></script> 
<script src="../assets/js/jquery.decimalize.js"></script> 
<script type="text/javascript">
$(document).ready(function() {
  $("#category").val('Calculating...');
  $("#bmi").val('0.0');
  //this calculates values automatically 
  bmi(); 
  $("#height, #weight").on("keydown keyup", function() {
    bmi();
    if ($("#bmi").val() <= 18.5) {
      $("#category").val('Underweight');
    }
    else if (($("#bmi").val() >= 18.5) && ($("#bmi").val() <= 24.9)) {
      $("#category").val('Normal weight');
    }
    else if (($("#bmi").val() >= 25) && ($("#bmi").val() <= 29.9)) {
      $("#category").val('Overweight');
    }
    else if ($("#bmi").val() >= 30) {
      $("#category").val('Obese');
    }
  });
});

function bmi() {
  var height = document.getElementById('height').value;
  var weight = document.getElementById('weight').value;
  var result = (parseFloat(weight) / parseFloat(height) / parseFloat(height)) * 10000;

  if (!isNaN(result)) {
    document.getElementById('bmi').value = result.toFixed(2);
  }
}
</script>
    
</body>
</html>
<?php ob_end_flush(); ?>