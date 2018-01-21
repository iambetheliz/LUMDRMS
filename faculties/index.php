<?php

  function fill_program($DB_con) {  
    $dept_out = '';  
    $sql = "SELECT * FROM department";  
    $result = mysqli_query($DB_con, $sql);  
    while($row = mysqli_fetch_array($result))  
    {  
      $dept_out .= '<option value="'.$row["dept_id"].'">'.$row["dept_name"].'</option>';  
    }  
    return $dept_out;  
  }

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Faculty and Staffs Records | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/style.css" rel="stylesheet" type="text/css">
<style type="text/css"> 
#add_fac input.error {
  border:1px solid red;
}
#add_fac select.error {
  border:1px solid red;
}
#add_fac span.error {
  color: red;
}
.col-2 {
  padding-right: 20px;
}

@media (min-width: 768px) {
.modal-dialog {
    width: 800px;
    margin: 30px auto;
}}
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
            <a href="/lu_clinic/calendar/"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp; Activities</a>
          </li>
          <li class="active have-child" role="presentation">
            <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp; Records &nbsp;&nbsp;<span class="caret"></span></a>
            <ul id="demo" class="panel-collapse collapse in">
              <li>
                <a href="/lu_clinic/students/"><span class="glyphicon glyphicon-education"></span>&nbsp;&nbsp; Students</a>
              </li>
              <li class="active">
                <a href="/lu_clinic/faculties/"><span class="fa fa-briefcase"></span>&nbsp;&nbsp; Faculty and Staffs</a>
              </li>
              <li>
                <a href="/lu_clinic/medical/"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp; Medical</a>
              </li>
              <li>
                <a href="/lu_clinic/dental/"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; Dental</a>
              </li>
            <li>
              <a href="/lu_clinic/soap/"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; S.O.A.P.</a>
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
              <h1 class="page-header">Faculty and Staff Records</h1>
            </div>
          </div>
          <!-- End of Page Heading -->
            
          <!-- Buttons -->
            <div class="row">
              <!-- Start btn-toolbar -->
              <div class="col-lg-8">
                <div class="btn-toolbar">
                  <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success"><i class="fa fa-plus"></i> Add New</button>

                  <div class="btn-group">
                    <select class="form-control" name="dept_list" id="dept_list" onchange="searchFilter()" style="cursor: pointer;">  
                      <option value="">Show All Department</option>  
                      <?php echo fill_program($DB_con); ?>  
                    </select>
                  </div>

                  <div class="btn-group sort">
                    <select id="sortBy" class="form-control" onchange="searchFilter()" style="cursor: pointer;">
                      <option value="">Sort A-Z</option>
                      <option value="asc">Ascending</option>
                      <option value="desc">Descending</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- End btn-toolbar -->

              <div class="col-lg-4">
                <div class="form-group filter">
                  <span class="fa fa-filter"></span>
                  <input type="text" class="form-control" id="keywords" placeholder="Type something to filter data" onkeyup="searchFilter()"/>
                </div>
              </div>
            </div>
            <!-- End of Buttons -->

          <br>
		
	        <div id="overlay" align="center">
            <div>
              <img src="../includes/loading.gif" width="64px" height="64px"/>
            </div>
          </div>
          <div id="tbl_faculties">
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
      <form method="post" id="add_fac">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Faculty
              <span id="msg" class="error pull-right"></span>
            </h4>
          </div>
          <div class="modal-body">
            <div id="msg"></div>
              <div class="row">                  
                <div class="col-lg-6">
                  <div class="form-group">
                  <label for="facultyNo">Faculty No.: </label> <span class="error pull-right" id="errFN"></span>
                  <input type="text" class="form-control required" placeholder="000-0000" name="facultyNo" id="facultyNo" autofocus="on">
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
                  <br>
                  <label class="col-2">Age</label> <span class="error pull-right" id="errAge"></span>
                  <input class="form-control required" type="text" placeholder="00" name="age" id="age">
                </div>
              </div>
              <div class="col-lg-1"></div>
              <div class="col-lg-5">
                <div class="form-group">
                  <label for="example-date-input" class="col-2 col-form-label">Gender</label> <span class="error pull-right" id="errSex"></span>
                  <select class="form-control required" name="sex" id="sex">
                    <option value="undefined">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                  <br>
                  <label>Date of Birth:</label> <span class="error pull-right" id="errDOB"></span>
                    <div class="input-group date">
                      <input type="text" class="form-control" name="dob" id="dob" />  
                      <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                      </span>
                    </div>
                    <br>
                    <label>Marital Status:</label> <span class="error pull-right" id="errStat"></span>
                    <select class="form-control" name="stat" id="stat">
                      <option value="">Select</option>
                      <option value="Single">Single</option>
                      <option value="Married">Married</option>
                    </select>
                    <br>
                    <label class="col-2 col-form-label">Department</label> 
                    <span class="error pull-right" id="errProg"></span>
                    <?php
                    //Get all dept data
                    $query = $DB_con->query("SELECT * FROM department WHERE status = 1 ORDER BY dept_id ASC");
                    //Count total number of rows
                    $rowCount = $query->num_rows;
                  ?>
                  <select class="form-control" name="dept" id="dept">
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
                  <br>
                  <label for="example-date-input" class="col-2 col-form-label">Semester</label> <span class="error pull-right" id="errSem"></span>
                  <select class="form-control" name="sem" id="sem">
                    <option value="unknown">Select</option>
                    <option value="1st">1st</option>
                    <option value="2nd">2nd</option>
                  </select>
                  <br>
                  <label for="example-date-input" class="col-2 col-form-label">Academic Year</label> <span class="error pull-right" id="errYear"></span>
                    <?php
                      $currently_selected = date('Y'); 
                      $earliest_year = 2006; 
                      $latest_year = date('Y');
                    ?>
                    <select class="form-control" name="acadYear" id="acadYear">
                      <?php 
                        foreach ( range( $latest_year, $earliest_year ) as $i ) {
                          print '<option value="'.$i.' - '.++$i.'"'.(--$i === $currently_selected ? 'selected="selected"' : '').'>'.$i.' - '.++$i.'';
                          print '</option>';
                        }
                      ?> 
                    </select>
                </div>
              </div>

              <div class="container-fluid">
                <div class="form-group">
                  <label for="example-date-input" class="col-2 col-form-label">Address</label> <span class="error pull-right" id="errAdd"></span>
                  <textarea class="form-control" name="address" id="address" style="height: 80px;"></textarea>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="example-date-input" class="col-2 col-form-label">Contact Person in case of Emergency</label> <span class="error pull-right" id="errPer"></span>
                  <input type="text" class="form-control" name="cperson" id="cperson">
                </div>
              </div>
              <div class="col-lg-1"></div>
              <div class="col-lg-5">
                <div class="form-group">
                  <label for="example-date-input" class="col-2 col-form-label">Cellphone/Telephone No.</label> <span class="error pull-right" id="errTel"></span>
                  <input type="text" name="cphone" id="cphone" class="form-control" placeholder="09358306457">
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
      <form method="post" id="edit_fac" autocomplete>
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
      <p class="text-muted" align="right"><a href="http://lu.edu.ph/" target="_blank">Laguna University</a> &copy; 2017</p>
    </div>
  </footer>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/custom.js"></script> 
<script src="../assets/js/form_validate_custom.js"></script> 
<script src="../assets/js/faculty_crud.js"></script>
<!-- Growl -->
<script src="../assets/js/jquery.bootstrap-growl.js"></script>

<!-- DAtepicker -->
<script src="../datepicker/js/moment-with-locales.js"></script>
<script src="../datepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
$('#dob, #dob_edit').datetimepicker({
  format:'MM/DD/YYYY',
  keepOpen: true,
  icons: {
    time: "fa fa-clock-o",
    date: "fa fa-calendar",
    up: "fa fa-arrow-up",
    down: "fa fa-arrow-down"
  }
});
function searchFilter(page_num) {
  page_num = page_num?page_num:0;
  var keywords = $('#keywords').val();
  var sortBy = $('#sortBy').val();
  var dept_id = $('#dept_list').val(); 
  $.ajax({
    type: 'POST',
    url: 'tbl_faculties.php',
    data:{page:page_num,keywords:keywords,sortBy:sortBy,dept_id:dept_id},
    beforeSend: function () {
      $('#overlay').show();
    },
    success: function (data) {
      $('#tbl_faculties').html(data);
      $('#overlay').fadeOut("fast");
    }
  });
}
</script>
</body>
</html>