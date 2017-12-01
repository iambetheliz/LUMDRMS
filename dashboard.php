<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="images/favicon.ico">
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="assets/fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="assets/css/dashboard.css" rel="stylesheet" type="text/css">
<link href="assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="assets/style.css" rel="stylesheet" type="text/css">
<!-- fullcalendar -->
<link href="calendar/assets/cal.css" rel="stylesheet" />
<link href="calendar/assets/fullcalendar.min.css" rel="stylesheet" />
<link href="calendar/assets/fullcalendar.print.css" rel="stylesheet" media="print" />
<style type="text/css">
  .modal-dialog {
    width: 500px;
  }
.fc-unthemed td.fc-today {
  background: #c3eec3;
}
.fc-unthemed .fc-divider, .fc-unthemed .fc-list-heading td, .fc-unthemed .fc-popover .fc-header {
  background: #428b42;
}
.fc .fc-row .fc-content-skeleton table, .fc .fc-row .fc-content-skeleton td, .fc .fc-row .fc-helper-skeleton td {
    /*background: white;*/
    border-color: #ddd;
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
        <ul class="sidebar-nav" role="menu">                    
          <li class="active">
            <a href="/lu_clinic/"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp; Dashboard</a>
          </li>
          <li>
            <a href="/lu_clinic/calendar/"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp; Activities</a>
          </li>
          <li role="presentation" class="have-child">
            <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp; Records &nbsp;&nbsp;<span class="caret"></span></a>
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
              <a href="tbl_users"><span class="fa fa-lock"></span>&nbsp;&nbsp; User Accounts</a>
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
                <h2 class="page-header">Dashboard
                  <div class="btn-toolbar pull-right" role="toolbar">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                      <button type="button" class="btn btn-default" name="day" id="day">Day</button>
                      <button type="button" class="btn btn-default" name="week" id="week">Week</button>
                      <button type="button" class="btn btn-default" name="month" id="month">Month</button>
                      <button type="button" class="btn btn-default" name="year" id="year">Year</button>
                    </div>
                  </div>
                </h2>
              </div>
            </div>  

            <?php 
            if (isset($_GET['loginSuccess'])) {?>  
              <div class="alert alert-success success-login" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $successMSG; ?>
              </div>              
            <?php }?>
            <div class="alert alert-info" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <p><span class="glyphicon glyphicon-info-sign"></span> <strong>Info:</strong> Displaying <strong>total numbers</strong> of records added per day, week, month and year</p>
            </div>
            <!-- End of Page Heading -->

            <!-- Notification Badges -->
            <div class="row" id="badges">
              
            </div>
            <!-- End of Badges -->

            <hr><br>

            <!--Graphs -->
            <div class="row">
              <div class="container-fluid">
                <div id="chartContainer" style="height: 370px; margin: 0px auto;"></div>
              </div>
            </div>

            <hr><br>
            
            <div class="row">
              <!-- Calendar -->
              <div class="col-md-8">
                <div id='calendar'></div>
              </div>
              <!-- Table -->
              <div class="col-md-4">
                <div class="panel panel-default panel-table">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col col-lg-6">
                        <div class="panel-title">
                          <strong>Students Table</strong>
                        </div>
                      </div>
                      <div class="col col-lg-6 text-right">
                        <button type="button" class="btn btn-sm btn-primary btn-create">View Details</button>
                      </div>
                    </div>
                  </div>
                  <div class="panel-body">
                  <table class="table table-striped table-bordered table-list">
                    <thead>
                      <tr>
                        <th>Gender</th>
                        <th>Total Number</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php    
                      foreach($DB_con->query('SELECT sex,COUNT(*) FROM students GROUP BY sex') as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['sex'] . "</td>";
                        echo "<td>" . $row['COUNT(*)'] . "</td>";
                        echo "</tr>"; 
                    } 
                      if (empty($row)) {
                        echo "<tr><td colspan='2'>No records found</td></tr>";
                      }
                    ?>
                    </tbody>
                  </table>
                </div>
                <div class="panel-footer"></div>
              </div>
            </div>
          </div>
          <!-- End of tables -->

        </div>  
      </div>
    </div>
    <!-- End of Main Screen -->
  
  </div>
  <!-- End of Content -->

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
                  <input class="form-control" id="title" name="title" placeholder="Title" type="text" value="">
              </div>
              <br>
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
      <p class="text-muted" align="right"><a href="http://lu.edu.ph/" target="_blank">Laguna University</a> &copy; 2017</p>
  </div>
</footer>
  
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/custom.js" type="text/javascript"></script>
<script type="text/javascript">
  window.setTimeout(function() {
    $(".success-login").fadeTo(1000,0).slideUp('fast', function(){
      $(this).remove();
      window.location.href='dashboard';
    });
  }, 3000);
</script>

<!--calendar-->
<script src="calendar/assets/jquery-ui.min.js"></script>
<script src="calendar/assets/moment.min.js"></script>
<script src="calendar/assets/fullcalendar.min.js"></script>
<script type="text/javascript" src="calendar/assets/calendar_sample.js"></script>

<!--graphs-->
<script src="charts/canvasjs.min.js"></script>
<script src="charts/jquery.canvasjs.min.js"></script>
<script src="charts/charts.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#badges").load("badges.php");
  $('#year').click(function(){
    var day = $('#day').val();
    var week = $('#week').val();
    var month = $('#month').val();
    var year = $('#year').val();
    $.ajax({    
      type:'POST',
      url:'badges.php',
      data:{year:year},
      success:function(data){
        $("#badges").html(data); 
      }
    }); 
  });
  $('#month').click(function(){
    var day = $('#day').val();
    var week = $('#week').val();
    var month = $('#month').val();
    var year = $('#year').val();
    $.ajax({    
      type:'POST',
      url:'badges.php',
      data:{month:month},
      success:function(data){
        $("#badges").html(data); 
      }
    }); 
  });
  $('#week').click(function(){
    var day = $('#day').val();
    var week = $('#week').val();
    var month = $('#month').val();
    var year = $('#year').val();
    $.ajax({    
      type:'POST',
      url:'badges.php',
      data:{week:week},
      success:function(data){
        $("#badges").html(data); 
      }
    }); 
  });
  $('#day').click(function(){
    var day = $('#day').val();
    var week = $('#week').val();
    var month = $('#month').val();
    var year = $('#year').val();
    $.ajax({    
      type:'POST',
      url:'badges.php',
      data:{day:day},
      success:function(data){
        $("#badges").html(data); 
      }
    }); 
  });
});
</script>
    
</body>
</html>
<?php ob_end_flush(); ?>