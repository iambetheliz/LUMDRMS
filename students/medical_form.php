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
	<div id="wrapper" class="toggled">

        <!-- Sidebar Menu Items -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">                    
                <li>
                    <a href="/lu_clinic"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp; Dashboard</a>
                </li>
                <li class="active">
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp; Tables &nbsp;&nbsp;<span class="caret"></span></a>
                    <ul id="demo" class="collapse in">
                        <li>
                            <a href="/lu_clinic/students/tbl_rec.php"><span class="glyphicon glyphicon-education"></span>&nbsp;&nbsp; Students</a>
                        </li>
                        <li>
                            <a href="/lu_clinic/faculties/add_new.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; Faculties</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>  
        <!-- End of Sidebar -->
	      
        <!-- Start of Main Screen -->
        <div id="page-content-wrapper">
        <div class="container-fluid">

        <!-- Start of Form -->
        <form action="action.php" method="post">
    
    	  <!-- Page Heading -->
        <div class="row">
          <div class="col-lg-12 form-inline">
            <h1 class="page-header">Student's Medical Form <input type="text" class="form-control pull-right" placeholder="Student No" name="studentNo" autofocus=""></h1>
          </div>
        </div>
        <!-- End of Page Heading -->  

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
                    <label class="col-2 col-form-label" for="inlineFormInput">Surname</label> <span class="text-danger pull-right" id="errmsg"></span>
                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Dela Cruz" name="last_name" id="lettersOnly">
                  </div>
                  <div class="col-lg-3">
                    <label class="col-2 col-form-label" for="inlineFormInput">First Name</label> <span class="text-danger pull-right" id="errmsg"></span>
                    <input type="text" class="form-control" placeholder="Juan" name="first_name" id="lettersOnly">
                  </div>
                  <div class="col-lg-2">
                    <label class="col-2 col-form-label" for="inlineFormInput">Middle Name</label> <span class="text-danger pull-right" id="errmsg"></span>
                    <input type="text" class="form-control" placeholder="Magdayao" name="middle_name" id="lettersOnly">
                  </div>      
                  <div class="col-lg-2">
                    <label for="example-number-input" class="col-2 col-form-label">Age</label> <span class="text-danger pull-right" id="errmsg"></span>
                    <input class="form-control" type="text" placeholder="00" name="age" id="numbersOnly" maxlength="2">
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
                      $year_built_min = 2006;
                      $year_built_max = date("Y"); ?>
                    <select class="form-control" style="width: 110px;" name="acadYears[]">
                    <?php // Generate minimum years 
                      foreach (range($year_built_min, $year_built_max) as $year) { ?>
                        <option value="<?php echo($year); ?>"><?php echo($year); ?></option>
                    <?php } ?>
                    </select>
                    <select class="form-control" style="width: 110px;" name="acadYears[]">
                    <?php // Generate max years 
                      foreach (range($year_built_max, $year_built_min) as $year) { ?>
                        <option value="<?php echo($year); ?>"><?php echo($year); ?></option>
                    <?php } ?>
                    </select>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-12">
                    <label for="example-date-input" class="col-2 col-form-label">Address</label>
                    <input type="text" class="form-control" name="address">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label for="example-date-input" class="col-2 col-form-label">Contact Person in case of Emergency</label>
                    <input type="text" class="form-control" name="cperson">
                  </div>
                  <div class="form-group col-lg-3">
                    <label for="example-date-input" class="col-2 col-form-label">Cellphone No.</label>
                    <input type="text" name="cphone" class="form-control" placeholder="09358306457">
                  </div>
                  <div class="form-group col-lg-3">
                    <label for="example-date-input" class="col-2 col-form-label">Telephone No.</label>
                    <input type="text" name="tphone" class="form-control" placeholder="536-1234">
                  </div>
                </div>
              </div>
            </div>
            <!-- End of Basic Infor -->

            <!-- Review of System -->
            <div class="panel panel-success">
              <div class="panel-heading">
                REVIEW OF SYSTEM
              </div>
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
                    <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Other"> Other <input type="text" class="form-control" name="">
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
            <!-- End -->

            <!-- Past Medical History -->
            <div class="panel panel-success">
              <div class="panel-heading">
                PAST MEDICAL HISTORY
              </div>
              <div class="panel-body">
                <div class="col-lg-4">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="check_list[]" value="Bronchial Asthma"> Bronchial Asthma
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="check_list[]" value="PTB"> PTB
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="check_list[]" value="Allergy"> Allergy
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="check_list[]" value="Other"> Other <input type="text" class="form-control" name="">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="check_list[]" value="Hypertension"> Hypertension
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="check_list[]" value="UTI"> UTI
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="check_list[]" value="Surgery"> Surgery
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="check_list[]" value="Cardiovascular DSE"> Cardiovascular DSE
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="check_list[]" value="Bleeding Disorder"> Bleeding Disorder
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="check_list[]" value="Skin Disorder"> Skin Disorder
                  </div>
                </div>
              </div>
            </div>
            <!-- End -->

          </div>
        </div>

        <!-- -->
        <div class="row">
          <div class="col-lg-6">
            <div class="panel panel-success">
              <div class="panel-heading">
                PERSONAL AND SOCIAL HISTORY
              </div>
              <div class="panel-body">
                <div class="form-check">
                  <table width="100%">
                    <tr>
                      <td><label class="form-check-label">Alcoholic Drinker: </label></td>
                      <td><input class="form-check-input" type="checkbox"> Yes</td>
                      <td><input type="checkbox" class="form-check-input" name=""> No</td>
                    </tr>     
                    <tr>
                    <td><label class="form-check-label">Smoker: </label></td>
                    <td><input class="form-check-input" type="checkbox"> Yes</td>
                    <td><input type="checkbox" class="form-check-input" name=""> No</td>
                    </tr>
                    <tr>
                      <td><label class="form-check-label">Use of Illicit Drugs: </label></td>
                      <td><input class="form-check-input" type="checkbox"> Yes</td>
                      <td><input type="checkbox" class="form-check-input" name=""> No</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="panel panel-success">
              <div class="panel-heading">
                OB/GYNE HISTORY
              </div>
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

        <!-- Physical Exam -->
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-success">
              <div class="panel-heading">
                PHYSICAL EXAMINATION
              </div>
              <div class="panel-body">
                <div class="form-group row">
                  <div class="col-lg-3">
                    <label>Weight:</label>  
                    <input type="text" class="form-control"> 
                  </div>
                  <div class="col-lg-3">
                    <label>Height:</label> 
                    <input type="text" class="form-control"> 
                  </div>
                  <div class="col-lg-3">
                    <label>BMI:</label> 
                    <input type="text" class="form-control"> 
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-3">
                    <label>BP:</label> 
                    <input type="text" class="form-control"> 
                  </div>
                  <div class="col-lg-3">
                    <label>CR:</label>
                    <input type="text" class="form-control"> 
                  </div>
                  <div class="col-lg-3">
                    <label>RR:</label>
                    <input type="text" class="form-control"> 
                  </div>
                  <div class="col-lg-3">
                    <label>T:</label>
                    <input type="text" class="form-control"> 
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
                      <td></td>
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
                  <label>Chest X ray:</label> <input type="text" class="form-control" name="">
                </div>
                <br>
                <div class="form-inline">
                  <label>Assessment:</label> Physically <input type="checkbox" class="form-check" name=""> <label>fit</label>  <input type="checkbox" class="form-check" name=""> <label>unfit</label> at the same time of examination
                </div>
                <br>
                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Plan/Recommendation:</label> 
                    <input type="text" class="form-control" name="">
                  </div>
                </div>

                <input type="hidden" name="action_type" value="add"/>
                <input type="submit" class="btn btn-primary" name="btn-add" value="Add Record" />

              </div>
            </div>
          </div>
        </div>
        <!-- End -->

        </form>
        <!-- End of Form -->
    
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
<script type="text/javascript">
$(document).ready(function () {
  //called when key is pressed in textbox
  $("#numbersOnly").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
  $("#lettersOnly").keypress(function(event){
        var inputValue = event.which;
        // allow letters and whitespaces only.
        if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
          //display error message
          $("#errmsg").html("Letters Only").show().fadeOut("slow");
               return false;
        }
    });
});
</script>
    
</body>
</html>
<?php ob_end_flush(); ?>