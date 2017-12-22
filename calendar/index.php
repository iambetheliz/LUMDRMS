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
  
  if(isset($_POST['action']) or isset($_GET['view'])) { //show all events

    if(isset($_GET['view'])) {

        header('Content-Type: application/json');
        $start = mysqli_real_escape_string($DB_con,$_GET["start"]);
        $end = mysqli_real_escape_string($DB_con,$_GET["end"]);

        $result = mysqli_query($DB_con,"SELECT id, start ,end ,title FROM  events where (date(start) >= '$start' AND date(start) <= '$end')");
        while($row = mysqli_fetch_assoc($result)) {
            $events[] = $row; 
        }

        echo json_encode($events); 
        exit;
    }
    elseif($_POST['action'] == "add") { // add new event  
        mysqli_query($DB_con,"INSERT INTO events (title,start,end) VALUES('".mysqli_real_escape_string($DB_con,$_POST["title"])."','".mysqli_real_escape_string($DB_con,date('Y-m-d H:i:s',strtotime($_POST["start"])))."','".mysqli_real_escape_string($DB_con,date('Y-m-d H:i:s',strtotime($_POST["end"])))."')");

        header('Content-Type: application/json');
        echo '{"id":"'.mysqli_insert_id($DB_con).'"}';
        exit;
    }
    elseif($_POST['action'] == "update")  { // update event
        mysqli_query($DB_con,"UPDATE events set start = '".mysqli_real_escape_string($DB_con,date('Y-m-d H:i:s',strtotime($_POST["start"])))."', end = '".mysqli_real_escape_string($DB_con,date('Y-m-d H:i:s',strtotime($_POST["end"])))."' WHERE id = '".mysqli_real_escape_string($DB_con,$_POST["id"])."'");
        exit;
    }

    elseif($_POST['action'] == "delete") { // remove event
        mysqli_query($DB_con,"DELETE from events where id = '".mysqli_real_escape_string($DB_con,$_POST["id"])."'");

        if (mysqli_affected_rows($DB_con) > 0) {
            echo "1";
        }
        exit;
    }

}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Calendar Activities | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<!-- bootstrap -->
<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/style.css" rel="stylesheet" type="text/css">
<!-- fullcalendar -->
<link href="../calendar/assets/fullcalendar.css" rel="stylesheet" />
<link href="../calendar/assets/fullcalendar.print.css" rel="stylesheet" media="print" />
<style>
 #calendar {
  width: 100%;
  }
  .modal-dialog {
    width: 500px;
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
                <li class="active">
                    <a href="/lu_clinic/calendar/"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp; Activities</a>
                </li>
                <li role="presentation" class="have-child">
                    <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><i class="fa fa-table" aria-hidden="true"></i>&nbsp;&nbsp; Records &nbsp;&nbsp;<span class="caret"></span></a>
                    <ul id="demo" class="panel-collapse collapse">
                        <li>
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
                      <a href="tbl_users.php"><span class="fa fa-users"></span>&nbsp;&nbsp; User Accounts</a>
                    </li>
                  <?php    }
                  ?>
                </ul>
          </nav>
        </div>  
        <!-- End of Sidebar --> 

        <!-- Begin Main Screen -->
        <div id="page-content-wrapper">
          <div class="page-content">
            <div class="container-fluid">   

                <!-- Page Heading -->
                <div class="row">
                    <div class="container-fluid">
                        <h1 class="page-header">Calendar Activities <small class="text-muted text-success pull-right" id="message"><?php  echo $successMSG; echo $errorMSG; ?></small></h1>
                    </div>
                </div>
                <!-- End of Page Heading -->

                <!-- add calander in this div -->

                <div class="container-fluid">
                    <div class="row">
                        <div id='calendar'></div>
                    </div>
                </div> 

            </div>
          </div>
        </div>
    </div>

    <!-- Modal  to Add Event -->
    <div id="createEventModal" class="modal fade" role="dialog">
      <div class="modal-dialog"> 

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Add Event</h4>
            </div>

            <div class="modal-body">
                <div class="control-group">
                    <label class="control-label" for="inputPatient">Event:</label>
                    <div class="field desc">
                        <input class="form-control" id="title" name="title" placeholder="Event" type="text" value="">
                    </div>
                </div>
                <input type="hidden" id="startTime"/>
                <input type="hidden" id="endTime"/>
                <div class="control-group">
                    <label class="control-label" for="when">When:</label>
                    <div class="controls controls-row" id="when" style="margin-top:5px;">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
            </div>
        </div>
      </div>
    </div>

    <!-- Modal to Event Details -->
    <div id="calendarModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Event Details</h4>
                </div>
                <div id="modalBody" class="modal-body">
                    <h4 id="modalTitle" class="modal-title"></h4>
                    <div id="modalWhen" style="margin-top:5px;"></div>
                </div>
                <input type="hidden" id="eventID"/>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    <button type="submit" class="btn btn-danger" id="deleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!--Modal-->

    <footer class="footer">
        <div class="container-fluid">
            <p class="text-muted" align="right"><a href="http://lu.edu.ph/" target="_blank">Laguna University</a> &copy; <script type="text/javascript">document.write(new Date().getFullYear());</script></p>
        </div>
    </footer>

</body>
<!-- jQuery -->
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/custom.js"></script> 
<!-- calendar scripts --> 
<script src="../calendar/assets/jquery-ui.min.js"></script>
<script src="../calendar/assets/moment.min.js"></script>
<script src="../calendar/assets/fullcalendar.min.js"></script>
<script type="text/javascript" src="../calendar/assets/calendar.js"></script>
</html>
