<?php 
  ob_start();
  require_once '../includes/dbconnect.php';
  include '../includes/Class.NumbersToWords.php';
  if(empty($_SESSION)) // if the session not yet started 
   session_start();
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: /lu_clinic/index.php?attempt");
    exit;
  }

  // select loggedin users detail
  $res = "SELECT * FROM users WHERE userId=".$_SESSION['user'];
  $result = $DB_con->query($res);
  $userRow = $result->fetch_array(MYSQLI_BOTH);

  if (isset($_GET['loginSuccess'])) {
    $successMSG = "Hello, <strong>".ucwords($userRow['userName'])."!</strong> You have been signed in successfully!";
  }

?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
      
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" id="menu-toggle" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a style="color: white;" href="/lu_clinic" class="navbar-brand">
        <img src="../images/logo.png" width="35" style="margin-top: -7px;" class="d-inline-block align-top" align="left" alt="">&nbsp;&nbsp;Laguna University - Clinic | Medical Records System
      </a>
    </div>

    <!-- Top Menu Items -->
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="/lu_clinic/SMS/"><i class="fa fa-comment"></i>&nbsp;&nbsp;SMS App</a>
        </li>
        <?php
          if(!empty($userRow)){ ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle"></i>&nbsp;&nbsp;<?php echo $userRow['userName']; ?>&nbsp;&nbsp;<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="/lu_clinic/users/user_profile.php"><i class="fa fa-edit"></i>&nbsp;&nbsp; Edit Profile</a></li>
                <li><a href="/lu_clinic/users/changepswd.php"><i class="fa fa-lock"></i>&nbsp;&nbsp; Change Password</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/lu_clinic/logout.php?logout"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Logout</a></li>
              </ul>
            </li> 
            <?php 
          }
        ?>
      </ul> 
    </div>
        
  </div>
</nav>