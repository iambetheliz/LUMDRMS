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
        <p align="center">DTI-Laguna<br>
        No. 38 Purok, Km. 75, Brgy. Banca-banca<br>
        National Highway, Victoria, Laguna<br>
        Tel. Nos.: (+6349) 559.0151 / 559.0254<br>
        Fax: (+6349) 559.0520<br>
        <span class="style2"><span class="style3">E-mail</span>: dtilaguna@hotmail.com/ R04a.Laguna@dti.gov.ph</span></p>

        <center>
            <button type="button" class="btn btn-primary" value="Print" onClick="javascript:window.print()">Print</button>
        </center>

        <?php
//Include database configuration file
include('includes/dbconnect.php');
include 'includes/date_time_diff.php';
//Include pagination class file
include('includes/Pagination.php');


  $start = !empty($_POST['page'])?$_POST['page']:0;

  //get number of rows
  $queryNum = $DB_con->query("SELECT COUNT(*) as postNum FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id`");
  $resultNum = $queryNum->fetch_assoc();
  $rowCount = $resultNum['postNum'];

  //get rows
  $query = $DB_con->query("SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` ORDER BY date_updated DESC");

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
                <th>Ext.</th>
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
                <td><?php echo get_timeago(strtotime($row['date_registered']));?></td>
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