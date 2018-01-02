<?php
  ob_start();
  require_once '../includes/dbconnect.php';
  if(empty($_SESSION)) // if the session not yet started 
   session_start();
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: ../index.php?attempt");
    exit;
  }

  $DB_con = new mysqli("localhost", "root", "", "records");

  if ($DB_con->connect_errno) {
    echo "Connect failed: ", $DB_con->connect_error;
  exit();
  }

  $error = false;

  if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])) {

  	if($_REQUEST['action_type'] == 'save') {

      //checkbox

      $sysRev = implode(", ",$_POST['sysRev_list']);
      $medHis = implode(", ",$_POST['medHis_list']);
     
      $drinker = $_POST['drinker'];
      $smoker = $_POST['smoker'];
      $drug_user = $_POST['drug_user'];
      $mens = $_POST['mens'];
      $duration = $_POST['duration'];
      $weight = $_POST['weight'];
      $height = $_POST['height'];
      $bmi = $_POST['bmi'];
      $bmi_cat = $_POST['bmi_cat'];
      $bp = $_POST['bp'];
      $cr = $_POST['cr'];
      $rr = $_POST['rr'];
      $temp = $_POST['temp'];
      $xray = $_POST['xray'];
      $assess = $_POST['assess'];
      $plan = $_POST['plan'];
      $studentNo = $_POST['studentNo'];
      $StudentID = $_POST['StudentID'];

      $identity = 'student';

      if (!$error) {        

        if(!empty($_POST['sysRev_list'])) {
          $category = 'sysRev';
          foreach($_POST['sysRev_list'] as $sys_rev) {
            mysqli_query($DB_con,"INSERT INTO tbl_diseases (diseases,category,identity,PatientID) VALUES('$sys_rev','$category','$identity','$StudentID');");
          }
        }
        if(!empty($_POST['medHis_list'])) {
          $category = 'medHis';
          foreach($_POST['medHis_list'] as $med_his) {
            mysqli_query($DB_con,"INSERT INTO tbl_diseases (diseases,category,identity,PatientID) VALUES('$med_his','$category','$identity','$StudentID');");
          }
        }

        mysqli_query($DB_con,"INSERT INTO students_med (sysRev,medHis,drinker,smoker,drug_user,mens,duration,weight,height,bmi,bmi_cat,bp,cr,rr,temp,xray,assess,plan,studentNo,StudentID) VALUES ('$sysRev','$medHis','$drinker','$smoker','$drug_user','$mens','$duration','$weight','$height','$bmi','$bmi_cat','$bp','$cr','$rr','$temp','$xray','$assess','$plan','$studentNo','$StudentID');");

        header('Location: profile.php?StudentID='.$StudentID);      

      } else {
        header("Location: index.php?error");
      }
    }
    else if($_REQUEST['action_type'] == 'save_soap') {

      //checkbox

      $sysRev = implode(", ",$_POST['sysRev_list']);

      $med = $_POST['med'];
      $weight = $_POST['weight'];
      $height = $_POST['height'];
      $bmi = $_POST['bmi'];
      $bmi_cat = $_POST['bmi_cat'];
      $bp = $_POST['bp'];
      $cr = $_POST['cr'];
      $rr = $_POST['rr'];
      $temp = $_POST['temp'];
      $assess = $_POST['assess'];
      $plan = $_POST['plan'];
      $physician = $_POST['physician'];
      $StudentID = $_POST['StudentID'];

      if (!$error) {        

        if(!empty($_POST['sysRev_list'])) {
          $category = 'sysRev';
          foreach($_POST['sysRev_list'] as $sys_rev) {
            mysqli_query($DB_con,"INSERT INTO tbl_diseases (diseases,category,identity,StudentID) VALUES('$sys_rev','$category','$identity','$StudentID');");
          }
        }

        mysqli_query($DB_con,"INSERT INTO students_soap (sysRev,med,weight,height,bmi,bmi_cat,bp,cr,rr,temp,assess,plan,physician,StudentID) VALUES ('$sysRev','$med','$weight','$height','$bmi','$bmi_cat','$bp','$cr','$rr','$temp','$assess','$plan','$physician','$StudentID');");

        header('Location: profile.php?StudentID='.$StudentID);      

      } else {
        header("Location: index.php?error");
      }
    }
  }

?>
<?php ob_end_flush(); ?>