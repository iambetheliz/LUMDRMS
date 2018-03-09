<?php

  function fill_program($DB_con) {  
    $prog_out = '';  
    $sql = "SELECT * FROM program";  
    $result = mysqli_query($DB_con, $sql);  
    while($row = mysqli_fetch_array($result))  
    {  
      $prog_out .= '<option value="'.$row["program_id"].'">'.$row["alias"].'</option>';  
    }  
    return $prog_out;  
  }

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student Records | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/style.css" rel="stylesheet" type="text/css">
<link href="../datepicker/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
<style type="text/css">
.col-2 {
  padding-right: 20px;
}
.form-control.error {
  border-color: indianred;
}
label.error {
  color: indianred;
  font-weight: 500;
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
            <a href="/LUMDRMS/"><i class="col-1 fa fa-bar-chart" aria-hidden="true"></i>Dashboard</a>
          </li>
          <li>
            <a href="/LUMDRMS/calendar/"><i class="col-1 fa fa-calendar" aria-hidden="true"></i>Activities</a>
          </li>
          <li class="active">
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
    <div class="container-fluid">  
      <div id="page-content-wrapper">
        
        <!-- Page Heading -->
        <div class="row">
          <h1 class="page-header">Student Records
            <div class="col-lg-4 pull-right">
              <div class="form-group filter">
                <span class="fa fa-filter"></span>
                <input type="text" class="form-control" id="keywords" placeholder="Type something to filter data" onkeyup="searchFilter()"/>
              </div>
            </div>
          </h1>
        </div>
        <!-- End of Page Heading -->

        <div class="row">
          <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <i class="glyphicon glyphicon-info-sign"></i>  <strong>Note!</strong> Select checkboxes if you want to delete multiple record.
          </div>
        </div>

        <!-- Start of Toolbar -->
        <div class="row"> 
          <!-- Start of Control Buttons -->
          <div class="col-lg-4 buttons">
            <div class="btn-toolbar">
              <div class="btn-group" role="group">
                <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success"><i class="fa fa-plus"></i> New</button>
                <a class="btn btn-danger" style="cursor: pointer;" onclick="delete_records();"><i class="glyphicon glyphicon-remove"></i> Multiple</a>
                <a class='btn btn-primary' name='input' type='button' href='print_students.php' style='cursor:pointer;' id='print'><i class="fa fa-print"></i> Print</a>
                <a class='btn btn-primary' name='input' type='button' href='print_students_pending.php' style='cursor:pointer;display: none;' id='pen'><i class="fa fa-print"></i> Print</a>
                <a class='btn btn-primary' name='input' type='button' href='print_students_ok.php' style='cursor:pointer;display: none;' id='ok'><i class="fa fa-print"></i> Print</a>
                <a class="btn btn-warning" type="button" style="cursor: pointer;" onclick="send_sms();"><i class="fa fa-envelope"></i> Send SMS</a> 
              </div>           
            </div>
          </div>
          <!-- End of Control Buttons -->

          <!-- Filter Options -->
          <div class="col-lg-8 filters">
            <div class="btn-toolbar pull-right">
              <div class="btn-group">
                <select class="form-control" id="num_rows" name="num_rows" onchange="searchFilter()" style="cursor: pointer;">
                <?php
                  $numrows_arr = array("5","10","25","50","100","250");
                  foreach($numrows_arr as $nrow){
                    if (isset($_POST['num_rows']) && $_POST['num_rows'] == $nrow){
                      echo '<option value="'.$nrow.'" selected="selected">'.$nrow.'  records</option>';
                    }
                    else {
                      echo '<option value="'.$nrow.'">'.$nrow.' records</option>';
                    }
                  }
                ?>
                </select>
              </div>
              <div class="btn-group">
                <select class="form-control" name="prog_list" id="prog_list" onchange="searchFilter()" style="cursor: pointer;">  
                  <option value="">All Program</option>  
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
              <div class="btn-group">
                <select class="form-control" name="stats" id="stats" onchange="searchFilter()" style="cursor: pointer;">  
                  <option value="">All Status</option>  
                  <option value="Ok">Ok</option>  
                  <option value="Pending">Pending</option>
                </select>
              </div>
              <div class="btn-group">
                <select class="form-control" name="archive" id="archive" onchange="searchFilter()" style="cursor: pointer;">  
                  <option value="active">Show Current</option>
                  <option value="">All Records</option>  
                  <option value="deleted">Deleted Only</option>
                </select>
              </div>                    
            </div>
            <!-- End of Filter Option -->
          </div>
        </div>
        <!-- End of Buttons -->
        <br>
        
        <div class="row">          
          <div id="tbl_students">
            <!--
              This is where data will be shown.
            -->
            <div  align="center">
              <span class="pull-right">
                <strong class="text-success">Total no. of rows: 0</strong>
              </span>
              <br>
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="myTable">
                  <thead>
                    <tr>
                      <th><label class="checkbox-inline"><input type="checkbox" class="select-all form-check-input" /><span class="lbl"></span> </label></th>
                      <th>No.</th>
                      <th>Dental</th>
                      <th>Medical</th>
                      <th width="100px">Last Name</th>
                      <th width="100px">First Name</th>
                      <th>Middle</th>
                      <th>Suffix</th>
                      <th width="110px">Student No.</th>
                      <th>Program</th>
                      <th>Year</th>    
                      <th>Added</th>        
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr id="overlay">
                      <td colspan="13" align="center">
                        <p>Loading records <i class="fa fa-refresh fa-spin"></i></p>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- End of Table Responsive -->
            </div>
          </div>
        </div>  

      </div>
    </div>
    <!-- End of Main Screen -->

  </div>
  <!-- End of Content -->

  <!-- Modal HTML -->    
  <div id="userModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
      <form method="post" id="add_stud">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title"><i class="fa fa-plus"></i> Add New Student <small>(<i class="fa fa-asterisk text-danger"></i> Required fields)</small></h4>
          </div>
          <div class="modal-body">
            <div id="msg"></div>
            <div class="row">                  
              <div class="col-lg-6">
                <div class="form-group"> 
                  <label for="studentNo"><i class="fa fa-asterisk text-danger"></i> Student No.: </label> <span class="error pull-right" id="errSN"></span>
                  <input type="text" class="form-control" placeholder="000-0000" name="studentNo" id="studentNo" autofocus minlength="7" /><span id="result"></span>
                  <br>
                  <label for="first_name"><i class="fa fa-asterisk text-danger"></i> First Name: </label> <span class="error pull-right" id="errFirst"></span>
                  <input type="text" class="form-control" minlength="3" placeholder="Juan" name="first_name" id="first_name">
                  <br>                        
                  <label>Middle Name: </label> <span class="text-muted">(Optional)</span> <span class="error pull-right" id="errMid"></span>
                  <input type="text" class="form-control" minlength="3" placeholder="Magdayao" name="middle_name" id="middle_name">
                  <br>
                  <label><i class="fa fa-asterisk text-danger"></i> Last Name: </label> <span class="error pull-right" id="errLast"></span>
                  <input type="text" class="form-control" placeholder="Dela Cruz" name="last_name" id="last_name" minlength="3">
                  <br>
                  <label>Extension Name: </label> <small class="text-muted pull-right">(leave if none)</small> <span class="error pull-right" id="errExt"></span>
                  <input type="text" class="form-control" placeholder="Jr" name="ext" minlength="2" maxlength="3" id="ext">
                  <br>
                  <label class="col-2">Age: </label> <span class="error pull-right" id="errAge"></span>
                  <input class="form-control" type="text" placeholder="00" name="age" id="age" minlength="2">
                  <br>
                  <label class="col-2 col-form-label"><i class="fa fa-asterisk text-danger"></i> Gender:</label> <span class="error pull-right" id="errSex"></span>
                  <select class="form-control" name="sex" id="sex">
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                  <br>
                  <label for="example-date-input" class="col-2 col-form-label">Address</label> <span class="error pull-right" id="errAdd"></span>
                  <textarea class="form-control" name="address" id="address" style="height: 80px;"></textarea>
                </div>
              </div>
              <div class="col-lg-1"></div>
              <div class="col-lg-5">
                <div class="form-group">
                  <label>Date of Birth:</label> <span class="error pull-right" id="errDOB"></span>
                  <div class="input-group date">
                    <input type="text" class="form-control" name="dob" id="dob" />  
                    <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                    </span>
                  </div>
                  <br>
                  <label>Marital Status:</label> <span class="error pull-right" id="errStat"></span>
                  <select class="form-control" name="civil" id="civil">
                    <option value="">Select</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                  </select>
                  <br>
                  <label class="col-2 col-form-label"><i class="fa fa-asterisk text-danger"></i> Department:</label> <span class="error pull-right" id="errProg"></span>
                  <?php

                    //Get all dept data
                    $query = $DB_con->query("SELECT * FROM department WHERE stat = 1 AND cat = 2 ORDER BY dept_name ASC");

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
                  <label><i class="fa fa-asterisk text-danger"></i> Program:</label>                            
                  <select class="form-control" name="program" id="program">
                    <option value="">Select department first</option>
                  </select>
                  <br>
                  <label for="example-date-input" class="col-2 col-form-label"><i class="fa fa-asterisk text-danger"></i> Year:</label> <span class="error pull-right" id="errLevel"></span>
                  <select class="form-control" name="yearLevel" id="yearLevel">
                    <option value="">Select</option>
                    <option value="1st">1st Year</option>
                    <option value="2nd">2nd Year</option>
                    <option value="3rd">3rd Year</option>
                    <option value="4th">4th Year</option>
                  </select>
                  <br>
                  <label for="example-date-input" class="col-2 col-form-label"><i class="fa fa-asterisk text-danger"></i> Semester:</label> <span class="error pull-right" id="errSem"></span>
                  <select class="form-control" name="sem" id="sem">
                    <option value="">Select</option>
                    <option value="1st">1st</option>
                    <option value="2nd">2nd</option>
                  </select>
                  <br>
                  <label for="example-date-input" class="col-2 col-form-label"><i class="fa fa-asterisk text-danger"></i> Academic Year:</label> <span class="error pull-right" id="errYear"></span>
                  <?php
                    $currently_selected = date('Y'); 
                    $earliest_year = 2006; 
                    $latest_year = date('Y');
                  ?>
                  <select class="form-control" name="acadYear" id="acadYear">
                    <option value="">Select</option>
                    <?php 
                      foreach ( range( $latest_year, $earliest_year ) as $i ) {
                        print '<option value="'.$i.' - '.++$i.'"'.(--$i === $currently_selected ? 'selected="selected"' : '').'>'.$i.' - '.++$i.'';
                        print '</option>';
                          }
                    ?> 
                  </select>
                  <br>
                  <label for="example-date-input" class="col-2 col-form-label">Cellphone No.:</label> <span class="error pull-right" id="errPhone"></span>
                  <input type="text" name="phone" id="phone" class="form-control">
                  <small class="text-muted"><i>(Format: 09xx xxx xxxx)</i></small>
                  <br><br><br>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="example-date-input" class="col-2 col-form-label">Contact Person in case of Emergency:</label> <span class="error pull-right" id="errPer"></span>
                  <input type="text" class="form-control" name="cperson" id="cperson">
                </div>
              </div>
              <div class="col-lg-1"></div>
              <div class="col-lg-5">
                <div class="form-group">
                  <label for="example-date-input" class="col-2 col-form-label">Cellphone No.:</label> <span class="error pull-right" id="errTel"></span>
                  <input type="text" name="cphone" id="cphone" class="form-control">
                  <small class="text-muted"><i>(Format: 09xx xxx xxxx)</i></small>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">   
            <input type="hidden" name="physician" value="<?php echo $userRow['userName'];?>" id="physician">    
            <input type="submit" class="btn btn-primary" id="addnew" name="btn-add" value="Add Record" />
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- View Modal -->
  <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg"> 
      <form method="post" id="edit_stud">
        <div class="modal-content">         
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
            <h4 class="modal-title">
            <i class="fa fa-pencil"></i> Edit Student's Personal Information
            </h4> 
          </div>                 
          <div class="modal-body">                     
            <div id="modal-loader" style="display: none; text-align: center;">
              <!-- ajax loader -->
              <img src="../includes/loading.gif" width="50px">
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

  <!-- Confirm Delete Bulk Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal-confirm">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Confirm Deletion</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete these records?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="modal-btn-yes">Yes</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" id="modal-btn-no">No</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Confirm Delete Single Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="confirm-delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Confirm Deletion</h4>
        </div>
        <div class="modal-body">
          <span class="text-danger">Are you sure you want to delete this record?</span>
          <input type="hidden" name="delete" id="delID">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="modal-btn-yes">Yes</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" id="modal-btn-no">No</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Alert Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal-alert">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header" style="background-color: indianred">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Error!</h4>
        </div>
        <div class="modal-body">
          <p class="text-danger">Please select atleast one (1) checkbox!</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
        </div>
      </div>
    </div>
  </div>

  <!-- SMS Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal-sms">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Send Message</h4>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="recipient-name" class="form-control-label">Sender:</label>
              <input type="text" class="form-control" name="sender" value="From: LU Clinic" id="sender-name" readonly >
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Message:</label>
              <textarea class="form-control" name="message" id="message-text"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="modal-btn-send">Send Message</button>
          <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-btn-cancel">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!--SIngle SMS Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal-sms-single">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Send Message</h4>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="recipient-name" class="form-control-label">Sender:</label>
              <input type="text" class="form-control" name="sender" value="From: LU Clinic" id="sender-name" readonly >
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Message:</label>
              <textarea class="form-control" name="message" id="message-text"></textarea>
              <input type="hidden" name="smsID" id="smsID">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="modal-btn-send" name="send">Send Message</button>
          <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-btn-cancel">Cancel</button>
        </div>
      </div>
    </div>
  </div>

<footer class="footer">
  <div class="container-fluid">
    <p class="text-muted" align="right"><a href="http://lu.edu.ph/" target="_blank">Laguna University</a> &copy; 2017</p>
  </div>
</footer>

</body>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/custom.js"></script> 
<script src="../assets/js/form_validate_custom.js"></script> 
<script src="../assets/js/students_crud.js"></script>
<script src="../assets/js/jquery.validate.min.js"></script>

<!-- Growl -->
<script src="../assets/js/jquery.bootstrap-growl.js"></script>

<!-- DAtepicker -->
<script src="../datepicker/js/moment-with-locales.js"></script>
<script src="../datepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
$('#dob').datetimepicker({
  format:'MM/DD/YYYY',
  useCurrent: false,
  keepOpen: true
});
var popupWindow = null;

function child_open() { 
  popupWindow = window.open('/LUMDRMS/students/printform.php',"_blank","width=1000,directories=no, status=no, menubar=no, scrollbars=no, resizable=no, location=no");
}

$(document).ready(function() {

  if(window.location.href.indexOf('#userModal') != -1) {
    $('#userModal').modal('show');
  }

  $('#stats').on('change',function(){ 
    var stat = $(this).val();
    if (stat == 'Pending') {
      $('#pen').show();
      $('#print').hide();
      $('#ok').hide();
    }
    else if (stat == 'Ok') {
      $('#ok').show();
      $('#pen').hide();
      $('#print').hide();
    }
    else {
      $('#print').show();
      $('#pen').hide();
      $('#ok').hide();
    }
  });

});
</script>
</html>