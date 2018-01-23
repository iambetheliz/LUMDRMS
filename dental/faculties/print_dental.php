<?php
include('../../includes/dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Faculty Records | Laguna University - Clinic | Medical Records System</title>
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
      <h4><strong>FACULTY AND STAFFS MEDICAL RECORDS</strong>
      <button type="button" class="btn btn-primary pull-right"  onclick="javascript:window.print()" value="Print"><i class="fa fa-print"></i> Print</button>
      </h4>
    </div>

  <br>
  <div class="row">
    <div class="container-fluid">
      <div class="table-responsive">
        <table class="table  table-striped table-bordered" id="myTable">
          <thead>
            <tr>
              <th>No.</th>
              <th width="100px">Faculty No.</th>
              <th>Current System</th>
              <th>Assessment</th>
              <th>School Nurse</th>   
              <th>Date of Checkup</th>   
            </tr>
          </thead>
          <tbody>            
          <?php
          //Include database configuration file
          include('../../includes/dbconnect.php');
          include '../../includes/date_time_diff.php';
          //Include pagination class file
          include('../../includes/Pagination.php');

          $start = !empty($_POST['page'])?$_POST['page']:0;

          //get number of rows
          $queryNum = $DB_con->query("SELECT COUNT(*) as postNum FROM `faculty_den` JOIN `faculties` ON `faculties`.`FacultyID`=`faculty_den`.`FacultyID` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id`");
          $resultNum = $queryNum->fetch_assoc();
          $rowCount = $resultNum['postNum'];

          //get rows
          $query = $DB_con->query("SELECT * FROM `faculty_den` JOIN `faculties` ON `faculties`.`FacultyID`=`faculty_den`.`FacultyID` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id` ORDER BY last_name ASC");

          if($query->num_rows > 0){ 
            while($row = $query->fetch_assoc()){ 
              $start++; ?>
              <tr id="table-row-<?php echo $row["StatsID"]; ?>">
                <td><?php echo $start;?></td>
                <td><?php echo $row['facultyNo']; ?></td>
                <td><?php echo $row['sysRev'];?></td>
                <td><?php echo $row['assess'];?></td>
                <td><?php echo $row['checked_by'];?></td>
                <td><?php echo date('F j, Y; h:i a', strtotime($row['date_checked_up']));?></td>
              </tr>
              <?php 
            } 
          } else {
              echo "<tr>";
              echo "<td colspan='6'>No record</td>";
              echo "</tr>";
            } ?>
          </tbody>
        </table>
      </div>
      <!-- End of Table Responsive -->
    </div>
    <!-- End of Container Fluid -->
  </div>
  <!-- End of Row -->
  </div>
</div>

</body>
</html>