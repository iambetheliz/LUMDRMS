<?php
  ob_start();
  require_once 'includes/dbconnect.php';
  if(empty($_SESSION)) // if the session not yet started 
   session_start();
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: index.php?attempt");
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

  if (isset($_GET['loginSuccess'])) {
    $successMSG = "Hello, <strong>".ucwords($userRow['userName'])."!</strong> You have been signed in successfully!";
  }
    
    //Render facebook profile data
    $output = '';
    if(!empty($userRow)){
        $account = '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;'. ucwords($userRow['userName']).'&nbsp;&nbsp;<b class="caret"></b></a>';
        $logout = '<a href="logout.php?logout"><i class="glyphicon glyphicon-off">'.'</i>&nbsp;&nbsp;Logout</a>';
    }else{
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
<title>Change Password | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="images/favicon.ico">
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="assets/fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="assets/css/dashboard.css" rel="stylesheet" type="text/css">
<link href="assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="assets/style.css" rel="stylesheet" type="text/css">
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
              <a href="/lu_clinic"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp; Dashboard</a>
          </li>
          <li>
              <a href="/lu_clinic/calendar/"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp; Activities</a>
          </li>
          <li role="presentation" class="have-child">
            <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><i class="fa fa-table" aria-hidden="true"></i>&nbsp;&nbsp; Records &nbsp;&nbsp;<span class="caret"></span></a>
            <ul id="demo" class="panel-collapse collapse">
              <li>
                  <a href="/lu_clinic/students/"><span class="glyphicon glyphicon-education"></span>&nbsp;&nbsp; Students</a>
              </li>
              <li>
                  <a href="/lu_clinic/faculties/"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; Faculties</a>
              </li>
            </ul>
          </li>
          <?php 
            if ($userRow['role'] === 'superadmin') {?>
            <li>
              <a href="tbl_users.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; User Accounts</a>
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
                    <h2 class="page-header">Change Password</h2>
                </div>
            </div> 

            <div class="row">
              <div class="container-fluid">
                <div class="alert alert-success"><i class="glyphicon glyphicon-info-sign"></i> Please fill in required fields.</div>
                <form  method="post" id="change_password" class="form-horizontal">
                  <div class="control-group">
                    <label class="control-label">Current Password</label>
                    <div class="controls">
                    <input class="form-control" type="password" id="current_password" name="current_password" autofocus placeholder="Current Password" required/>
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="inputPassword">New Password</label>
                    <div class="controls">
                    <input class="form-control" type="password" id="new_password" name="new_password" placeholder="New Password">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="inputPassword">Re-type Password</label>
                    <div class="controls">
                    <input class="form-control" type="password" id="retype_password" name="retype_password" placeholder="Re-type Password" required/>
                    </div>
                  </div>
                  <br>
                  <div class="control-group">
                    <div class="controls">
                    <button type="submit" class="btn btn-info"><i class="icon-save"></i> Save</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

        </div>  
      </div>
    </div>
    <!-- End of Main Screen -->
  
  </div>
  <!-- End of Content -->

  <footer class="footer">
  <div class="container-fluid">
      <p class="text-muted" align="right"><a href="http://lu.edu.ph/" target="_blank">Laguna University</a> &copy; <?php echo date("Y"); ?></p>
  </div>
</footer>
  
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/custom.js"></script> 
<script src="assets/js/notify.js"></script> 
<script src="http://www.bichlmeier.info/sha256.js"></script>
<script src="http://www.webtoolkit.info/djs/webtoolkit.sha256.js"></script>
<script src="http://crypto-js.googlecode.com/files/2.2.0-crypto-sha256.js"></script>
<script src="http://point-at-infinity.org/jssha256/jssha256.js"></script>
<script src="http://code.alexweber.com.br/jquery/sha256/jquery.sha256.js"></script>
<script src="https://raw.github.com/h2non/jsHashes/master/client/src/hashes.js"></script>
<script src="https://s-static.ak.fbcdn.net/rsrc.php/v2/yy/r/vQZdFsFf84Z.js"></script>

<script>
  $(document).ready(function(){

    $("#change_password").submit(function(e){
      e.preventDefault();
      
      var current_password = $('#current_password').val();
      var new_password = $('#new_password').val();
      var retype_password = $('#retype_password').val();

      if($("#new_password, #retype_password").val().length < 6) {
        $.notify("Passwords must have 6 characters!", "error");
        return false;
      }

      if (new_password != retype_password){
        $.notify("Password does not match with your new password", "error");
        return false;
      } else if (current_password != "" && (new_password == retype_password)){
        var formData = $(this).serialize();
        $.ajax({
          type: "POST",
          url: "update_password.php",
          data: formData,
          success: function(html){ 
            $.notify("Password successfully changed", "success"); 
            var delay = 2000;
            setTimeout(function(){ 
              window.location.href = 'logout.php?logout'  
            }, delay);            
          }  
        });
      }
    });
  });
</script>

</body>
</html>