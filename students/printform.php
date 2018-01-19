<?php
include('includes/dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student Records | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="images/favicon.ico">
<link rel="stylesheet" href="assets/fonts/css/font-awesome.min.css">
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="assets/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="images/logo.png" />
</head>

<body>

<div class="row">
    <div class="container">
 
        <h4 align="center">
          <input name="form logo" type="image" class="media-heading" id="form logo" src="images/logo.png" width="48px" align="top" />
        </h4>
        <p align="center">
            <strong>Laguna University Clinic</strong><br>
            Laguna Sports Complex, Sta. Cruz, Laguna
        </p>

        <center>
            <button type="button" class="btn btn-primary" value="Print"  onclick="javascript:window.print()">Print</button>
        </center>

        <?php include 'tbl_students.php'; ?>
    </div>
</div>

</body>
</html>