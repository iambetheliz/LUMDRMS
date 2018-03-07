<?php
require_once('bdd.php');

$sql = "SELECT id, title, start, end, color FROM events ";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Calendar Activities | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/style.css" rel="stylesheet" type="text/css">
<!-- fullcalendar -->
<link href="assets/cal.css" rel="stylesheet" />
<link href="assets/fullcalendar.min.css" rel="stylesheet" />
<link href="assets/fullcalendar.print.css" rel="stylesheet" media="print" />
<link href="../datepicker/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
<!-- Custom CSS -->
<style>
.input-group[class*=col-] {
    float: none;
    padding-right: 15px;
    padding-left: 15px;
}
.fc-unthemed .fc-content, .fc-unthemed .fc-divider, .fc-unthemed .fc-list-heading td, .fc-unthemed .fc-list-view, .fc-unthemed .fc-popover, .fc-unthemed .fc-row, .fc-unthemed tbody, .fc-unthemed td, .fc-unthemed th, .fc-unthemed thead {
    border-color: #7fbf7f;
}
tr.fc-list-heading td.fc-widget-header {    
    background: #428b42;
    border-color: green;
}
tr.fc-list-heading td.fc-widget-header a {    
    color: white;
    text-decoration: none;
}
.fc-unthemed.fc-list-item:hover {    
    color: green;
    background: green;
}
tr.fc-list-item {
    background: #b2d8b2;
}
tr.fc-list-item.fc-allow-mouse-resize {
    background: beige;
    color: green;
    cursor: pointer;
}
</style>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

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
            <a href="/LUMDRMS/"><i class="col-1 fa fa-bar-chart" aria-hidden="true"></i>Dashboard</a>
          </li>
          <li class="active">
            <a href="/LUMDRMS/calendar/"><i class="col-1 fa fa-calendar" aria-hidden="true"></i>Activities</a>
          </li>
          <li>
            <a href="/LUMDRMS/students/"><i class="col-1 fa fa-graduation-cap" aria-hidden="true"></i>Students</a>
          </li>
          <li>
            <a href="/LUMDRMS/faculties/"><i class="col-1 fa fa-briefcase" aria-hidden="true"></i>Faculty and Staff</a>
          </li>
          <li role="presentation" class="have-child">
            <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><i class="col-1 fa fa-book" aria-hidden="true"></i>Records <i class="col-1 fa fa-caret-down" aria-hidden="true"></i></a>
            <ul id="demo" class="panel-collapse collapse">
              <li>
              <a class="med" role="submenuitem" data-toggle="collapse"><i class="col-1 fa fa-medkit" aria-hidden="true"></i>Medical <i class="col-1 fa fa-caret-down" aria-hidden="true"></i></a>
              <ul id="med" class="panel-collapse collapse">
                <li>
                  <a href="/LUMDRMS/medical/students/"><i class="col-1 fa fa-graduation-cap" aria-hidden="true"></i>Students</a>
                </li>
                <li>
                  <a href="/LUMDRMS/medical/faculties/"><i class="col-1 fa fa-briefcase" aria-hidden="true"></i>Faculty and Staff</a>
                </li>
              </ul>
            </li>  
            <li>
              <a class="den" role="submenuitem" data-toggle="collapse"><i class="col-1 fa fa-smile-o" aria-hidden="true"></i>Dental <i class="col-1 fa fa-caret-down" aria-hidden="true"></i></a>
              <ul id="den" class="panel-collapse collapse">
                <li>
                  <a href="/LUMDRMS/dental/students/"><i class="col-1 fa fa-graduation-cap" aria-hidden="true"></i>Students</a>
                </li>
                <li>
                  <a href="/LUMDRMS/dental/faculties/"><i class="col-1 fa fa-briefcase" aria-hidden="true"></i>Faculty and Staff</a>
                </li>
              </ul>
            </li>
            </ul>
          </li>
          <?php 
            if ($userRow['role'] == 'superadmin') {?>
            <li>
              <a href="/LUMDRMS/users"><i class="col-1 fa fa-user-md" aria-hidden="true"></i>User Accounts</a>
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
            <h1 class="page-header">Calendar Activities</h1>
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
  <!-- End -->

</div>
<!-- End of Content -->

	
<!-- Modal -->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	<form id="addEvent" method="POST">	
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <h4 class="modal-title" id="myModalLabel">Add New Event</h4>
		</div>
		<div class="modal-body row">
		  <div class="container-fluid">
		  	<div class="form-group">
		  	  <label for="title" class="control-label">Event Title:</label>
		  	  <input type="text" name="title" class="form-control" id="title" placeholder="Title" autofocus />
		  	  <br>
		  	  <label for="color" class="control-label">Color:</label> <small class="text-muted">(Optional)</small>
		  	  <select name="color" class="form-control" id="color">
		  	  	<option value="">Choose</option>
		  	  	<option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
				<option style="color:#66b2b2;" value="#66b2b2">&#9724; Teal</option>
				<option style="color:#008000;" value="#008000">&#9724; Green</option>	
				<option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
				<option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
				<option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
				<option style="color:#000;" value="#000">&#9724; Black</option>
			  </select>
			</div>
		  </div>
		  <div class="col-lg-6">
		  	<div class="form-group">
		  	  <label for="start" class="control-label">Start:</label>
			  <div class="input-group date">
	            <input type="text" class="form-control" id="start" name="start" />
	            <span class="input-group-addon">
	              <span class="fa fa-calendar"></span>
	            </span>
		      </div>
		      <br>
			  <label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="category" value="public" id="public"><span class="lbl"></span> Public Event</label>
		    </div>
		  </div>
		  <div class="col-lg-1"></div>
	      <div class="col-lg-6">
	      	<div class="form-group">
				<label for="end" class="control-label">End:</label>
				<div class="input-group date">
		            <input type="text" class="form-control" id="end" name="end" />
		            <span class="input-group-addon">
		              <span class="fa fa-calendar"></span>
		            </span>
		        </div>
		        <br>
			  <label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="category" value="private" id="private"><span class="lbl"></span> Private Event</label>
		    </div>	
		  </div>
	  	</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  <button type="submit" class="btn btn-success" id="submitButton">Add Event</button>
		</div>
	  </div>
	</form>
  </div>
</div>	
	
<!-- Edit Event Modal -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	<form id="updateEvent" method="POST">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <h4 class="modal-title" id="myModalLabel">Edit Event</h4>
	  	</div>
	  	<div class="modal-body row">		
		  <div class="container-fluid">
		  	<div class="form-group">
		  	  <label for="title" class="control-label">Event Title:</label>
		  	  <input type="text" name="title" class="form-control" id="title" placeholder="Title" autofocus />
		  	  <br>
		  	  <label for="color" class="control-label">Color:</label> <small class="text-muted">(Optional)</small>
		  	  <select name="color" class="form-control" id="color">
		  	  	<option value="">Choose</option>
		  	  	<option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
				<option style="color:#66b2b2;" value="#66b2b2">&#9724; Teal</option>
				<option style="color:#008000;" value="#008000">&#9724; Green</option>	
				<option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
				<option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
				<option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
				<option style="color:#000;" value="#000">&#9724; Black</option>
			  </select>
			</div>
		  </div>
		  <div class="col-lg-6">
		  	<div class="form-group">
		  	  <label for="start" class="control-label">Start:</label>
			  <div class="input-group date">
	            <input type="text" class="form-control" id="startEdit" name="start" />
	            <span class="input-group-addon">
	              <span class="fa fa-calendar"></span>
	            </span>
		      </div>
		      <br>
			  <label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="category" value="public" id="publicEdit"><span class="lbl"></span> Public Event</label>
		    </div>
		  </div>
		  <div class="col-lg-1"></div>
	      <div class="col-lg-6">
	      	<div class="form-group">
			  <label for="end" class="control-label">End:</label>
			  <div class="input-group date">
		        <input type="text" class="form-control" id="endEdit" name="start" />
		          <span class="input-group-addon">
		            <span class="fa fa-calendar"></span>
		          </span>
		      </div>
		      <br>
		      <label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="category" value="private" id="privateEdit"><span class="lbl"></span> Private Event</label>
		  	</div>	
		  </div>		  
		  <input type="hidden" name="id" class="form-control" id="id">			
	  	</div>
	  	<div class="modal-footer">
		  <button type="submit" class="btn btn-primary" id="updateButton">Update Event</button>
		  <button type="button" class="btn btn-danger" id="deleteButton" name="delete">Delete Event</button>
	  	</div>
	  </div>
	</form>
  </div>
</div>

<footer class="footer">
    <div class="container-fluid">
        <p class="text-muted" align="right"><a href="http://lu.edu.ph/" target="_blank">Laguna University</a> &copy; 2017</p>
    </div>
</footer>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/custom.js"></script> 
<!-- jQuery Version 1.11.1 -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- FullCalendar -->
<script src='js/moment.min.js'></script>
<script src="assets/fullcalendar.min.js"></script>

<!-- DAtepicker -->
<script src="../datepicker/js/moment-with-locales.js"></script>
<script src="../datepicker/js/bootstrap-datetimepicker.js"></script>
<!-- Growl -->
<script src="../assets/js/jquery.bootstrap-growl.js"></script>
<?php include 'calendar.php';?>
<script type="text/javascript">
$(window).load(function() {
  $( "#public, #publicEdit" ).on( "click", function() {
  	if ($( "#public, #publicEdit" ).is(':checked')) {
	    $('#private, #privateEdit').attr('disabled', true);
	}
	else {
		$('#private, #privateEdit').attr('disabled', false);
	}
  });
  $( "#private, #privateEdit" ).on( "click", function() {
  	if ($( "#private, #privateEdit" ).is(':checked')) {
	    $('#public, #publicEdit').attr('disabled', true);
	}
	else {
		$('#public, #publicEdit').attr('disabled', false);
	}
  });
});
</script>
</body>
</html>