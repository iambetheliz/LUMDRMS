<?php
include('../includes/dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student Records | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/style.css" rel="stylesheet" type="text/css">
<link href="../assets/print_styles.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="../images/logo.png" />
</head>

<body>

<div class="container">
  <div class="page-content-wrapper">

    <div class="letterhead">
      <h3 class="page-header" align="center">
        <img src="../images/logo.png" height="100px" align="left" />
        <strong>LAGUNA UNIVERSITY</strong><br>
        <small style="color: black;">
          Laguna Sports Complex, Brgy. Bubukal, Santa Cruz, Laguna<br>
          (049) 501-4360 or (049) 576-4359<br>
          E-mail: info@lu.edu.ph
        </small>
      </h3>
    </div>

    <h4 class="title"><strong>STUDENT RECORDS</strong>
    <div class="btn-toolbar pull-right" role="toolbar">
      <div class="btn-group mr-2" role="group" aria-label="First group">
        <button type="button" class="btn btn-primary" onclick="javascript:window.print()" value="Print"><i class="fa fa-print"></i> Print</button>
        <a href="/lu_clinic/students/" role="button" class="btn btn-success">Back</a>
      </div>
    </div>
    </h4>

    <?php
      //Include database configuration file
      include('../includes/dbconnect.php');
      include '../includes/date_time_diff.php';
      //Include pagination class file
      include('../includes/Pagination.php');

      $start = !empty($_POST['page'])?$_POST['page']:0;

      //get number of rows
      $queryNum = $DB_con->query("SELECT COUNT(*) as postNum FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id`");
      $resultNum = $queryNum->fetch_assoc();
      $rowCount = $resultNum['postNum'];

      //get rows
      $query = $DB_con->query("SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` ORDER BY last_name ASC");

      if($query->num_rows > 0){ ?>
        <br>
        <div class="row">
          <div class="container-fluid">
            <div class="table-responsive">
              <table class="table  table-striped table-bordered" id="myTable">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Suffix</th>
                    <th>Student No.</th>
                    <th>Program</th>
                    <th>Year</th>    
                    <th>Date Added</th> 
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($row = $query->fetch_assoc()){
                  $start++; ?>
                  <tr id="table-row-<?php echo $row["StatsID"]; ?>">
                    <td><?php echo $start;?></td>
                    <td contenteditable="true" onBlur="saveToDatabase(this,'last_name','<?php echo $row["StatsID"]; ?>')" onClick="editRow(this);"><?php echo $row['last_name']; ?></td>
                    <td contenteditable="true" onBlur="saveToDatabase(this,'first_name','<?php echo $row["StatsID"]; ?>')" onClick="editRow(this);"><?php echo $row['first_name']; ?></td>
                    <td contenteditable="true" onBlur="saveToDatabase(this,'middle_name','<?php echo $row["StatsID"]; ?>')" onClick="editRow(this);"><?php echo $row['middle_name']; ?></td>
                    <td contenteditable="true" onBlur="saveToDatabase(this,'ext','<?php echo $row["StatsID"]; ?>')" onClick="editRow(this);"><?php echo $row['ext'];?></td>
                    <td contenteditable="true" onBlur="saveToDatabase(this,'studentNo','<?php echo $row["StatsID"]; ?>')" onClick="editRow(this);"><?php echo $row['studentNo']; ?></td>
                    <td><?php echo $row['program_name'];?></td>
                    <td><?php echo $row['yearLevel'];?></td>
                    <td><?php echo date("F m, Y", strtotime($row['date_registered']));?></td>
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