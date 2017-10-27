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
    //Render facebook profile data
    $output = '';
    if(!empty($userRow)){
        $account = '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;'. ucwords($userRow['userName']).'&nbsp;&nbsp;<b class="caret"></b></a>';
        $logout = '<a href="logout.php?logout"><i class="glyphicon glyphicon-off">'.'</i>&nbsp;&nbsp;Logout</a>';
    }else{
        $output .= '<h3 class="alert alert-danger">Your google account does not exists in our database!<br>Redirecting to login page ...</h3>';
        header("Refresh:3; logout.php?logout");
    }

  if (isset($_GET['error'])) {
        $errorMSG = "<span class='glyphicon glyphicon-warning text-danger'></span> Something went wrong, try again later.";
        header('Refresh:3; medical_form.php');
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
        <ul class="sidebar-nav" role="menu">                    
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

          <!-- Start of Form -->
          <form action="action.php" method="post" autocomplete="">
    
    	      <!-- Page Heading -->
            <div class="row">
              <div class="col-lg-12">             
                <h1 class="page-header">Student's Medical Form <span class="text-danger pull-right" id="errmsg"><?php echo $errorMSG; ?></span></h1>
              </div>
            </div>
            <!-- End of Page Heading -->  

            <!-- Student Status Form -->
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group row">   
                  <div class="col-lg-2"> 
                    <label>Student No.</label>
                    <input type="text" class="form-control" placeholder="000-0000" name="studentNo" id="studentNo" maxlength="8" autofocus="">
                  </div>
                  <div class="col-lg-6"></div>
                  <div class="col-lg-2"> 
                    <label>Medical Status</label>
                    <select class="form-control" name="med" id="med">
                      <option value="Pending">Pending</option>
                      <option value="Ok">OK</option>
                    </select>
                  </div> 
                  <div class="col-lg-2"> 
                    <label>Dental Status</label>
                      <select class="form-control" name="dent" id="dent">
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
                  <div class="panel-heading">BASIC INFORMATION</div>
                  <div class="panel-body">
                    <div class="form-group row">   
                      <div class="col-lg-3">          
                        <label class="col-2 col-form-label" for="inlineFormInput">Surname</label> 
                        <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Dela Cruz" name="last_name" id="last_name">
                      </div>
                      <div class="col-lg-3">
                        <label class="col-2 col-form-label" for="inlineFormInput">First Name</label> <span class="text-danger pull-right" id="errmsg"></span>
                        <input type="text" class="form-control" placeholder="Juan" name="first_name" id="first_name">
                      </div>
                      <div class="col-lg-2">
                        <label class="col-2 col-form-label" for="inlineFormInput">Middle Name</label> <span class="text-danger pull-right" id="errmsg"></span>
                        <input type="text" class="form-control" placeholder="Magdayao" name="middle_name" id="middle_name">
                      </div>     
                      <div class="col-lg-1">
                        <label class="col-2 col-form-label" for="inlineFormInput">Ext.</label> <span class="text-danger pull-right" id="errmsg"></span>
                        <input type="text" class="form-control" placeholder="Jr" name="ext" maxlength="2" id="ext">
                      </div>   
                      <div class="col-lg-1">
                        <label for="example-number-input" class="col-2 col-form-label">Age</label> <span class="text-danger pull-right" id="errormsg"></span>
                        <input class="form-control" type="text" placeholder="00" name="age" id="age" maxlength="2">
                      </div>
                      <div class="col-lg-2">
                        <label for="example-date-input" class="col-2 col-form-label">Sex</label>
                          <select class="form-control" name="sexOption">
                            <option value="undefined">Choose...</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-lg-5">
                        <label for="example-date-input" class="col-2 col-form-label">Program</label>
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
                          <option value="undefined">Choose...</option>
                          <option value="1st">1st Year</option>
                          <option value="2nd">2nd Year</option>
                          <option value="3rd">3rd Year</option>
                          <option value="4th">4th Year</option>
                        </select>
                      </div>
                      <div class="form-group col-lg-2">
                        <label for="example-date-input" class="col-2 col-form-label">Semester</label>
                        <select class="form-control" name="semOption">
                          <option value="undefined">Choose...</option>
                          <option value="1st">1st</option>
                          <option value="2nd">2nd</option>
                        </select>
                      </div>
                      <div class="form-group col-lg-3">
                        <label for="example-date-input" class="col-2 col-form-label">Academic Year</label>
                        <div class="form-inline"> 
                          <?php
                            $currently_selected = date('Y'); 
                            $earliest_year = 2006; 
                            $latest_year = date('Y');
                            $next_year = $latest_year + 1;
                            $nextLate_year = $earliest_year + 1; 
                          ?>
                          <select class="form-control" name="acadYears[]" id="current_year">
                            <?php 
                              foreach ( range( $latest_year, $earliest_year ) as $i ) {
                                print '<option value="'.$i.'"'.($i === $currently_selected ? 'selected="selected"' : '').'>'.$i.'</option>';
                              }
                              print '</select>';
                            ?> 
                          <label>To</label>
                          <select class="form-control" name="acadYears[]" id="next_year">
                            <?php 
                              foreach ( range( $next_year, $nextLate_year ) as $i ) {
                                print '<option value="'.$i.'"'.($i === $next_year ? 'selected="selected"' : '').'>'.$i.'</option>';
                              }
                              print '</select>';
                            ?>
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-lg-12">
                        <label for="example-date-input" class="col-2 col-form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="address">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-lg-6">
                        <label for="example-date-input" class="col-2 col-form-label">Contact Person in case of Emergency</label>
                        <input type="text" class="form-control" name="cperson" id="cperson">
                      </div>
                      <div class="form-group col-lg-3">
                        <label for="example-date-input" class="col-2 col-form-label">Cellphone No.</label>
                        <input type="text" name="cphone" id="cphone" class="form-control" placeholder="09358306457">
                      </div>
                      <div class="form-group col-lg-3">
                        <label for="example-date-input" class="col-2 col-form-label">Telephone No.</label>
                        <input type="text" name="tphone" id="tphone" class="form-control" placeholder="536-1234">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End of Basic Infor -->

                <!-- Review of System -->
                <div class="panel panel-success">
                  <div class="panel-heading">REVIEW OF SYSTEM</div>
                  <div class="panel-body">
                    <div class="col-lg-4">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Recurrent Headache"> Recurrent Headache
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Blurring of Vision"> Blurring of Vision
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Abdominal Pain"> Abdominal Pain
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Cough and colds"> Cough and colds
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="otherSysRevCheck"> Other <input type="text" class="form-control" name="sysRev_list[]" id="otherSysRev" disabled="">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Chest Pain"> Chest pain
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="LOC/Seizure"> LOC/Seizure
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Easy fatigability"> Easy fatigability
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Easy bruisability"> Easy bruisability
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Fever"> Fever
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Vomiting"> Vomiting
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="LBM"> LBM
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Dysuria"> Dysuria
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Review of System -->

                <!-- Past Medical History -->
                <div class="panel panel-success">
                  <div class="panel-heading">PAST MEDICAL HISTORY</div>
                  <div class="panel-body">
                    <div class="col-lg-4">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Bronchial Asthma"> Bronchial Asthma
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="medHis_list[]" value="PTB"> PTB
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Allergy"> Allergy
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="otherMedHisCheck"> Other <input type="text" class="form-control" name="medHis_list" id="otherMedHis" disabled="">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Hypertension"> Hypertension
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="medHis_list[]" value="UTI"> UTI
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Surgery"> Surgery
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Cardiovascular DSE"> Cardiovascular DSE
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Bleeding Disorder"> Bleeding Disorder
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Skin Disorder"> Skin Disorder
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Past Medical History -->
              </div>
            </div>

            <div class="row">
              <div class="col-lg-6">
                <!-- Personal and Social -->
                <div class="panel panel-success">
                  <div class="panel-heading">PERSONAL AND SOCIAL HISTORY</div>
                  <div class="panel-body">
                    <div class="form-check">
                      <table width="100%">
                        <tr>
                          <td><label class="form-check-label">Alcoholic Drinker: </label></td>
                          <td><input type="checkbox" class="form-check-input" name="drinker" value="Yes"> Yes</td>
                          <td><input type="checkbox" class="form-check-input" name="drinker" value="No"> No</td>
                        </tr>     
                        <tr>
                          <td><label class="form-check-label">Smoker: </label></td>
                          <td><input type="checkbox" class="form-check-input" name="smoker" value="Yes"> Yes</td>
                          <td><input type="checkbox" class="form-check-input" name="smoker" value="No"> No</td>
                        </tr>
                        <tr>
                          <td><label class="form-check-label">Use of Illicit Drugs: </label></td>
                          <td><input type="checkbox" class="form-check-input" name="drug_user" value="Yes"> Yes</td>
                          <td><input type="checkbox" class="form-check-input" name="drug_user" value="No"> No</td>
                        </tr>
                      </table>
                      <br>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="panel panel-success">
                  <div class="panel-heading">OB/GYNE HISTORY</div>
                  <div class="panel-body">
                    <div class="form-check">
                      <table width="100%">
                        <tr>
                          <td><input class="form-check-input" type="checkbox"> Regular</td>
                          <td><input type="checkbox" class="form-check-input" name=""> Irregular</td>
                        </tr>
                        <tr>
                          <td><div class="form-inline">Duration: <input type="text" class="form-control" name=""></div></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td><input class="form-check-input" type="checkbox"> Dsymenorrhea</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>G <input class="form-check-input" type="checkbox"> P <input class="form-check-input" type="checkbox"></td>
                        </tr>
                      </table>  
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End -->

            <div class="row">
              <div class="col-lg-12">
                <!-- Physical Exam -->
                <div class="panel panel-success">
                  <div class="panel-heading">PHYSICAL EXAMINATION</div>
                  <div class="panel-body">
                    <div class="form-group row">
                      <div class="col-lg-3">
                        <label>Weight:</label>  
                        <input type="text" class="form-control" name="weight"> 
                      </div>
                      <div class="col-lg-3">
                        <label>Height:</label> 
                        <input type="text" class="form-control" name="height"> 
                      </div>
                      <div class="col-lg-3">
                        <label>BMI:</label> 
                        <input type="text" class="form-control" name="bmi"> 
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-3">
                        <label>BP:</label> 
                        <input type="text" class="form-control" name="bp"> 
                      </div>
                      <div class="col-lg-3">
                        <label>CR:</label>
                        <input type="text" class="form-control" name="cr"> 
                      </div>
                      <div class="col-lg-3">
                        <label>RR:</label>
                        <input type="text" class="form-control" name="rr"> 
                      </div>
                      <div class="col-lg-3">
                        <label>T:</label>
                        <input type="text" class="form-control" name="t"> 
                      </div>
                    </div>    
                    <br>     

                    <table class="table table-bordered table-responsive">
                      <thead>
                        <tr>
                          <td></td>
                          <td>Normal</td>
                          <td>Abnormal</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>General Survey</td>
                          <td contenteditable="true"></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Skin</td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>HEENT</td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Lungs</td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Heart</td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Abdomen</td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Extremities</td>
                          <td></td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>

                    <div class="form-inline">
                      <label>Chest X ray:</label> <input type="text" class="form-control" name="xray">
                    </div>
                    <br>
                    <div class="form-inline">
                      <label>Assessment:</label> Physically <input type="checkbox" class="form-check" name="assess" value="fit"> <label>fit</label>  <input type="checkbox" class="form-check" name="assess" value="unfit"> <label>unfit</label> at the same time of examination
                    </div>
                    <br>
                    <div class="form-group row">
                      <div class="col-lg-6">
                        <label>Plan/Recommendation:</label> 
                        <input type="text" class="form-control" name="plan">
                      </div>
                    </div>

                    <input type="hidden" name="action_type" value="add"/>
                    <input type="submit" class="btn btn-primary" id="add" name="btn-add" value="Add Record" />

                  </div>
                </div>
                <!-- End -->
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
  $('#otherSysRevCheck').change(function(){
    $("#otherSysRev").prop("disabled", !$(this).is(':checked'));
  });
  $('#otherMedHisCheck').change(function(){
    $("#otherMedHis").prop("disabled", !$(this).is(':checked'));
  });
</script>
    
</body>
</html>
<?php ob_end_flush(); ?>