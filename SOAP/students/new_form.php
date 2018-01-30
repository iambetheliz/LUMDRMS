<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SOAP Form | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../../images/favicon.ico">
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="../../assets/fonts/css/font-awesome.min.css">
<link href="../../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../../assets/style.css" rel="stylesheet" type="text/css">
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
                <a class="med" role="submenuitem" data-toggle="collapse"><span class="fa fa-medkit"></span>&nbsp;&nbsp; Medical <i class="fa fa-caret-down"></i></a>
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
                <a class="den" role="submenuitem" data-toggle="collapse"><span class="fa fa-smile-o"></span>&nbsp;&nbsp; Dental <i class="fa fa-caret-down"></i></a>
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
                <a class="den" role="submenuitem" data-toggle="collapse"><span class="fa fa-file-text-o"></span>&nbsp;&nbsp; S.O.A.P. <i class="fa fa-caret-down"></i></a>
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
        </ul>
      </nav>
    </div>  
    <!-- End of Sidebar -->

    <!-- Start of Main Screen -->
    <div id="page-content-wrapper">
      <div class="page-content">
        <div class="container-fluid">

          <?php 
            require_once '../../includes/dbconnect.php';

            $DB_con = new mysqli("localhost", "root", "", "records");

            if (isset($_GET['StudentID']) && is_numeric($_GET['StudentID']) && $_GET['StudentID'] > 0) {

              $StudentID = $_GET['StudentID'];
              $res = "SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` WHERE StudentID=".$_GET['StudentID'];
              $result = $DB_con->query($res);
              $row = $result->fetch_array(MYSQLI_BOTH);
           
              if(!empty($row)){
          ?>
    
          <!-- Page Heading -->
          <div class="row">
            <div class="container-fluid">             
              <h1 class="page-header">SOAP Form <span class="text-danger pull-right" id="errmsg"></span></h1>
            </div>
          </div>            
          <!-- End of Page Heading -->  

          <!-- Start of Form -->
          <form action="action.php" method="post" autocomplete="">

            <div class="row">
              <div class="container-fluid">
                <!-- Current System -->
                <div class="panel panel-success">
                  <div class="panel-heading">
                    <div class="panel-title">
                      <strong>CURRENT SYSTEM</strong>
                    </div>
                  </div>
                  <div class="panel-body">
                    <div class="col-lg-3">
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Recurrent Headache"> <span class="lbl"></span> Recurrent Headache
                        </label>                         
                      </div>
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Blurring of Vision"> <span class="lbl"></span> Blurring of Vision
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Abdominal Pain"> <span class="lbl"></span> Abdominal Pain
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Cough and colds"> <span class="lbl"></span> Cough and colds
                        </label>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Chest Pain"> <span class="lbl"></span> Chest pain
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="checkbox-inline" title="Loss Of Consciousness" data-toggle="tooltip" data-placement="right" >
                          <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="LOC/Seizure"> <span class="lbl"></span> LOC/Seizure
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Easy fatigability"> <span class="lbl"></span> Easy fatigability
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Easy bruisability"> <span class="lbl"></span> Easy bruisability
                        </label>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Fever"> <span class="lbl"></span> Fever
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Vomiting"> <span class="lbl"></span> Vomiting
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="checkbox-inline" title="Low Bowel Movement" data-toggle="tooltip" data-placement="right" >
                          <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="LBM"> <span class="lbl"></span> LBM
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Dysuria"> <span class="lbl"></span> Dysuria
                        </label>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" id="otherSysRevCheck" "> <span class="lbl"></span> Other 
                        </label>
                        <input type="text" class="form-control" name="sysRev_list[]" id="otherSysRev" style="display: none;">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Current System -->

                <!-- ASSESSMENT -->
                <div class="row">
                  <div class="col-lg-8">
                    <div class="panel panel-success">
                      <div class="panel-heading">
                        <div class="panel-title">
                          <strong>ASSESSMENT</strong>
                        </div>
                      </div>
                      <div class="panel-body">
                        <div class="form-group">
                          <textarea style="height: 345px;" class="form-control" name="assess" id="assess"></textarea>
                          <br>
                          <label>Medicine Given:</label> 
                          <input type="text" class="form-control" name="med">
                          <br>
                          <label>Plan/Recommendation:</label> 
                          <input type="text" class="form-control" name="plan">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="panel panel-success">
                      <div class="panel-heading">
                        <div class="panel-title">
                          <strong>PHYSICAL EXAMINATION</strong>
                        </div>
                      </div>
                      <div class="panel-body">
                        <div class="form-group row">
                          <div class="col-lg-6">
                            <label>Height: <small><i>(cm)</i></small></label> <span class="error pull-right" id="errHeight"></span>
                            <input type="text" class="form-control value" name="height" id="height" decimaldigits='1' /> 
                          </div>
                          <div class="col-lg-6">
                            <label>Weight: <small><i>(kg)</i></small></label>  
                            <input type="text" class="form-control value" name="weight" id="weight" decimaldigits='2' /> 
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-6">
                            <label>Body Mass Index:</label> 
                            <input type="text" class="form-control" name="bmi" id="bmi" readonly disabled />
                          </div>
                          <div class="col-lg-6">
                            <label>BMI Category:</label> 
                            <input type="text" class="form-control" name="bmi_cat" id="category" readonly disabled />
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-6">
                            <label>Blood Pressure: <small><i>(mmHg)</i></small></label> 
                            <input type="text" class="form-control" name="bp" /> 
                          </div>
                          <div class="col-lg-6">
                            <label>Cardiac Rate: <small><i>(beats per minute)</i></small></label>
                            <input type="text" class="form-control" name="cr">
                          </div> 
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-6">
                            <label>Respiratory Rate: <small><i>(breaths per minute)</i></small></label>
                            <input type="text" class="form-control" name="rr"> 
                          </div>
                          <div class="col-lg-6">
                            <label>Temperature: <small><i>(&#x2103; )</i></small></label>
                            <input type="text" class="form-control" name="temp"> 
                          </div>
                        </div>
                      </div>   
                    </div>
                    <!-- Submit button -->
                    <div class="">
                      <div class="">
                        <div class="panel panel-success">
                          <div class="panel-body">
                            <div class="form-group">
                              <label>School Physician:</label>
                              <select class="form-control">
                                <option></option>
                              </select>
                              <br>
                              <input type="hidden" name="studentNo" value="<?php echo $row['studentNo']; ?>"/>
                              <input type="hidden" name="StudentID" value="<?php echo $row['StudentID']; ?>"/>
                              <input type="hidden" name="action_type" value="save_soap"/>
                              <input type="submit" class="btn btn-primary" id="save_soap" name="btn-save" value="Save Record" />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End-->
                  </div>
                </div>
                <!-- End -->

              </div>
            </div>
          </form>
          <!-- End of Form -->
          <?php }
        }
            else {
              header("Location: /lu_clinic/SOAP/");
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
    
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="../../assets/js/custom.js"></script> 
<script src="../../assets/js/form_validate_custom.js"></script> 
<script src="../../assets/js/jquery.decimalize.js"></script> 
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