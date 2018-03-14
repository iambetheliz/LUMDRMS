<?php
  require_once '../includes/dbconnect.php';
  include '../includes/date_time_diff.php';
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Faculty Information | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/css/panel-tabs.css" rel="stylesheet" type="text/css">
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
            <a href="/LUMDRMS/"><i class="col-1 fa fa-bar-chart" aria-hidden="true"></i>Dashboard</a>
          </li>
          <li>
            <a href="/LUMDRMS/calendar/"><i class="col-1 fa fa-calendar" aria-hidden="true"></i>Activities</a>
          </li>
          <li>
            <a href="/LUMDRMS/students/"><i class="col-1 fa fa-graduation-cap" aria-hidden="true"></i>Students</a>
          </li>
          <li class="active">
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
        
    <!-- Start of Main Screen -->
    <div id="page-content-wrapper">
      <div class="page-content">
        <div class="container-fluid">

          <?php 

            if (isset($_GET['FacultyID']) && is_numeric($_GET['FacultyID']) && $_GET['FacultyID'] > 0) {

              $FacultyID = $_GET['FacultyID'];
              $res = "SELECT * FROM `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id` WHERE FacultyID=".$_GET['FacultyID'];
              $result = $DB_con->query($res);
              $row = $result->fetch_array(MYSQLI_BOTH);
           
              if(!empty($row)) { ?>
    
                <!-- Page Heading -->
                <div class="row">
                  <h1 class="page-header">Faculty and Staff Profile 
                    <span class="pull-right text-success" data-toggle="tooltip" title="Student Number" data-placement="left">FN: <?php echo $row['facultyNo'];?></span>
                  </h1>  
                  <ol class="breadcrumb">
                    <li><a href="/LUMDRMS/"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="/LUMDRMS/faculties/">Faculty and Staff</a></li>
                    <li class="current"><em>Profile</em></li>
                  </ol>     
                </div>
                <!-- End of Page Heading -->

                <div class="row">     
                  <!-- Basic Info -->
                  <div class="panel panel-success panel-table">
                    <div class="panel-heading">
                      <div class="panel-title">
                        <strong>BASIC INFORMATION</strong>
                      </div>
                    </div>
                    <div class="panel-body">  
                      <div class="row">   
                        <div class="container-fluid">               
                          <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <td colspan="4"><strong>FULL NAME:</strong></td>
                        </tr>
                        <tr>
                          <td><?php echo $row['first_name'] ;?><br>
                          <span class="text-muted"><small><i>First Name</i></small></span></td>
                          <td><?php echo $row['middle_name'] ;?><br>
                          <span class="text-muted"><small><i>Middle Name</i></small></span></td>
                          <td><?php echo $row['last_name'];?><br>
                            <span class="text-muted"><small><i>Last Name</i></small></span></td>
                          <td><?php echo $row['ext'];?><br>
                            <span class="text-muted"><small><i>Extended Name (e.g. Jr.)</i></small></span></td>
                        </tr>
                        <tr>
                          <td><label>Age:</label></td>
                          <td><?php if (!empty($row['age'])) {
                            echo $row['age']." years old";
                          }?></td>
                          <td><label>Gender:</label></td>
                          <td><?php echo $row['sex'];?></td>
                        </tr>
                        <tr>
                          <td><label>Date of Birth:</label></td>
                          <td><?php if (!empty($row['dob'])) echo date('F j, Y', strtotime($row['dob'])) ;?></td>
                          <td><label>Marital Status:</label></td>
                          <td><?php echo $row['civil'] ;?></td>
                        </tr>
                        <tr>
                          <td><label>Department:</label></td>
                          <td><?php echo $row['dept_name'];?></td>
                          <td><label>Semester: </label></td>
                          <td><?php echo $row['sem'];?> Semester</td>
                        </tr>
                        <tr>
                          <td><label>Academic Year:</label></td>
                          <td><?php echo $row['acadYear'];?></td>
                          <td colspan="2"></td>
                        </tr>
                        <tr>
                          <td><label>Address:</label></td>
                          <td><?php echo $row['address'];?></td>
                          <td><label>Mobile No.:</label></td>
                          <td>
                            <?php echo $row['phone'];
                              if (!empty($row['phone'])) {?>
                                <a class="btn btn-sm" data-id="<?php echo $row['FacultyID']; ?>" data-toggle="modal" data-target="#modal_sms_faculty" id="sendSMS" title="Message" data-placement="right"><i class="fa fa-envelope"></i></a>
                                <?php 
                              }
                            ?>
                          </td>
                        </tr>
                        <tr>
                          <td><label>Contact Person:</label></td>
                          <td><?php echo $row['cperson'];?></td>
                          <td><label>Mobile No.:</label></td>
                          <td>
                            <?php echo $row['cphone']; 
                              if (!empty($row['cphone'])) {?>
                                <a class="btn btn-sm" data-id="<?php echo $row['FacultyID']; ?>" data-toggle="modal" data-target="#modal_sms_parent" id="sendSMSparent" title="Message" data-placement="right"><i class="fa fa-envelope"></i></a>
                                <?php 
                              }
                            ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End of Basic Infor --> 
                </div>

                <div class="row">
                  <div class="panel with-nav-tabs panel-success">
                    <div class="panel-heading">
                      <strong>
                        <ul class="nav nav-tabs panel-title" id="myTab">
                          <li class="active">
                            <a href="#medical" data-toggle="tab">MEDICAL</a>
                          </li>
                          <li>
                            <a href="#dental" data-toggle="tab">DENTAL</a>
                          </li>
                        </ul>
                      </strong>
                    </div>
                    <div class="panel-body">
                      <div class="tab-content">
                        <div class="tab-pane fade in active" id="medical">
                          <?php include 'faculty_med.php';?>
                        </div>
                        <div class="tab-pane fade" id="dental">
                          <?php include 'faculty_den.php';?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <?php 
              }
            }
          ?>
    
        </div>  
      </div>
    </div>
    <!-- End of Main Screen -->

  </div>
  <!-- End of Content -->

<!-- SMS Modal for Student -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal_sms_faculty">
  <div class="modal-dialog">
    <form id="sendSMStoFaculty" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Send Message for Student</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="form-control-label">Sender:</label>
            <input type="text" class="form-control" name="sender" value="From: LU Clinic" id="sender-name" readonly >
          </div>
          <div class="form-group">
            <label for="message" class="form-control-label">Message:</label>
            <textarea class="form-control" name="message" id="message" autofocus></textarea>
          </div>
          <div class="form-group">            
            <input type="hidden" name="recipient" id="recipient" value="faculty">
            <input type="hidden" name="id" id="sms_id">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="modal-btn-send"><i class='fa fa-envelope'></i> Send Message</button>
          <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-btn-cancel">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- SMS Modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal_sms_parent">
  <div class="modal-dialog">
    <form id="sendSMStoParent">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Send Message for Guardian</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="form-control-label">Sender:</label>
            <input type="text" class="form-control" name="sender" value="From: LU Clinic" id="sender-name" readonly >
          </div>
          <div class="form-group">
            <label for="message" class="form-control-label">Message:</label>
            <textarea class="form-control" name="message" id="message"></textarea>
          </div>        
          <div class="form-group">            
            <input type="hidden" name="recipient" id="recipient" value="parent">
            <input type="hidden" name="id" id="sms_id">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="modal-btn-send-parent">Send</button>
          <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-btn-cancel">Cancel</button>
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
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/custom.js"></script> 
<!-- Growl -->
<script src="../assets/js/jquery.bootstrap-growl.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("a[data-toggle='modal'").tooltip();
  $("#modal_sms_faculty #modal-btn-send").val();
  $('#sendSMStoFaculty').submit(function() {
    return false;
    $.ajaxSetup ({
      cache: false
    });
    $("#sendSMStoFaculty")[0].reset();
    $("#message").focus();
    $("#modal_sms_faculty #modal-btn-send").val();
    $('#modal_sms_faculty').modal('hide'); 
  });
  $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
  });
  var activeTab = localStorage.getItem('activeTab');
  if(activeTab){
    $('#myTab a[href="' + activeTab + '"]').tab('show');
  }

  //SMS For Student
  $("#modal_sms_faculty").on('show.bs.modal', function (e) {    
    var uid = $(e.relatedTarget).data('id');
    $("#modal_sms_faculty #sms_id").val(uid);
    $("#modal_sms_faculty #message").focus();
  });

  $("#modal-btn-send").click(function () {
    var id = $("#modal_sms_faculty #sms_id").val();
    var message = $("#modal_sms_faculty #message").val();
    var sender = $("#modal_sms_faculty #sender-name").val();
    var recipient = $("#modal_sms_faculty #recipient").val();
    if (recipient) {
      $.ajax({
        url:'sms.php',
        method:'POST',
        data: 'recipient=faculty&sender='+sender+'&message='+message+'&id='+id,
        beforeSend: function () {
          $("#modal_sms_faculty #modal-btn-send").html("<span class='fa fa-envelope'></span>  Sending message");  
        },
        success : function(response) {    
          if(response=="ok"){
            $.bootstrapGrowl("<span class='fa fa-check'></span> Message sent!", // Messages
              { // options
                type: "success", // info, success, warning and danger
                ele: "body", // parent container
                offset: {
                  from: "top",
                  amount: 20
                },
                align: "right", // right, left or center
                width: 300,
                allow_dismiss: true, // add a close button to the message
                stackup_spacing: 10
              }
            );
            $("#sendSMStoFaculty")[0].reset();
            $("#modal_sms_faculty #modal-btn-send").val();
          }
          else {
            $.bootstrapGrowl("<i class='fa fa-info'></i> "+response, { // Messages
              // options
              type: "danger", // info, success, warning and danger
              ele: "body", // parent container
              offset: {
                from: "top",
                amount: 20
              },
              align: "right", // right, left or center
              width: 300,
              allow_dismiss: true, // add a close button to the message
              stackup_spacing: 10
            });
          }
          $("#modal_sms_faculty").modal('hide');
        }
      });
    }
  });

  //SMS For Guardian
  $("#modal_sms_parent").on('show.bs.modal', function (e) {    
    var uid = $(e.relatedTarget).data('id');
    $("#modal_sms_parent #sms_id").val(uid);
    $("#modal_sms_parent #message").focus();
  });

  $("#modal-btn-send-parent").click(function () {
    var id = $("#modal_sms_parent #sms_id").val();
    var message = $("#modal_sms_parent #message").val();
    var sender = $("#modal_sms_parent #sender-name").val();
    var recipient = $("#modal_sms_parent #recipient").val();
    if (recipient) {
      $.ajax({
        url:'sms.php',
        method:'POST',
        data: 'recipient=parent&sender='+sender+'&message='+message+'&id='+id,
        beforeSend: function () {
          $("#modal-btn-send-parent").html("<span class='fa fa-envelope'></span>  Sending message");  
        },
        success : function(response) {    
          if(response=="ok"){
            $.bootstrapGrowl("<span class='fa fa-check'></span> Message sent!", // Messages
              { // options
                type: "success", // info, success, warning and danger
                ele: "body", // parent container
                offset: {
                  from: "top",
                  amount: 20
                },
                align: "right", // right, left or center
                width: 300,
                allow_dismiss: true, // add a close button to the message
                stackup_spacing: 10
              }
            );
            $("#sendSMStoParent")[0].reset();
            $("#modal-btn-send-parent").val();
          }
          else {
            $.bootstrapGrowl("<i class='fa fa-info'></i> "+response, { // Messages
              // options
              type: "danger", // info, success, warning and danger
              ele: "body", // parent container
              offset: {
                from: "top",
                amount: 20
              },
              align: "right", // right, left or center
              width: 300,
              allow_dismiss: true, // add a close button to the message
              stackup_spacing: 10
            });
          }
          $("#modal_sms_parent").modal('hide');
        }
      });
    }
  });
});
</script>
    
</body>
</html>
<?php ob_end_flush(); ?>