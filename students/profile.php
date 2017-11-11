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
<title>Student Information | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
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
            <a href="../activities.php"><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp; Activities</a>
          </li>
          <li class="active have-child" role="presentation">
            <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp; Records &nbsp;&nbsp;<span class="caret"></span></a>
            <ul id="demo" class="panel-collapse collapse in">
              <li class="active">
                <a href="/lu_clinic/students/index.php"><span class="glyphicon glyphicon-education"></span>&nbsp;&nbsp; Students</a>
              </li>
              <li>
                <a href="/lu_clinic/faculties/records.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; Faculties</a>
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
                <h1 class="page-header">Student's Information 
                </h1>             
              </div>
            </div>
            <!-- End of Page Heading -->

            <div class="container-fluid">
              <div class="row">     
                <!-- Basic Info -->
                <div class="panel panel-success">
                  <div class="panel-heading">
                    <div class="panel-title">
                      <strong>BASIC INFORMATION</strong>
                    </div>
                  </div>
                  <div class="panel-body">

                <table class="table table-bordered table-striped">
                  <tr>
                  </tr>
                  <tr>
                    <td><label>Full Name:</label></td>
                    <td colspan="2"><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name']." ".$row['ext'];?></td>
                    <td><label>Age:</label></td>
                    <td><?php echo $row['age'];?> years old</td>
                    <td><label>Gender:</label></td>
                    <td><?php echo $row['sex'];?></td>
                    <td><label>Student No.:</label></td>
                    <td><?php echo $row['studentNo'];?></td>
                  </tr>
                  <tr>
                    <td><label>Program:</label></td>
                    <td colspan="2"><?php echo $row['program'];?></td>
                    <td><label>Year Level:</label></td>
                    <td><?php echo $row['yearLevel'];?> Year</td>
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
                <!-- End of Basic Infor --> 
              </div>
            </div>

                <?php 
                  require_once '../includes/dbconnect.php';
                  include '../includes/pagination.php';

                  $DB_con = new mysqli("localhost", "root", "", "records");

                  $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
            
                  if ($page <= 0) $page = 1;
                    $per_page = 5; // Set how many records do you want to display per page.
    
                    if (isset($_GET['StudentID'])) {
                      $StudentID = $_GET['StudentID'];

                      $startpoint = ($page * $per_page) - $per_page;
                      $statement = "`students_med` WHERE StudentID = '".$_GET['StudentID']."'";
                      $result = mysqli_query($DB_con,"SELECT * FROM $statement"); 
                      $count = $result->num_rows;
                    }
                ?>

            <div class="container-fluid">
              <div class="row">
                <div class="panel panel-success">
                  <div class="panel-heading">
                    <div class="panel-title">
                      <strong>MEDICAL INFORMATION</strong>
                    </div>
                  </div>
                  <div class="panel-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <td><label>PERSONAL AND SOCIAL HISTORY</label></td>
                          <td><label>O.B. GYNE</label></td>
                        </tr>
                        <tbody>
                          <tr>
                          </tr>
                        </tbody>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>

        <!-- Physical Exam -->
        <div class="container-fluid">
          <div class="row">
            <div class="panel panel-success">
              <div class="panel-heading">
                <div class="panel-title">
                  <strong>PREVIOUS CHECKUPS</strong>
                </div>
              </div>
              <div class="panel-body">             
                <!-- Buttons -->
                <div class="container-fluid">
                  <div class="row">
                    <!-- Start btn-toolbar -->
                    <div class="btn-toolbar">
                        <a href="medical_form.php?StudentID=<?php echo $row['StudentID']; ?>" class="btn btn-success">New</a>
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
                        <td style="display: none;"><input type="checkbox" name="chk[]" class="chk-box" value="<?php echo $row['StudentID']; ?>"  /></td>
                        <td><?php echo $row['sysRev']; ?></td>
                        <td><?php echo $row['medHis']; ?></td>
                        <td><?php echo $row['drinker']; ?></td>
                        <td><?php echo $row['smoker']; ?></td>
                        <td><?php echo $row['drug_user']; ?></td>
                        <td><?php echo $row['weight']; ?></td>
                        <td><?php echo $row['height']; ?></td>
                        <td><?php echo $row['bmi']; ?></td>
                        <td><?php echo date("F j, Y", strtotime($row['date_checked_up'])); ?></td>
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
<script type="text/javascript">
// When + or - buttons are clicked the font size of the h1 is increased/decreased by 2
// The max is set to 50px for this demo, the min is set by min font in the user's style sheet

function getSize() {
  size = $( ".form-group" ).css( "font-size" );
  size = parseInt(size, 10);
  $( "#font-size" ).text(  size  );
}

//get inital font size
getSize();

$( "#up" ).on( "click", function() {

  // parse font size, if less than 50 increase font size
  if ((size + 2) <= 20) {
    $( ".form-group" ).css( "font-size", "+=2" );
    $( "#font-size" ).text(  size += 2 );
  }
});

$( "#down" ).on( "click", function() {
  if ((size - 2) >= 14) {
    $( ".form-group" ).css( "font-size", "-=2" );
    $( "#font-size" ).text(  size -= 2  );
  }
});
</script>
    
</body>
</html>
<?php ob_end_flush(); ?>