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
<!-- Custom CSS -->
<style>
#calendar {
	max-width: 1200px;
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
            <a href="/lu_clinic"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp; Dashboard</a>
        </li>
        <li class="active">
            <a href="/lu_clinic/calendar/"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp; Activities</a>
        </li>
        <li role="presentation" class="have-child">
          <a role="menuitem" data-toggle="collapse" href="#demo"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp; Records <i class="fa fa-caret-down"></i></a>
          <ul id="demo" class="panel-collapse collapse">
            <li>
              <a href="/lu_clinic/students/"><span class="fa fa-graduation-cap"></span>&nbsp;&nbsp; Students</a>
            </li>
            <li>
              <a href="/lu_clinic/faculties/"><span class="fa fa-briefcase"></span>&nbsp;&nbsp; Faculty and Staffs</a>
            </li>
            <li>
              <a class="med" role="submenuitem" data-toggle="collapse" href="#med"><span class="fa fa-medkit"></span>&nbsp;&nbsp; Medical <i class="fa fa-caret-down"></i></a>
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
              <a class="den" role="submenuitem" data-toggle="collapse" href="#den" data-parent="#accordion"><span class="fa fa-smile-o"></span>&nbsp;&nbsp; Dental <i class="fa fa-caret-down"></i></a>
              <ul id="den" class="panel-collapse collapse">
                <li>
                  <a href="/lu_clinic/dental/students/"><span class="fa fa-graduation-cap"></span>&nbsp;&nbsp; Students</a>
                </li>
                <li>
                  <a href="/lu_clinic/dental/faculties/"><span class="fa fa-briefcase"></span>&nbsp;&nbsp; Faculty and Staffs</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="den" role="submenuitem" data-toggle="collapse" href="#soap" data-parent="#soap"><span class="fa fa-file-text-o"></span>&nbsp;&nbsp; S.O.A.P. <i class="fa fa-caret-down"></i></a>
              <ul id="soap" class="panel-collapse collapse">
                <li>
                  <a href="/lu_clinic/soap/students/"><span class="fa fa-graduation-cap"></span>&nbsp;&nbsp; Students</a>
                </li>
                <li>
                  <a href="/lu_clinic/soap/faculties/"><span class="fa fa-briefcase"></span>&nbsp;&nbsp; Faculty and Staffs</a>
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
            <h1 class="page-header">Calendar Activities <small class="text-muted text-success pull-right" id="message"></small></h1>
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
	<div class="modal-content">
	<form class="form-horizontal" method="POST" action="addEvent.php">
	
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
	<form class="form-horizontal" method="POST" action="editEventTitle.php">
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

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/custom.js"></script> 
<!-- jQuery Version 1.11.1 -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- FullCalendar -->
<script src='js/moment.min.js'></script>
<script src='js/fullcalendar.min.js'></script>

<!-- DAtepicker -->
<script src="../datepicker/js/moment-with-locales.js"></script>
<script src="../datepicker/js/bootstrap-datetimepicker.js"></script>
<!-- Growl -->
<script src="../assets/js/jquery.bootstrap-growl.js"></script>

<script>

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
		 url: 'editEventDate.php',
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
