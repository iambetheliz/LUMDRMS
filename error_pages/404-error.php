<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="403 Forbidden">
<title>404 Not Found</title>
<link rel="icon" href="../images/favicon.ico">
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css" />
<link href="../assets/style.css" rel="stylesheet" type="text/css" />
<style>
/* Error Page Inline Styles */
#wrapper {
  padding:0;
}
/* Layout */
.jumbotron {
  font-size: 21px;
  font-weight: 200;
  line-height: 2.1428571435;
  color: inherit;
  padding: 10px 0px;
  margin-top: 5%;
}
/* Everything but the jumbotron gets side spacing for mobile-first views */
.masthead, .body-content, {
  padding-left: 15px;
  padding-right: 15px;
}
/* Main marketing message and sign up button */
.jumbotron {
  text-align: center;
  background-color: transparent;
}
.jumbotron .btn {
  padding: 14px 24px;
}
.profile-img {
  width: 200px;
  margin: 0 auto 10px;
  display: block;
  -moz-border-radius: 50%;
  -webkit-border-radius: 50%;
  border-radius: 50%; 
}
</style>
</head>
<body onload="javascript:loadDomain();">

<div id="wrapper">

<!-- Begin Main Screen -->
  <div id="page-content-wrapper">
    <div class="page-content">
      <!-- Error Page Content -->
      <div class="container-fluid">
        <div class="row">
          <div class="jumbotron">
            <h2><i class="fa fa-frown-o text-danger"></i> <strong>File Not Found</strong></h2><hr>
              <p>The link you followed may be broken or the page may have been removed.</p>
              <p><a href="javascript:history.go(-1)" class="btn btn-warning btn-lg">Go back to previous page</a></p>
          </div>
          <div class="center-block">
            <img class="profile-img" src="../images/logo.png" alt="LU logo" />
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
<script src="..assets/js/jquery.min.js"></script>
<script src="..assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
  function loadDomain() {
    var display = document.getElementById("display-domain");
    display.innerHTML = document.domain;
  }
</script>
</body>
</html>