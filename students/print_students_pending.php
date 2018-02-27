<?php
  include('../includes/dbconnect.php');
  //Include database configuration file
  include('../includes/dbconnect.php');
  include '../includes/date_time_diff.php';
  //Include pagination class file
  include('../includes/Pagination.php');
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
<style type="text/css">
  .col-lg-5 {
    padding: 0;
  }
  #first, #second, #third, #fourth {
    padding: 0;
  }
</style>
</head>

<body>

<div class="container">
  <div class="page-content-wrapper">

    <div class="row">
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
    </div>

    <div class="row">
      <h4 style="color: red;"><strong>NO MEDICAL RECORD</strong>
        <div class="btn-toolbar pull-right" role="toolbar">
          <button type="button" class="btn btn-primary pull-right"  onclick="javascript:window.print()" value="Print"><i class="fa fa-print"></i> Print</button>
          <a href="/lu_clinic/students/" role="button" class="btn btn-success">Back</a>
        </div>
      </h4>
    </div>

    <div class="row">
      <div class="col-lg-5" id="first">
        <label>1st Year</label>

        <?php
          $start = !empty($_POST['page'])?$_POST['page']:0;

          //get number of rows
          $queryNum = $DB_con->query(" SELECT COUNT(*) as postNum FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE `students`.`status` = 'active' AND CONCAT(med = 'Pending' OR dent = 'Pending') ");
          $resultNum = $queryNum->fetch_assoc();
          $rowCount = $resultNum['postNum'];

          //get rows
          $query = $DB_con->query(" SELECT *, CONCAT(last_name,', ',first_name,', ',middle_name,' ',ext) AS name FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE `students`.`status` = 'active' AND CONCAT(med = 'Pending' OR dent = 'Pending') AND yearLevel = '1st' ORDER BY program_name ASC, last_name ASC ");

          if($query->num_rows > 0){ ?>
            <div class="table-responsive">
              <table class="table  table-striped table-bordered" id="myTable">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Student No.</th>
                    <th>Program</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($row = $query->fetch_assoc()){
                  $start++; ?>
                  <tr>
                    <td><?php echo $start;?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['studentNo']; ?></td>
                    <td><?php echo $row['program_name'];?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- End of Table Responsive -->
            <?php  
          } 
        ?>
      </div>
      <div class="col-lg-2"></div>
      <div class="col-lg-5" id="second">
        <label>2nd Year</label>

        <?php
          $start = !empty($_POST['page'])?$_POST['page']:0;

          //get number of rows
          $queryNum = $DB_con->query(" SELECT COUNT(*) as postNum FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE `students`.`status` = 'active' AND CONCAT(med = 'Pending' OR dent = 'Pending') ");
          $resultNum = $queryNum->fetch_assoc();
          $rowCount = $resultNum['postNum'];

          //get rows
          $query = $DB_con->query(" SELECT *, CONCAT(last_name,', ',first_name,', ',middle_name,' ',ext) AS name FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE `students`.`status` = 'active' AND CONCAT(med = 'Pending' OR dent = 'Pending') AND yearLevel = '2nd' ORDER BY program_name ASC, last_name ASC ");

          if($query->num_rows > 0){ ?>
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="myTable">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Student No.</th>
                    <th>Program</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($row = $query->fetch_assoc()){
                  $start++; ?>
                  <tr>
                    <td><?php echo $start;?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['studentNo']; ?></td>
                    <td><?php echo $row['program_name'];?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- End of Table Responsive -->
            <?php  
          } 
        ?>
      </div>
    </div>
    <br><br>
    <div class="row">
      <div class="col-lg-5" id="third">
        <label>3rd Year</label>

        <?php
          $start = !empty($_POST['page'])?$_POST['page']:0;

          //get number of rows
          $queryNum = $DB_con->query(" SELECT COUNT(*) as postNum FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE `students`.`status` = 'active' AND CONCAT(med = 'Pending' OR dent = 'Pending') ");
          $resultNum = $queryNum->fetch_assoc();
          $rowCount = $resultNum['postNum'];

          //get rows
          $query = $DB_con->query(" SELECT *, CONCAT(last_name,', ',first_name,', ',middle_name,' ',ext) AS name FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE `students`.`status` = 'active' AND CONCAT(med = 'Pending' OR dent = 'Pending') AND yearLevel = '3rd' ORDER BY program_name ASC, last_name ASC ");

          if($query->num_rows > 0){ ?>
            <div class="table-responsive">
              <table class="table  table-striped table-bordered" id="myTable">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Student No.</th>
                    <th>Program</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($row = $query->fetch_assoc()){
                  $start++; ?>
                  <tr>
                    <td><?php echo $start;?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['studentNo']; ?></td>
                    <td><?php echo $row['program_name'];?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- End of Table Responsive -->
            <?php  
          } 
        ?>
      </div>
      <div class="col-lg-2"></div>
      <div class="col-lg-5" id="fourth">
        <label>4th Year</label>

        <?php
          $start = !empty($_POST['page'])?$_POST['page']:0;

          //get number of rows
          $queryNum = $DB_con->query(" SELECT COUNT(*) as postNum FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE `students`.`status` = 'active' AND CONCAT(med = 'Pending' OR dent = 'Pending') ");
          $resultNum = $queryNum->fetch_assoc();
          $rowCount = $resultNum['postNum'];

          //get rows
          $query = $DB_con->query(" SELECT *, CONCAT(last_name,', ',first_name,', ',middle_name,' ',ext) AS name FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE `students`.`status` = 'active' AND CONCAT(med = 'Pending' OR dent = 'Pending') AND yearLevel = '4th' ORDER BY program_name ASC, last_name ASC ");

          if($query->num_rows > 0){ ?>
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="myTable">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Student No.</th>
                    <th>Program</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($row = $query->fetch_assoc()){
                  $start++; ?>
                  <tr>
                    <td><?php echo $start;?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['studentNo']; ?></td>
                    <td><?php echo $row['program_name'];?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- End of Table Responsive -->
            <?php  
          } 
        ?>
      </div>
    </div>
    
  </div>
</div>

<br>
<br>

</body>
</html>