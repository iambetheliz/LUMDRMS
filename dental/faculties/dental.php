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
<title>Student Information | Laguna University - Clinic | Dental Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/css/panel-tabs.css" rel="stylesheet" type="text/css">
<link href="../assets/style.css" rel="stylesheet" type="text/css">
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
<h3 align="center"><strong>STUDENT'S DENTAL RECORD</strong>
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

if(!empty($row)) { ?>


<table class="table table-bordered">
<thead>
<tr>
<th colspan="3">I. BASIC INFORMATION</th>
<th>Student No.: <?php echo $row['studentNo'];?></th>
</tr>
</thead>
<thead>  
<tr>
<th colspan="4"><strong>A. FULL NAME:</strong></th>
</tr>
</thead>
<tbody>
<tr>
<td><?php echo $row['first_name'] ;?><br>
<span class="text-muted"><small><i>First Name</i></small></span></td>
<td><?php echo $row['middle_name'] ;?><br>
<span class="text-muted"><small><i>Middle Name</i></small></span></td>
<td><?php echo $row['last_name'];?><br>
<span class="text-muted"><small><i>Last Name</i></small></span></td>
<td><?php echo $row['ext'];?><br>
<span class="text-muted"><small><i>Extended Name (e.g. Jr.)</i></small></span></td>
</tr>
<tr>
<td><label>Age:</label></td>
<td><?php echo $row['age'];?> years old</td>
<td><label>Gender:</label></td>
<td><?php echo $row['sex'];?></td>
</tr>
<tr>
<td><label>Date of Birth:</label></td>
<td><?php if (!empty($row['dob'])) echo date('F j, Y', strtotime($row['dob'])) ;?></td>
<td><label>Marital Status:</label></td>
<td><?php echo $row['stat'] ;?></td>
</tr>
<tr>
<td><label>Program:</label></td>
<td><?php echo $row['program_name'];?></td>
<td><label>Year Level:</label></td>
<td><?php echo $row['yearLevel'];?> Year</td>
</tr>
<tr>
<td><label>Semester: </label></td>
<td><?php echo $row['sem'];?> Semester</td>
<td><label>Academic Year:</label></td>
<td><?php echo $row['acadYear'];?></td>
</tr>
</tbody>
<thead>
<tr>
<td colspan="4">B. CONTACT INFORMATION</td>
</tr>
</thead>
<tr>
<td><label>Address:</label></td>
<td colspan="4"><?php echo $row['address'];?></td>
</tr>
<tr>
<td><label>Contact Person:</label></td>
<td><?php echo $row['cperson'];?></td>
<td><label>Cel/Tel No.:</label></td>
<td><?php echo $row['cphone'];?></td>
</tr>
</tbody>
</table>

<?php 
}
$StudentID = $_GET['StudentID'];
$den_res = mysqli_query($DB_con,"SELECT * FROM `students_den` WHERE StudentID = '$StudentID' AND `date_checked` IN (SELECT max(`date_checked`) FROM `students_den`)");

if ($den_res->num_rows != 0) { ?>

<table class="table table-bordered">
<thead>
<tr>
<th colspan="4">II. DENTAL INFORMATION</th>
</tr>
</thead>
<thead>
<th colspan="4">A. MEDICAL HISTORY</th>
</thead>

<?php
// displaying records.
while ($den = $den_res->fetch_assoc()) { ?>

<tbody>
<tr>
<td colspan="4">
<?php 
if (!empty($den['medHis'])) {
echo $den['medHis'];
} 
else {
echo "None";
}?>
</td>
</tr>
</tbody>
<thead>
<tr>
<th colspan="4"><label>B. DENTITION STATUS</label></th>
</tr>
</thead>
<tbody>
<tr>
<td colspan="4">
<table class="table table-bordered" align="center">
  <tr>
    <td><?php echo $den['D18'];?></td>
    <td><?php echo $den['D17'];?></td>
    <td><?php echo $den['D16'];?></td>
    <td><?php echo $den['D15'];?></td>
    <td><?php echo $den['D14'];?></td>
    <td><?php echo $den['D13'];?></td>
    <td><?php echo $den['D12'];?></td>
    <td><?php echo $den['D11'];?></td>
    <td><?php echo $den['D21'];?></td>
    <td><?php echo $den['D22'];?></td>
    <td><?php echo $den['D23'];?></td>
    <td><?php echo $den['D24'];?></td>
    <td><?php echo $den['D25'];?></td>
    <td><?php echo $den['D26'];?></td>
    <td><?php echo $den['D27'];?></td>
    <td><?php echo $den['D28'];?></td>
  </tr>
  <tr>
    <td>18</td>
    <td>17</td>
    <td>16</td>
    <td>15</td>
    <td>14</td>
    <td>13</td>
    <td>12</td>
    <td>11</td>
    <td>21</td>
    <td>22</td>
    <td>23</td>
    <td>24</td>
    <td>25</td>
    <td>26</td>
    <td>27</td>
    <td>28</td>
  </tr>
  <tr>
    <td colspan="16" style="padding-left: 3px; padding-right: 3px;">
    </td>
  </tr>
  <tr>
    <td>48</td>
    <td>47</td>
    <td>46</td>
    <td>45</td>
    <td>44</td>
    <td>43</td>
    <td>42</td>
    <td>41</td>
    <td>31</td>
    <td>32</td>
    <td>33</td>
    <td>34</td>
    <td>35</td>
    <td>36</td>
    <td>37</td>
    <td>38</td>
  </tr>
  <tr>
    <td><?php echo $den['D48'];?></td>
    <td><?php echo $den['D47'];?></td>
    <td><?php echo $den['D46'];?></td>
    <td><?php echo $den['D45'];?></td>
    <td><?php echo $den['D44'];?></td>
    <td><?php echo $den['D43'];?></td>
    <td><?php echo $den['D42'];?></td>
    <td><?php echo $den['D41'];?></td>
    <td><?php echo $den['D31'];?></td>
    <td><?php echo $den['D32'];?></td>
    <td><?php echo $den['D33'];?></td>
    <td><?php echo $den['D34'];?></td>
    <td><?php echo $den['D35'];?></td>
    <td><?php echo $den['D36'];?></td>
    <td><?php echo $den['D37'];?></td>
    <td><?php echo $den['D38'];?></td>
  </tr>
</table>
</td>
<thead>
  <tr>
<th colspan="4"><label>INDEX: DMFT</label></th>
</tr>
</thead>
<tbody>
<tr>
<td rowspan="2">
<label>No. of T/Decayed:</label>
</td>
<td>
<label>X:</label> <?php echo $den['dec_x']; ?>
</td>
<td><label>No. of Missing:</label> <?php echo $den['missing']; ?></td>
</tr>
<tr>
<td><label>F:</label> <?php echo $den['dec_f']; ?></td>
<td><label>No. of Filled:</label> <?php echo $den['filled']; ?></td>
</tr>
</tbody>
<tbody>
<tr>
<td>
<label>Personal Condition:</label> 
<?php echo $den['per_con']; ?> 
</td>
<td rowspan="2">
<label>Dental Prostheses:</label>
</td>
<td>
<label>Denture Wearer: </label>
<?php echo $den['denture']; ?>
</td>
</tr>
<tr>
<td><label>Remarks:</label> <?php echo $den['con_rem1']."".$den['con_rem2']."".$den['con_rem3']."".$den['con_rem4']; ?></td>
<td>
<label>Need for Denture:</label>
<?php echo $den['need']; ?>
</td>
</tr>
</tbody>
<tbody>
</tbody>
</table>
<br>
<br>
<br>
<div class="col-lg-6 pull-left">
<p align="center">________________________________________________</p>
<p align="center"><label>School Nurse</label></p>
</div>
<div class="col-lg-6 pull-right">
<p align="center">________________________________________________</p>
<p align="center"><label>School Physician</label></p>
</div>
<?php }

}
}
            else {
              header("Location: /lu_clinic/students/");
            }
?>


<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/custom.js"></script> 

</body>
</html>
<?php ob_end_flush(); ?>