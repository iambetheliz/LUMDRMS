<?php
require_once '../includes/dbconnect.php';
include '../includes/date_time_diff.php';
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Medical Certificate | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/css/panel-tabs.css" rel="stylesheet" type="text/css">
<link href="../assets/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
  p {
    font-size: 16px;
  }
  @media print {
    .print-content {
      margin-left: 50px;
      margin-right: 50px;
    }
    .signature {      
      max-width: 100%;
      margin-left: 30px;
      margin-right: 30px;
    }
  }
</style>
</head>
<body>

<div class="container">
<div class="row">

<h3 class="page-header" align="center">
<div class="letterhead">
<img src="../images/logo.png" height="100px" align="left" />
<strong>LAGUNA UNIVERSITY</strong><br>
<small style="color: black;">
Laguna Sports Complex, Brgy. Bubukal, Santa Cruz, Laguna<br>
(049) 501-4360 or (049) 576-4359<br>
E-mail: info@lu.edu.ph
</small>
</div>
</h3>

<div class="btn-toolbar" role="toolbar">
<h3 align="center"><strong>MEDICAL CERTIFICATE</strong>
<button type="button" class="btn btn-primary pull-right"  onclick="javascript:window.print()" value="Print"><i class="fa fa-print"></i> Print</button>
</h3>
</div>
<br>

<?php 

if (isset($_GET['StudentID']) && is_numeric($_GET['StudentID']) && $_GET['StudentID'] > 0) {

$StudentID = $_GET['StudentID'];
$res = "SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE StudentID=".$_GET['StudentID'];
$result = $DB_con->query($res);
$row = $result->fetch_array(MYSQLI_BOTH);

$query = mysqli_query($DB_con,"SELECT * FROM `students_med` WHERE StudentID = '$StudentID' AND `date_checked_up` IN (SELECT max(`date_checked_up`) FROM `students_med`)");
$med = $query->fetch_assoc();
if (!empty($med)) {
  $date = date('F j, Y', strtotime($med['date_checked_up']));
  $time = date('h:i a', strtotime($med['date_checked_up']));
}

if(!empty($row)) { ?>

<div class="print-content">
<p><label>Date: </label> <?php echo date('F j, Y');?></p>
<br /><br /><br />
<p>To whom it may concern,</p><br>
<p align="justify">This is to certify that <span style="text-decoration: underline;"><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name']. " ".$row['ext'] ;?></span> was seen and examined on <span style="text-decoration: underline;"><?php echo $date." at ".$time;?></span> due to _________________________________________________ and was found to have <span style="text-decoration: underline;"><?php if (!empty($med['sysRev'])) { echo $med['sysRev']; } else { echo "No current illness."; }?></span> and was physically <?php echo $med['assess'];?> at the time of examination. <?php echo $med['plan'];?></p>
<br><br>
<p><label>Resolution:</label></p>
<p>_____ Return to class</p>
<p>_____ Sent home</p>
<p>_____ To hospital of choice</p>
<p>_____ Other: ______________________</p>
</div>
<br>
<br>
<br>
</div>
<div class="row">
<div class="signature">
<div class="col-lg-6 pull-left">
  <p align="center">__________________________________</p>
  <p align="center"><label>School Nurse</label></p>
</div>
<div class="col-lg-6 pull-right">
  <p align="center">__________________________________</p>
  <p align="center"><label>School Physician</label></p>
</div></div>
<?php }
}
else {
  header("Location: /LUMDRMS/medical/");
}
?>
</div></div>
</body>
</html>
<?php ob_end_flush(); ?>