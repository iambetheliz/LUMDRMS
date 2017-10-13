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
    $output = '';
    if(!empty($userRow)){
        $account = '<a href="#"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;'. ucwords($userRow['userName']).'</a>';
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
<title>View Student Record | Laguna University - Clinic | Medical Records System</title>
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
    
    	  <!-- Page Heading -->
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">Student's Medical Record <a href="edit_record.php?id=<?php echo $row['id'];?>" class="btn btn-primary pull-right">Edit</a></h1>              
          </div>
        </div>
        <!-- End of Page Heading -->
        <?php 
          require_once '../dbconnect.php';

          $DB_con = new mysqli("localhost", "root", "", "records");

          if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

            $id = $_GET['id'];
            $res = "SELECT * FROM students WHERE id=".$_GET['id'];
            $result = $DB_con->query($res);
            $row = $result->fetch_array(MYSQLI_BOTH);
            
            if(!empty($row)){
        ?>
        
        <!-- Start of Form -->
        <form action="action.php" method="post">

        <div class="row">
          <div class="col-lg-12">     

            <!-- Basic Info -->
            <div class="panel panel-success">
              <div class="panel-heading">
                BASIC INFORMATION 
              </div>
              <div class="panel-body">
                <div class="form-group row">   
                  <div class="col-lg-6">          
                    <label class="col-2 col-form-label">Name:</label>
                    <?php echo $row['last_name'];?>, <?php echo $row['first_name'];?> <?php echo $row['middle_name'];?>
                  </div>
                  <div class="col-lg-2">
                    <label class="col-2 col-form-label">Age:</label> <?php echo $row['age'];?>
                  </div>
                  <div class="col-lg-2">
                    <label class="col-2 col-form-label">Sex:</label> <?php echo $row['sex'];?>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label class="col-2 col-form-label">Program:</label> <?php echo $row['program'];?>
                  </div>
                  <div class="col-lg-2">
                    <label class="col-2 col-form-label">Year Level:</label> <?php echo $row['yearLevel'];?>
                  </div>
                  <div class="col-lg-2">
                    <label class="col-2 col-form-label">Semester</label> <?php echo $row['sem'];?>
                  </div>
                  <div class="col-lg-2">
                    <label class="col-2 col-form-label">Academic Year:</label> <?php echo $row['acadYear'];?>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-12">
                    <label class="col-2 col-form-label">Address:</label> <?php echo $row['address'];?>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label class="col-2 col-form-label">Contact Person in case of Emergency:</label> <?php echo $row['cperson'];?>
                  </div>
                  <div class="col-lg-3">
                    <label class="col-2 col-form-label">Cellphone No.:</label> <?php echo $row['cphone'];?>
                  </div>
                  <div class="col-lg-3">
                    <label class="col-2 col-form-label">Telephone No.:</label> <?php echo $row['tphone'];?>
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
                    <input type="checkbox" class="form-check-input"> Recurrent Headache
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> Blurring of Vision
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> Abdominal Pain
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> Cough and colds
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> Other <input type="text" class="form-control" name="">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> Chest pain
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> LOC/Seizure
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> Easy fatigability
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> Easy bruisability
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> Fever
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> Vomiting
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> LBM
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> Dysuria
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
                    <input type="checkbox" class="form-check-input"> Bronchial Asthma
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> PTB
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> Allergy
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> Other <input type="text" class="form-control" name="">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> Hypertension
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> UTI
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> Surgery
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> Cardiovascular DSE
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> Bleeding Disorder
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input"> Skin Disorder
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

                <button type="submit" class="btn btn-primary" name="btn-add">Add Record</button>

              </div>
            </div>
          </div>
        </div>
        <!-- End -->

        </form>
        <!-- End of Form -->

        <?php }}?>
    
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
    
</body>
</html>
<?php ob_end_flush(); ?>