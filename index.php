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
</head>
<body style="background-color: #dbfcd1;">

<!-- Main Screen -->
<div class="container">

	<!-- Login Form -->
    <div class="row">      
      <div class="auth-form well">
    		<table class="table table-borderless">
    			<tr>
    				<td><a href="/lu_clinic"><img class="profile-img" src="images/logo.png" alt=""></a></td>
    				<td><h3 style="padding-bottom: 10px;">Laguna University Clinic</h3></td>
    			</tr>
    		</table>
        <div id="error">
          <!-- error will be shown here ! -->
        </div>
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
            	  <button type="submit" class="btn btn-success btn-block" name="btn-login" id="btn-login">Sign In</button>
              </div>
    	        </fieldset>   
            </form> 
          </div>
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