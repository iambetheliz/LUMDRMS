<?php
include 'includes/dbconnect.php';
include 'SMS/itext.php';

$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];
$color = $_POST['color'];
$category = $_POST['category'];
$prog = $_POST["program_id"];
$year = $_POST["yearLabel"];
$dept = $_POST["dept_id"];

$sql = "INSERT INTO events(title, start, end, color) values ('$title', '$start', '$end', '$color')";
$q = $DB_con->prepare($sql);
$q->execute();

if (!empty($_POST) && $category == 'public') {

  $whereSQL = '';

  if ($_POST['guests'] == 'students') {
  	if ( !empty($prog) && !empty($year) ) {
	      $whereSQL = " AND CONCAT(program = '".$prog."' AND yearLevel = '".$year."') ";
	    }

	$query1 = $DB_con->query("SELECT phone FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE `students`.`status` = 'active' $whereSQL");
  }
  elseif ($_POST['guests'] == 'faculties') {
  	if ( !empty($dept) ) {
      $whereSQL = " AND dept = '".$dept."' ";
    }

	$query1 = $DB_con->query("SELECT phone FROM `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id` WHERE `faculties`.`status` = 'active' $whereSQL");
  }
  else {
  	$query1 = $DB_con->query(" SELECT phone FROM `students` WHERE status = 'active' UNION ALL SELECT phone FROM `faculties` WHERE status = 'active' ");
  }

  $query2 = $DB_con->query("SELECT * FROM events");
  if ($query2->num_rows > 0){
    while($row2 = $query2->fetch_assoc()){
      $datetime = date('F j, Y', strtotime($row2['start'])). " at " .date('g:i a', strtotime($row2['start']));
      $msg = "From: LU Clinic \n\nThis is to inform you that there will be a " .$row2['title']. " on " .$datetime. "\n\nThank you.";
    }   
  }

  while($row = mysqli_fetch_array($query1)){
    if (!empty($row['phone'])){

      $result = itexmo($row['phone'],$msg,"ST-SHAIR374833_X9NKY");
      if ($result == ""){
        echo "<div class='row'><div class='alert alert-danger'>iTexMo: No response from server!!!
        Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
        Please CONTACT US for help.</div></div>";  
      } else if ($result == 0){
        echo "<div class='row'><div class='alert alert-success'>Message Sent!</div></div>";
      }
      else { 
        echo "<div class='row'><div class='alert alert-danger'>Error #". $result . " was encountered! Please try again later</div></div>";
      }
    }   
  }
}

?>