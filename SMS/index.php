<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SMS | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/style.css" rel="stylesheet" type="text/css">
<style>
* {
    box-sizing: border-box;
}

input[type=text], select, textarea{
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    resize: vertical;
}

label {
    padding: 12px 12px 12px 0;
    display: inline-block;
}

input[type=button] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: right;
}

input[type=button]:hover {
    background-color: #45a049;
}

.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}

.col-25 {
    float: left;
    width: 25%;
    margin-top: 6px;
}

.col-75 {
    float: left;
    width: 75%;
    margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media (max-width: 600px) {
    .col-25, .col-75, input[type=button] {
        width: 100%;
        margin-top: 0;
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
        <li>
          <a href="/lu_clinic"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp; Dashboard</a>
        </li>
        <li>
          <a href="/lu_clinic/calendar/"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp; Activities</a>
        </li>
        <li role="presentation" class="have-child">
          <a role="menuitem" data-toggle="collapse" href="#demo"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp; Records <i class="fa fa-caret-down"></i></a>
          <ul id="demo" class="panel-collapse collapse">
            <li>
              <a href="/lu_clinic/students/"><span class="fa fa-graduation-cap"></span>&nbsp;&nbsp; Students</a>
            </li>
            <li>
              <a href="/lu_clinic/faculties/"><span class="fa fa-briefcase"></span>&nbsp;&nbsp; Faculty and Staff</a>
            </li>
            <li>
              <a class="med" role="submenuitem" data-toggle="collapse" href="#med"><span class="fa fa-medkit"></span>&nbsp;&nbsp; Medical <i class="fa fa-caret-down"></i></a>
              <ul id="med" class="panel-collapse collapse">
                <li>
                  <a href="/lu_clinic/medical/students/"><span class="fa fa-graduation-cap"></span>&nbsp;&nbsp; Students</a>
                </li>
                <li>
                  <a href="/lu_clinic/medical/faculties/"><span class="fa fa-briefcase"></span>&nbsp;&nbsp; Faculty and Staff</a>
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
                  <a href="/lu_clinic/dental/faculties/"><span class="fa fa-briefcase"></span>&nbsp;&nbsp; Faculty and Staff</a>
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
                  <a href="/lu_clinic/soap/faculties/"><span class="fa fa-briefcase"></span>&nbsp;&nbsp; Faculty and Staff</a>
                </li>
              </ul>
            </li> 
          </ul>
        </li>
        <?php 
          if ($userRow['role'] === 'superadmin') {?>
          <li>
            <a href="/lu_clinic/tbl_users.php"><span class="fa fa-lock"></span>&nbsp;&nbsp; User Accounts</a>
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
              <h1 class="page-header">SMS App</h1>
            </div>
          </div>
          <!-- End of Page Heading -->

          <div class="container-fluid">
            <form id="sms" method="POST">
              <div class="row">
                <div class="col-25">
                  <label for="phone">Phone Number:</label>
                </div>
                <div class="col-75">
                  <input type="text" id="phone" name="phone" placeholder="Enter phone number..">
                </div>
              </div>
              <div class="row">
                <div class="col-25">
                  <label for="subject">Subject</label>
                </div>
                <div class="col-75">
                  <input type="text" name="message[]" placeholder="Enter subject.." />
                </div>
              </div>
              <div class="row">
                <div class="col-25">
                  <label for="message">Message</label>
                </div>
                <div class="col-75">
                  <textarea id="message" maxlength="100" name="message[]" placeholder="Write something.." style="height:200px"></textarea>
                  <span id="chars">100</span> characters remaining
                </div>
              </div>
              <div class="row">
                <input type="button" name="send" id="send" value="Send Message">
              </div>
            </form>
          </div>

        </div>
      </div>
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
<script src="sms.js"></script>
<script type="text/javascript">
var maxLength = 100;
$('textarea').keyup(function() {
  var length = $(this).val().length;
  var length = maxLength-length;
  $('#chars').text(length);
});
</script>

<!-- Growl -->
<script src="../assets/js/jquery.bootstrap-growl.js"></script>

</body>
</html>