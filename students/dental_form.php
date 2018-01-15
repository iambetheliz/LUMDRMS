<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dental Form | Laguna University - Clinic | Medical Records System</title>
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
        <ul class="sidebar-nav" role="menu">                    
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
          </li>
          <?php 
            if ($userRow['role'] === 'superadmin') {?>
            <li>
              <a href="/lu_clinic/tbl_users.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; User Accounts</a>
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
              $res = "SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` WHERE StudentID=".$_GET['StudentID'];
              $result = $DB_con->query($res);
              $row = $result->fetch_array(MYSQLI_BOTH);
           
              if(!empty($row)){
          ?>
    
          <!-- Page Heading -->
          <div class="row">
            <div class="container-fluid">             
              <h1 class="page-header">Student Dental Form <span class="text-danger pull-right" id="errmsg"></span></h1>
            </div>
          </div>            
          <!-- End of Page Heading -->  

          <!-- Start of Form -->
          <form action="action.php" method="post" autocomplete="">

            <div class="row">
              <div class="container-fluid">

                <!-- Past Medical History -->
                <div class="panel panel-success">
                  <div class="panel-heading">
                    <div class="panel-title">
                      <strong>MEDICAL HISTORY</strong>
                    </div>
                  </div>
                  <div class="panel-body">
                    <div class="col-lg-4">
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Hypertension"> Hypertension
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Diabetes"> Diabetes
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Cardiovascular DSE"> Cardiovascular DSE
                        </label>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Epilepsy"> Epilepsy
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Bleeding Disorder"> Bleeding Disorder
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Asthma"> Asthma
                        </label>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Allergies"> Allergies
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" id="otherMedHisCheck"> Other
                        </label> 
                        <input type="text" class="form-control" name="medHis_list[]" id="otherMedHis" style="display: none;">
                      </div>
                    </div>

                  </div>
                </div>
                <!-- End Past Medical History -->

                <!-- Personal and Social -->
                <div class="row">
                  <div class="col-lg-8">
                    <div class="panel panel-success">
                      <div class="panel-heading">
                        <div class="panel-title">
                          <strong>DENTITION STATUS</strong>
                        </div>
                      </div>
                      <div class="panel-body">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <h4><strong>PERSONAL CONDITION:</strong></h4>
                            <br>
                            <div class="form-group">
                              <label class="radio-inline">
                                <input type="radio" name="per_con" value="Normal" /> Normal
                              </label>
                              <br>
                              <label>Remarks:</label> <input type="text" class="form-control input-sm" name="con_rem1" />
                              <br>
                              <label class="radio-inline"> 
                                <input type="radio" name="per_con" value="Gingivitis" /> Gingivitis
                              </label>
                              <br>
                              <label>Remarks:</label> <input type="text" class="form-control input-sm" name="con_rem2" id="con_rem2">
                              <br>
                              <label class="radio-inline">
                                <input type="radio" name="per_con" value="Periodontal Disease" /> <strong>Periodontal Disease</strong>
                              </label>                  
                              <br>
                              <label>Remarks:</label> 
                              <input type="text" class="form-control input-sm" name="con_rem3" >
                              <br>
                              <label class="radio-inline">
                                <input type="radio" name="per_con" value="Other Abnormal Conditions" /> <strong>Other Abnormal Conditions</strong>
                              </label><br>      
                              <label>Remarks:</label> <input type="text" class="form-control input-sm" name="con_rem4" id="con_rem4"><br>      
                              <label>Please specify:</label> <input type="text" class="form-control input-sm" name="con_spec" id="con_spec">
                            </div>
                          </div>                      
                        </div>

                        <div class="col-lg-6">
                          <div class="form-group">
                            <h4><strong>DENTAL PROSTHESES:</strong></h4>
                            <br>
                            <div class="form-group">
                              <label style="margin-right: 50px;">Denture Wearer:</label>
                              <label class="radio-inline">
                                <input type="radio" name="denture" value="Yes">Yes
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="denture" value="No">No
                              </label>
                              <br>      
                              <label>Remarks:</label> <input type="text" class="form-control input-sm" name="pro_rem1" id="pro_rem1"><br>      
                              <label>Please specify:</label> <input type="text" class="form-control input-sm" name="pro_sec1" id="pro_sec2">
                            </div>   
                            <div class="form-group">
                              <label style="margin-right: 45px;">Need for denture: </label>
                              <label class="radio-inline">
                                <input type="radio" name="need" value="Yes">Yes
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="need" value="No">No
                              </label> <br>      
                              <label>Remarks:</label> <input type="text" class="form-control input-sm" name="pro_rem2" id="pro_rem2"><br>      
                              <label>Please specify:</label> <input type="text" class="form-control input-sm" name="pro_sec2" id="pro_sec2"><br>      
                              <label>Remarks:</label> <input type="text" class="form-control input-sm" name="pro_rem3" id="pro_rem3">
                            </div>  
                          </div>
                        </div>                      
                      </div>

                    </div>
                  </div>
                  <!-- End Condition -->
                  <div class="col-lg-4">
                    <div class="panel panel-success">
                      <div class="panel-heading">
                        <div class="panel-title">
                          <strong>INDEX: DMFT</strong>
                        </div>
                      </div>
                      <div class="panel-body">
                        <div class="form-group">
                          <label>No. of T/Decayed:</label>
                          <br>
                          X - <input type="text" name="dec_x" class="form-control input-sm">
                          <br>
                          F - <input type="text" name="dec_f" class="form-control input-sm">
                          <br>
                          <label>No. of T/Missing:</label>
                          <input type="text" name="missing" class="form-control">
                          <br>
                          <label>No. of T/Filled:</label>
                          <input type="text" name="filled" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End -->

                <div class="form-group">
                  <input type="hidden" name="studentNo" value="<?php echo $row['studentNo']; ?>"/>
                  <input type="hidden" name="StudentID" value="<?php echo $row['StudentID']; ?>"/>
                  <input type="hidden" name="action_type" value="save_dental"/>
                  <input type="submit" class="btn btn-primary" id="save" name="btn-save" value="Save Record" />
                </div>
              <!-- End -->

              </div>
            </div>

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
<script src="../assets/js/custom.js"></script> 
<script type="text/javascript">
  $(function () {
    $("#otherSysRevCheck").click(function () {
      if ($(this).is(":checked")) {
        $("#otherSysRev").show().focus();
      } else {
        $("#otherSysRev").hide();
      }
    });
    $("#otherMedHisCheck").click(function () {
      if ($(this).is(":checked")) {
        $("#otherMedHis").show().focus();
      } else {
        $("#otherMedHis").hide();
      }
    });
  }
});
</script>
    
</body>
</html>
<?php ob_end_flush(); ?>