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

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: right;
}

input[type=submit]:hover {
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
    .col-25, .col-75, input[type=submit] {
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
        <li class="active have-child" role="presentation">
          <a class="demo" role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><i class="fa fa-table" aria-hidden="true"></i>&nbsp;&nbsp; Records &nbsp;&nbsp;<span class="caret"></span></a>
          <ul id="demo" class="panel-collapse collapse in">
            <li class="active">
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
            <form method="POST" action="send_sms.php">
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
                  <input type="text" name="subject" placeholder="Enter subject.." />
                </div>
              </div>
              <div class="row">
                <div class="col-25">
                  <label for="message">Message</label>
                </div>
                <div class="col-75">
                  <textarea id="message" name="message" placeholder="Write something.." style="height:200px"></textarea>
                </div>
              </div>
              <div class="row">
                <input type="submit" value="Submit">
              </div>
            </form>
          </div>

          </div></div></div></div>

</body>
</html>