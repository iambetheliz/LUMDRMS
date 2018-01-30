<?php  
  include 'calendar.php';
  include 'includes/Class.NumbersToWords.php';
?>
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
@media print {
  #calendar, .alert {
    display: none;
  }
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
            <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp; Records <i class="fa fa-caret-down"></i></a>
            <ul id="demo" class="panel-collapse collapse">
              <li>
                <a href="/lu_clinic/students/"><span class="fa fa-graduation-cap"></span>&nbsp;&nbsp; Students</a>
              </li>
              <li>
                <a href="/lu_clinic/faculties/"><span class="fa fa-briefcase"></span>&nbsp;&nbsp; Faculty and Staffs</a>
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
                  <button type="button" class="btn btn-primary"  onclick="javascript:window.print()" value="Print"><i class="fa fa-print"></i> Print</button>
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
                <div id="chartContainer" style="height: 370px; width: 100%; margin: 0px auto;"></div>
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
                      <div class="container-fluid">
                        <div class="panel-title">
                          <strong>Gender Population</strong>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel-body">
                  <table class="table table-striped table-bordered table-list">
                    <thead>
                      <tr>
                        <th>Gender</th>
                        <th>Population</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php    
                      $query = mysqli_query($DB_con,"SELECT (SELECT COUNT(*) FROM `students` WHERE sex = 'Female') AS total_students, (SELECT COUNT(*) FROM `faculties` WHERE sex = 'Female') AS total_faculties");
                      $female = mysqli_fetch_array($query);
                      $f_count = $female['total_students'] + $female['total_faculties'];

                      $query = mysqli_query($DB_con,"SELECT (SELECT COUNT(*) FROM `students` WHERE sex = 'Male') AS total_students, (SELECT COUNT(*) FROM `faculties` WHERE sex = 'Male') AS total_faculties");
                      $male = mysqli_fetch_array($query);
                      $m_count = $male['total_students'] + $male['total_faculties'];

                      $total = $f_count + $m_count;

                      if (!empty($female && $male)) {
                        echo "<tr>";
                        echo "<td>Female</td>";
                        echo "<td>" . $f_count . "</td>";
                        echo "</tr>"; 
                        echo "<tr>";
                        echo "<td>Male</td>";
                        echo "<td>" . $m_count . "</td>";
                        echo "</tr>"; 
                        echo "<tr>";
                        echo "<td><strong>Total</strong></td>";
                        echo "<td><strong>" . $total . "</strong></td>";
                        echo "</tr>"; 
                      }                        
                      else {
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

  <!-- Modal -->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
  <form class="form-horizontal" method="POST" action="calendar/addEvent.php">
  
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Add Event</h4>
    </div>
    <div class="modal-body">
    
      <div class="form-group">
      <label for="title" class="col-sm-2 control-label">Title</label>
      <div class="col-sm-10">
        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
      </div>
      </div>
      <div class="form-group">
      <label for="color" class="col-sm-2 control-label">Color</label>
      <div class="col-sm-10">
        <select name="color" class="form-control" id="color">
          <option value="">Choose</option>
          <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
          <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
          <option style="color:#008000;" value="#008000">&#9724; Green</option>             
          <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
          <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
          <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
          <option style="color:#000;" value="#000">&#9724; Black</option>
          
        </select>
      </div>
      </div>
      <div class="form-group">
      <label for="start" class="col-sm-2 control-label">Start date</label>
      <div class="col-sm-10">
        <input type="text" name="start" class="form-control" id="start" readonly>
      </div>
      </div>
      <div class="form-group">
      <label for="end" class="col-sm-2 control-label">End date</label>
      <div class="col-sm-10">
        <input type="text" name="end" class="form-control" id="end" readonly>
      </div>
      </div>
    
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
  </form>
  </div>
  </div>
</div>  
  
<!-- Modal -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
  <form class="form-horizontal" method="POST" action="calendar/editEventTitle.php">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Edit Event</h4>
    </div>
    <div class="modal-body">
    
      <div class="form-group">
      <label for="title" class="col-sm-2 control-label">Title</label>
      <div class="col-sm-10">
        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
      </div>
      </div>
      <div class="form-group">
      <label for="color" class="col-sm-2 control-label">Color</label>
      <div class="col-sm-10">
        <select name="color" class="form-control" id="color">
          <option value="">Choose</option>
          <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
          <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
          <option style="color:#008000;" value="#008000">&#9724; Green</option>             
          <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
          <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
          <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
          <option style="color:#000;" value="#000">&#9724; Black</option>
          
        </select>
      </div>
      </div>
        <div class="form-group"> 
        <div class="col-sm-offset-2 col-sm-10">
          <div class="checkbox">
          <label class="text-danger"><input type="checkbox"  name="delete"><span class="lbl"></span> Delete event</label>
          </div>
        </div>
      </div>
      
      <input type="hidden" name="id" class="form-control" id="id">
    
    
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
  </form>
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

<!-- Growl -->
<script src="assets/js/jquery.bootstrap-growl.js"></script>

<!-- FullCalendar -->
<script src='calendar/js/moment.min.js'></script>
<script src='calendar/js/fullcalendar.min.js'></script>

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
$(document).ready(function() {
  
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay,listMonth'
    },
    editable: true,
    eventLimit: true, // allow "more" link when too many events
    selectable: true,
    selectHelper: true,
    select: function(start, end) {      
      $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
      $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
      $('#ModalAdd').modal('show');
    },
    eventRender: function(event, element) {
      element.bind('dblclick', function() {
        $('#ModalEdit #id').val(event.id);
        $('#ModalEdit #title').val(event.title);
        $('#ModalEdit #color').val(event.color);
        $('#ModalEdit').modal('show');
      });
    },
    eventDrop: function(event, delta, revertFunc) { // si changement de position

      edit(event);

    },
    eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

      edit(event);

    },
    events: [
    <?php foreach($events as $event): 
    
      $start = explode(" ", $event['start']);
      $end = explode(" ", $event['end']);
      if($start[1] == '00:00:00'){
        $start = $start[0];
      }else{
        $start = $event['start'];
      }
      if($end[1] == '00:00:00'){
        $end = $end[0];
      }else{
        $end = $event['end'];
      }
    ?>
      {
        id: '<?php echo $event['id']; ?>',
        title: '<?php echo $event['title']; ?>',
        start: '<?php echo $start; ?>',
        end: '<?php echo $end; ?>',
        color: '<?php echo $event['color']; ?>',
      },
    <?php endforeach; ?>
    ]
  });
  
  function edit(event){
    start = event.start.format('YYYY-MM-DD HH:mm:ss');
    if(event.end){
      end = event.end.format('YYYY-MM-DD HH:mm:ss');
    }else{
      end = start;
    }
    
    id =  event.id;
    
    Event = [];
    Event[0] = id;
    Event[1] = start;
    Event[2] = end;
    
    $.ajax({
     url: 'calendar/editEventDate.php',
     type: "POST",
     data: {Event:Event},
     success: function(rep) {
        if(rep == 'OK'){
          $.bootstrapGrowl("Event updated!", // Messages
                { // options
                  type: "success", // info, success, warning and danger
                  ele: "body", // parent container
                  offset: {
                    from: "top",
                    amount: 20
                  },
                  align: "right", // right, left or center
                  width: 300,
                  delay: 4000,
                  allow_dismiss: true, // add a close button to the message
                  stackup_spacing: 10
                });
        }else{
          $.bootstrapGrowl("Event cannot be saved!", // Messages
                { // options
                  type: "danger", // info, success, warning and danger
                  ele: "body", // parent container
                  offset: {
                    from: "top",
                    amount: 20
                  },
                  align: "right", // right, left or center
                  width: 300,
                  delay: 4000,
                  allow_dismiss: true, // add a close button to the message
                  stackup_spacing: 10
                }); 
        }
      }
    });
  }
  
});
</script>
    
</body>
</html>
<?php ob_end_flush(); ?>