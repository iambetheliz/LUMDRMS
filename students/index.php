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
    $account = '<a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;'. ucwords($userRow['userName']).'&nbsp;&nbsp;<b class="caret"></b></a>';
    $logout = '<a href="logout.php?logout"><i class="glyphicon glyphicon-off">'.'</i>&nbsp;&nbsp;Logout</a>';
  } else{
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
<title>Student Records | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/style.css" rel="stylesheet" type="text/css">
<style type="text/css"> 
#user_form input.error {
  border:1px solid red;
}
#user_form select.error {
  border:1px solid red;
}
#user_form textarea.error {
  border:1px solid red;
}
#user_form span.error {
  color: red;
}
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
            <ul class="sidebar-nav" role="menu">                    
                <li>
                    <a href="/lu_clinic"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp; Dashboard</a>
                </li>
                <li>
                    <a href="/lu_clinic/calendar/"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp; Activities</a>
                </li>
                <li class="active have-child" role="presentation">
                    <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><i class="fa fa-table" aria-hidden="true"></i>&nbsp;&nbsp; Records &nbsp;&nbsp;<span class="caret"></span></a>
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

	    <!-- Begin Main Screen -->
        <div id="page-content-wrapper">
          <div class="page-content">
            <div class="container-fluid">   

    	        <!-- Page Heading -->
                <div class="row">
                    <div class="container-fluid">
                        <h1 class="page-header">Students Records <small class="text-muted text-success pull-right" id="message"><?php  echo $successMSG; echo $errorMSG; ?></small></h1>
                    </div>
                </div>
                <!-- End of Page Heading -->
                
                <!-- Buttons -->
                <div class="container-fluid">
                  <div class="row">
                    <!-- Start btn-toolbar -->
                	  <div class="btn-toolbar">
            			    <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success">Add New</button>

                      <div class="btn-group filter pull-right">
                        <span class="fa fa-filter"></span>
                        <input type="text" class="form-control" id="keywords" placeholder="Type something to filter data" onkeyup="searchFilter()"/>
                      </div>

                      <div class="btn-group sort">
                        <select id="sortBy" class="form-control" onchange="searchFilter()" style="cursor: pointer;">
                          <option value="">Sort By:</option>
                          <option value="asc">Ascending</option>
                          <option value="desc">Descending</option>
                        </select>
                      </div>
                    </div>
                    <!-- End btn-toolbar -->
                  </div>
            	  </div>
                <br>
                <!-- End of Buttons -->
				      
                <div id="overlay" align="center">
                  <div>
                    <img src="../includes/loading.gif" width="64px" height="64px"/>
                  </div>
                </div>
				        <div id="userTable">
                  <!--
                    This is where data will be shown.
                  -->
                </div>

              </div>  
            </div>
          </div>
          <!-- End of Main Screen -->
  
        </div>
        <!-- End of Content -->

        <!-- Modal HTML -->    
        <div id="userModal" class="modal fade">
        <div class="modal-dialog">
          <form method="post" id="user_form" autocomplete>
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Student
                  <span id="msg" class="error pull-right"></span>
                </h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-3">
                    <div class="form-group"> 
                      <label for="studentNo">Student No.: </label> <span class="error pull-right" id="errSN"><?php echo $errorMSG; ?></span>
                      <input type="text" class="form-control required" placeholder="000-0000" name="studentNo" id="studentNo" autofocus="on">
                      <br>
                      <label for="first_name">First Name: </label> <span class="error pull-right" id="errFirst"></span>
                      <input type="text" class="form-control required" placeholder="Juan" name="first_name" id="first_name">
                      <br>                        
                      <label for="inlineFormInput">Middle Name: </label> <span class="error pull-right" id="errMid"></span>
                      <input type="text" class="form-control required" placeholder="Magdayao" name="middle_name" id="middle_name">
                      <br>
                      <label for="inlineFormInput">Last Name: </label> <span class="error pull-right" id="errLast"></span>
                      <input type="text" class="form-control required" placeholder="Dela Cruz" name="last_name" id="last_name">
                      <br>
                      <label>Extension Name: </label> <small class="text-muted pull-right">(leave if none)</small> <span class="error pull-right" id="errExt"></span>
                      <input type="text" class="form-control" placeholder="Jr" name="ext" maxlength="3" id="ext">
                    </div>
                  </div>
                  <div class="col-2"></div>
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label class="col-2">Age</label> <span class="error pull-right" id="errAge"></span>
                      <input class="form-control" type="text" placeholder="00" name="age" id="age">
                      <br>
                      <label for="example-date-input" class="col-2 col-form-label">Gender</label> <span class="error pull-right" id="errSex"></span>
                      <select class="form-control required" name="sex" id="sex">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-2"></div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="col-2 col-form-label">Department</label> <span class="error pull-right" id="errProg"></span>
                      <?php
                        //Include database configuration file
                        include('../includes/dbconnect.php');
                        $DB_con = new mysqli("localhost", "root", "", "records");
    
                        //Get all dept data
                        $query = $DB_con->query("SELECT * FROM department WHERE status = 1 AND cat = 2 ORDER BY dept_name ASC");
    
                        //Count total number of rows
                        $rowCount = $query->num_rows;
                      ?>
                      <select class="form-control required" name="dept" id="dept">
                        <option value="">Select Department</option>
                          <?php
                            if($rowCount > 0){
                              while($row = $query->fetch_assoc()){ 
                                echo '<option value="'.$row['dept_id'].'">'.$row['dept_name'].'</option>';
                              }
                            } else{
                                echo '<option value="">Department not available</option>';
                            }
                          ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Program</label>                            
                      <select class="form-control required" name="program" id="program">
                        <option value="">Select department first</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-2"></div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="example-date-input" class="col-2 col-form-label">Year</label> <span class="error pull-right" id="errLevel"></span>
                      <select class="form-control required" name="yearLevel" id="yearLevel">
                        <option value="">Select</option>
                        <option value="1st">1st Year</option>
                        <option value="2nd">2nd Year</option>
                        <option value="3rd">3rd Year</option>
                        <option value="4th">4th Year</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-2"></div>
                  <div class="col-lg-2"> 
                    <div class="form-group">
                      <label for="example-date-input" class="col-2 col-form-label">Semester</label> <span class="error pull-right" id="errSem"></span>
                      <select class="form-control required" name="sem" id="sem">
                        <option value="">Select</option>
                        <option value="1st">1st</option>
                        <option value="2nd">2nd</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-2"></div>
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label for="example-date-input" class="col-2 col-form-label">Academic Year</label> <span class="error pull-right" id="errYear"></span>
                      <?php
                        $currently_selected = date('Y'); 
                        $earliest_year = 2006; 
                        $latest_year = date('Y');
                      ?>
                      <select class="form-control required" name="acadYear" id="acadYear">
                        <option value="">Select</option>
                        <?php 
                          foreach ( range( $latest_year, $earliest_year ) as $i ) {
                            print '<option value="'.$i.' - '.++$i.'"'.(--$i === $currently_selected ? 'selected="selected"' : '').'>'.$i.' - '.++$i.'';
                            print '</option>';
                              }
                        ?> 
                      </select>
                    </div>
                  </div>
                  <div class="col-2"></div>
                  <div class="col-lg-8">
                    <hr>
                  </div>
                  <div class="col-2"></div>
                  <div class="col-lg-9">
                    <div class="form-group">
                      <label for="example-date-input" class="col-2 col-form-label">Address</label> <span class="error pull-right" id="errAdd"></span>
                      <textarea class="form-control" name="address" id="address" style="height: 80px;"></textarea>
                    </div>
                  </div>
                  <div class="col-2"></div>
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label for="example-date-input" class="col-2 col-form-label">Contact Person in case of Emergency</label> <span class="error pull-right" id="errPer"></span>
                      <input type="text" class="form-control required" name="cperson" id="cperson">
                    </div>
                  </div>
                  <div class="col-lg-1"></div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="example-date-input" class="col-2 col-form-label">Cellphone/Telephone No.</label> <span class="error pull-right" id="errTel"></span>
                      <input type="text" name="cphone" id="cphone" class="form-control required" placeholder="09358306457">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">       
              	<input type="hidden" name="med" id="med" value="Pending">  
                <input type="hidden" name="dent" id="dent" value="Pending">
                <input type="submit" class="btn btn-primary" id="addnew" name="btn-add" value="Add Record" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- View Modal -->
      <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog"> 
          <form method="post" id="user_form2" autocomplete>
          <div class="modal-content">         
            <div class="modal-header"> 
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
              <h4 class="modal-title">
              <i class="glyphicon glyphicon-cog"></i> Edit Student Information
              </h4> 
            </div>                 
            <div class="modal-body">                     
              <div id="modal-loader" style="display: none; text-align: center;">
                <!-- ajax loader -->
                <img src="../includes/loading.gif">
              </div>                                
              <!-- mysql data will be load here -->                          
              <div id="dynamic-content"></div>
            </div>                             
            <div class="modal-footer"> 
              <input type="submit" class="btn btn-success" id="update" name="btn-edit" value="Update Record"/>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
            </div>                             
          </div> 
        </form>
        </div>
      </div>

    <footer class="footer">
      <div class="container-fluid">
        <p class="text-muted" align="right"><a href="http://lu.edu.ph/" target="_blank">Laguna University</a> &copy; <script type="text/javascript">document.write(new Date().getFullYear());</script></p>
      </div>
    </footer>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/custom.js"></script> 
<script src="../assets/js/form_validate_custom.js"></script> 
<script src="../assets/js/notify.js"></script> 
<script type = "text/javascript">
	$(document).ready(function(){
    $('#overlay').show();
		$("#userTable").load("show_data1.php");
    $('#overlay').fadeOut('fast');	
		$('#user_form').submit(function() {
			return false;
			$.ajaxSetup ({
        cache: false
    	});
        $("#user_form")[0].reset();
        $('#addnew').val();
        $('#userModal').modal('hide'); 
		});
    $('#user_form2').submit(function() {
      return false;
      $.ajaxSetup ({
        cache: false
      });
        $("#user_form2")[0].reset();
        $('#addnew').val();
        $('#view-modal').modal('hide'); 
    });
  	//Select courses            
    $('#dept').on('change',function(){
      var deptID = $(this).val();
      if(deptID){
        $.ajax({
          type:'POST',
          url:'courses.php',
          data:'dept_id='+deptID,
          success:function(html){
            $('#program').html(html); 
          }
        }); 
      } else {
        $('#program').html('<option value="">Select departmentt first</option>');
      }
    });
		//Add New
		$(document).on('click', '#addnew', function(){
			if($('.required').val() == "")  {  
        $("#msg").html("* Required Fields!").show();
        $(".required").addClass('error');
        $("#studentNo").focus();
          return false; 
      }
      else if($('#first_name').val() == "")  {  
        $("#msg").html("Please enter your first name!").show();
        $("#first_name").addClass('error');
        $("#first_name").focus();
          return false; 
      }
      else if($('#last_name').val() == "")  {  
        $("#msg").html("Please enter your last name!").show();
        $("#last_name").addClass('error');
        $("#last_name").focus();
          return false; 
      }  
      else if($('#sex').val() == "")  {  
        $("#msg").html("Please select your gender!").show();
        $("#sex").addClass('error');
        $("#sex").focus();
          return false; 
      }
      else if($('#dept').val() == "")  {  
        $("#msg").html("Please select department!").show();
        $("#dept").addClass('error');
        $("#dept").focus();
          return false; 
      }
      else if($('#program').val() == "")  {  
        $("#msg").html("Please select program!").show();
        $("#program").addClass('error');
        $("#program").focus();
          return false; 
      }
      else if($('#yearLevel').val() == "")  {  
        $("#msg").html("Please select your year level!").show();
        $("#yearLevel").addClass('error');
        $("#yearLevel").focus();
          return false; 
      }
      else if($('#sem').val() == "")  {  
        $("#msg").html("Please select semester!").show();
        $("#sem").addClass('error');
        $("#sem").focus();
          return false; 
      }
      else if($('#acadYear').val() == "")  {  
        $("#msg").html("Please select academic year!").show();
        $("#acadYear").addClass('error');
        $("#acadYear").focus();
          return false; 
      }
      else if($('#cperson').val() == "")  {  
        $("#msg").html("Please enter your guardian's name!").show();
        $("#cperson").addClass('error');
        $("#cperson").focus();
          return false; 
      }
      else if($('#cphone').val() == "")  {  
        $("#msg").html("Please enter your contact number!").show();
        $("#cphone").addClass('error');
        $("#cphone").focus();
          return false; 
      }
			else {
			$studentNo = $('#studentNo').val();
			$first_name = $('#first_name').val();
			$middle_name = $('#middle_name').val();
			$last_name = $('#last_name').val();	
			$ext = $('#ext').val();	
			$age = $('#age').val();	
			$sex = $('#sex').val();	
			$dept = $('#dept').val();
			$program = $('#program').val();
			$yearLevel = $('#yearLevel').val();
			$sem = $('#sem').val();
			$acadYear = $('#acadYear').val();
			$address = $('#address').val();
			$cperson = $('#cperson').val();
			$cphone = $('#cphone').val();
			$med = $('#med').val();
			$dent = $('#dent').val();
				$.ajax({
					type: "POST",
					url: "addnew.php",
          cache: false,
					data: {
						studentNo: $studentNo,
						first_name: $first_name,
						middle_name: $middle_name,
						last_name: $last_name,
						ext: $ext,
						age: $age,
						sex: $sex,
						dept: $dept,
						program: $program,
						yearLevel: $yearLevel,
						sem: $sem,
						acadYear: $acadYear,
						address: $address,
						cperson: $cperson,
						cphone: $cphone,
						med: $med,
						dent: $dent,
						studentNo: $studentNo,
						add: 1,
					}, 
          beforeSend:function() {  
            $('#addnew').val("Inserting");  
          },  
					success: function(){
            $('#userModal').modal('hide'); 
            $("#user_form")[0].reset();
            $('#addnew').val("Add New"); 
						$("#userTable").load("show_data1.php");
            $.notify("Data added successfully", "success");
					}
				});
			}
		});
		//Delete
		$(document).on('click', '.delete', function(){
			$StudentID = $(this).val();
			$.ajax({
				type: "POST",
				url: "delete.php",
        cache: false,
				data: {
					StudentID: $StudentID,
					del: 1,
				},
				success: function(){
					$("#userTable").load("show_data1.php");
          $.notify("Data successfully deleted.", "success");
				}
			});
			return false;
		});
    //View
    $(document).on('click', '#getUser', function(e){  
      e.preventDefault();
      var uid = $(this).data('id'); // get id of clicked row
      $('#dynamic-content').html(''); // leave this div blank
      $('#modal-loader').show();      // load ajax loader on button click
      $.ajax({
        url: 'edit_data.php',
        type: 'POST',
        data: 'StudentID='+uid,
        dataType: 'html'
      })
      .done(function(data){
        console.log(data); 
        $('#dynamic-content').html(''); // blank before load.
        $('#dynamic-content').html(data); // load here
        $('#modal-loader').fadeOut('fast');; // hide loader  
      })
      .fail(function(){
        $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        $('#modal-loader').fadeOut('fast');;
      });
    });
    //Update
    $(document).on('click', '#update', function(){
      $.ajax({
        type: "POST",
        url: "update.php",
        cache: false,
        data: $('#user_form2').serialize(), 
        beforeSend:function() {  
          $('#update').val("Updating");  
        },  
        success: function(){
          $('#view-modal').modal('hide'); 
          $("#user_form2")[0].reset();
          $('#update').val("Update Record"); 
          $("#userTable").load("show_data1.php");
          $.notify("Data updated successfully", "success");
        }
      });
    });
  });

</script>
<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: 'show_data.php',
        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
        beforeSend: function () {
            $('#overlay').show();
        },
        success: function (html) {
            $('#userTable').html(html);
            $('#overlay').fadeOut("fast");
        }
    });
}
</script>
</body>
</html>