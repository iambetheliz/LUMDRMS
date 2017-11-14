<?php
  ob_start();
  require_once '../includes/dbconnect.php';
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
<title>Edit faculty Record | Laguna University - Clinic | Medical Records System</title>
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
            <a href="../activities.php"><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp; Activities</a>
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
              $res = "SELECT * FROM `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` WHERE FacultyID=".$_GET['FacultyID'];
              $result = $DB_con->query($res);
              $row = $result->fetch_array(MYSQLI_BOTH);
           
              if(!empty($row)){
          ?>
    
    	      <!-- Page Heading -->
            <div class="row">
              <div class="col-lg-12">
                <h1 class="page-header">faculty's Information <span class="text-danger pull-right" id="errmsg"></span></h1>             
              </div>
            </div>
            <!-- End of Page Heading -->

            <!-- faculty Status Form -->
            <div class="container-fluid">
              <div class="row">
                <div class="form-group row">   
                  <div class="col-lg-2"> 
                    <label>faculty No.:</label>
                    <?php echo $row['facultyNo'];?>
                  </div>
                  <div class="col-lg-5"></div>
                  <div class="col-lg-3"> 
                    <label>Medical Status: </label>
                    <?php echo $row['med'];?>
                  </div> 
                  <div class="col-lg-2"> 
                    <label>Dental Status:</label>
                    <?php echo $row['dent'];?>
                  </div>
                </div>
              </div>
            </div>
            <!-- End of faculty Status-->

            <div class="container-fluid">
              <div class="row">     
                <!-- Basic Info -->
                <div class="panel panel-success">
                  <div class="panel-heading">
                    BASIC INFORMATION 
                  </div>
                  <div class="panel-body">

                  <div class="col-lg-6">   
                    <div class="form-group row">          
                      <label class="col-2">Full Name: </label>
                      <span class="col-2" style="text-decoration: underline;"><?php echo $row['first_name'];?> <?php echo $row['middle_name'];?> <?php echo $row['last_name'];?></span>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group row">
                      <label class="col-2">Age: </label>
                      <span class="col-2" style="text-decoration: underline;"><?php echo $row['age'];?> years old</span>
                      <label class="col-2">Sex: </label>
                      <span style="text-decoration: underline;"><?php echo $row['sex'];?></span>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group row">
                      <label class="col-2">Program: </label>
                      <span class="col-2" style="text-decoration: underline;"><?php echo $row['program'];?></span>
                      <label for="example-date-input" class="col-2">Year Level: </label>
                      <span class="col-2" style="text-decoration: underline;"><?php echo $row['yearLevel'];?> Year</span>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group row">
                      <label class="col-2 col-form-label">Semester: </label> 
                      <span class="col-2" style="text-decoration: underline;"><?php echo $row['sem'];?> Semester</span>
                      <label class="col-2 col-form-label">Academic Year:</label> 
                      <span class="col-2" style="text-decoration: underline;"><?php echo $row['acadYear'];?> </span>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group row">
                      <label class="col-2">Address:</label> 
                      <span class="col-2" style="text-decoration: underline;"><?php echo $row['address'];?></span>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group row">
                      <label class="col-2">Contact Person in case of Emergency:</label>
                      <span class="col-2" style="text-decoration: underline;"><?php echo $row['cperson'];?></span> 
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group row">
                      <label class="col-2">Cellphone No.:</label> 
                      <span class="col-2" style="text-decoration: underline;"><?php echo $row['cphone'];?></span>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group row">
                      <label class="col-2">Telephone No.:</label> 
                      <span class="col-2" style="text-decoration: underline;"><?php echo $row['tphone'];?></span>
                    </div>
                  </div>
              </div>
            </div>
            <!-- End of Basic Infor -->

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

                        <!-- Search Button -->
                        <form action="" method="get">
                        <div class="input-group pull-right" style="width: 300px;">
                            <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                            <span class="input-group-btn"><button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button></span>
                        </div>
                        </form>
                        <!-- End of Search Button -->
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
                        if(isset($errMSG)){ ?>

                        <div class="alert alert-warning">
                            <span class="glyphicon glyphicon-info"></span> <?php echo $errMSG; ?>
                        </div>
                            
                    <?php }
                    ?>
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
<script src="../assets/js/index.js" type="text/javascript"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>