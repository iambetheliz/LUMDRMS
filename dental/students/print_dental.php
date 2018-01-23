<?php
include('../../includes/dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student Records | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../../images/favicon.ico">
<link rel="stylesheet" href="../../assets/fonts/css/font-awesome.min.css">
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="../../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../../assets/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="../../images/logo.png" />
</head>

<body>

<div class="container">
  <div class="row">

    <h3 class="page-header" align="center">
      <div class="letterhead">
        <img src="../../images/logo.png" height="100px" align="left" />
        <strong>LAGUNA UNIVERSITY</strong><br>
        <small style="color: black;">
          Laguna Sports Complex, Brgy. Bubukal, Santa Cruz, Laguna<br>
          (049) 501-4360 or (049) 576-4359<br>
          E-mail: info@lu.edu.ph
        </small>
      </div>
    </h3>

    <div class="btn-toolbar" role="toolbar">
      <h4><strong>STUDENT RECORDS</strong>
      <button type="button" class="btn btn-primary pull-right"  onclick="javascript:window.print()" value="Print"><i class="fa fa-print"></i> Print</button>
      </h4>
    </div>

<?php
//Include database configuration file
include('../../includes/dbconnect.php');
include '../../includes/date_time_diff.php';
//Include pagination class file
include('../../includes/Pagination.php');


  $start = !empty($_POST['page'])?$_POST['page']:0;

  //get number of rows
  $queryNum = $DB_con->query("SELECT COUNT(*) as postNum FROM `students_den` JOIN `students` ON `students`.`StudentID`=`students_den`.`StudentID` JOIN `program` ON `students`.`program`=`program`.`program_id`");
  $resultNum = $queryNum->fetch_assoc();
  $rowCount = $resultNum['postNum'];

  //get rows
  $query = $DB_con->query("SELECT * FROM `students_den` JOIN `students` ON `students`.`StudentID`=`students_den`.`StudentID` JOIN `program` ON `students`.`program`=`program`.`program_id` ORDER BY last_name ASC");

  if($query->num_rows > 0){ ?>
  <br>
  <div class="row">
    <div class="container-fluid">
      <div class="table-responsive">
        <table class="table  table-striped table-bordered" id="myTable">
          <thead>
            <tr>
              <th>No.</th>      
              <th width="100px">Student No.</th>
              <th colspan="2">Diagnosis</th>
              <th>School Nurse</th>   
              <th>Date of Checkup</th>        
            </tr>
          </thead>
          <tbody>
          <?php
            while($row = $query->fetch_assoc()){ 
            $start++; ?>
            <tr id="table-row-<?php echo $row["StatsID"]; ?>">
              <td><?php echo $start;?></td>
              <td><?php echo $row['studentNo']; ?></td>
              <td><?php echo $row['per_con'];?></td>
              <td><?php echo $row['con_rem1']."".$row['con_rem2']."".$row['con_rem3']."".$row['con_rem4'];?></td>
              <td><?php echo $row['checked_by'];?></td>
              <td><?php echo date('F j, Y; h:i a', strtotime($row['date_checked']));?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- End of Table Responsive -->
    </div>
    <!-- End of Container Fluid -->
  </div>
  <!-- End of Row -->
  <?php  
  } 
?>
    </div>
</div>

</body>
</html>