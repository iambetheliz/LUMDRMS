<?php
  ob_start();
  require_once 'includes/dbconnect.php';
  if(empty($_SESSION)) // if the session not yet started 
   session_start();
  
  // it will never let you open index(login) page if session is set
  if (isset($_SESSION['user'])!="" ) {
    header("Location: dashboard.php");
  exit;
  }

  if (isset($_GET['attempt'])) {
    $errMSG = "You need to login first!";
  }

  $DB_con = new mysqli("localhost", "root", "", "records");

  if ($DB_con->connect_errno) {
    echo "Connect failed: ", $DB_con->connect_error;
  exit();
  }
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="images/favicon.ico">
<link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="assets/style.css" type="text/css" />
<style type="text/css">  
.auth-form {
  margin-top: 60px;
}
.profile-img {
  margin-left: 10px;
  padding-bottom: 10px;
}
a {
  color: #337ab7;
  text-decoration: unset;
  color: green;
}
body {
  background-image: url(images/lu-main.jpg);
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
}
</style>
</head>
<body>

<!-- Main Screen -->
<div class="container">

  <!-- Login Form -->
  <div class="row">      
    <div class="auth-form">

      <div class="well">
        <table>
          <tr>
            <td><a href="/lu_clinic"><img class="profile-img" src="images/logo.png" alt=""></a></td>
            <td align="center"><h3 style="padding-bottom: 10px;">Laguna University Clinic</h3></td>
          </tr>
        </table>
        <?php if(isset($_GET['loginError'])){ 
          echo "<div class='alert alert-danger'>";
          echo "Incorrect username or password!";
          echo "</div>";
        } else if(isset($_GET['attempt'])){ 
          echo "<div class='alert alert-danger'>";
          echo "You need to login first!";
          echo "</div>";
        }  ?>
        <div class="panel panel-default">
          <div class="panel-body">
            <form class="form-signin" id="login-form" method="post" action="login_process.php" autocomplete />
              <fieldset>          
              <div class="form-group">
                <label>Username</label>
                <input type="text" name="name" id="username" class="form-control" maxlength="40" autofocus />
                <small><span class="text-danger" id="name_error"></span></small>
              </div>
            
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="pass" id="password" class="form-control"  maxlength="15" />
                <small><span class="text-danger" id="pass_error"></span></small>
              </div>

              <div class="form-check">
                <label class="checkbox-inline">
                  <input type="checkbox" class="form-check-input" id="chkShow"/>Show Password
                </label>
              </div><br>
            
              <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block" name="btn-login" id="btn-login">Sign In</button>
              </div>
              </fieldset>   
            </form> 
          </div>
        </div>
      </div>

      <div class="alert alert-success">
        <p align="center" style="font-weight: bold;"><a href="http://lu.edu.ph/" target="_blank">Laguna University</a> &copy; 2017</p>
      </div>

    </div>
  </div>
  <!-- End of Login Form -->

</div>
<!-- End of Main Screen -->

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/custom.js"></script>
<script type="text/javascript">
  $('#chkShow').change(function() {
    var isChecked = $(this).prop('checked');
    if (isChecked) {
        $('#password').prop('type', 'text');
    }
    else {
        $('#password').prop('type', 'password');
    }
  });
</script>

</body>
</html>
<?php ob_end_flush(); ?>