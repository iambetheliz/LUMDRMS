<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="403 Forbidden">
<title>500 Internal Error</title>
<link rel="icon" href="images/favicon.ico">
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="assets/fonts/css/font-awesome.min.css">
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="assets/css/simple-sidebar.css" rel="stylesheet" type="text/css" />
<link href="assets/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="assets/errors.css" />
</head>
<body onload="javascript:loadDomain();">

<div id="wrapper">

<!-- Begin Main Screen -->
  <div id="page-content-wrapper">
    <div class="page-content">
      <!-- Error Page Content -->
      <div class="row">
        <div class="container">
          <div class="jumbotron">
            <h2><i class="fa fa-exclamation-triangle text-danger"></i> <strong>Database Connection Error</strong></h2><hr>
            <p>It looks like you are connecting to an unknown database.
            Please contact your system administrator to fix the issue.</p><br>
            <a onclick="javascript:history.go(-1)" class="btn btn-warning btn-lg">Go back to previous page</a>
          </div>
          <div class="center-block">
            <img class="profile-img" src="images/logo.png" alt="LU logo" />
          </div>
        </div>
      </div>
      <!-- End Error Page Content -->
    </div>
  </div>
<!-- End of Mainscreen -->

</div>

<footer class="footer">
  <div class="container-fluid">
    <p align="center">Laguna University &copy; 2017</p>
  </div>
</footer>

<!--Scripts-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
  function loadDomain() {
    var display = document.getElementById("display-domain");
    display.innerHTML = document.domain;
  }
</script>
</body>
</html>