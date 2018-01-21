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
      $dysMe = implode(" ",$_POST['dys']);
      $weight = $_POST['weight'];
      $height = $_POST['height'];
      $bmi_cat = implode(" ",$_POST['bmi']);
      $bp_val = implode(" ",$_POST['bp']);
      $cr = $_POST['cr'];
      $rr = $_POST['rr'];
      $temp = $_POST['temp'];
      $gen_sur = $_POST['gen_sur'];
      $skin = $_POST['skin'];
      $heent = $_POST['heent'];
      $lungs = $_POST['lungs'];
      $heart = $_POST['heart'];
      $abdomen = $_POST['abdomen'];
      $extreme = $_POST['extreme'];
      $xray = $_POST['xray'];
      $assess = $_POST['assess'];
      $plan = $_POST['plan'];
      $checked_by = $_POST['checked_by'];
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

        mysqli_query($DB_con,"INSERT INTO students_med (sysRev,medHis,drinker,smoker,drug_user,mens,duration,dys,weight,height,bmi,bp,cr,rr,temp,gen_sur,skin,heent,lungs,heart,abdomen,extreme,xray,assess,plan,checked_by,studentNo,StudentID) VALUES ('$sysRev','$medHis','$drinker','$smoker','$drug_user','$mens','$duration','$dysMe','$weight','$height','$bmi_cat','$bp_val','$cr','$rr','$temp','$gen_sur','$skin','$heent','$lungs','$heart','$abdomen','$extreme','$xray','$assess','$plan','$checked_by','$studentNo','$StudentID');");

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
      $checked_by = $_POST['checked_by'];
      $StudentID = $_POST['StudentID'];
      $identity = 'student';

      if (!$error) {        

        if(!empty($_POST['sysRev_list'])) {
          $category = 'sysRev';
          foreach($_POST['sysRev_list'] as $sys_rev) {
            mysqli_query($DB_con,"INSERT INTO tbl_diseases (diseases,category,identity,PatientID) VALUES('$sys_rev','$category','$identity','$StudentID');");
          }
        }

        mysqli_query($DB_con,"INSERT INTO students_soap (sysRev,med,weight,height,bmi,bp,cr,rr,temp,assess,plan,checked_by,StudentID) VALUES ('$sysRev','$med','$weight','$height','$bmi','$bp','$cr','$rr','$temp','$assess','$plan','$checked_by','$StudentID');");

        header('Location: profile.php?StudentID='.$StudentID);      

      } else {
        header("Location: index.php?error");
      }
    }
    else if($_REQUEST['action_type'] == 'save_dental') {

      //checkbox

      $medHis = implode(", ",$_POST['medHis_list']);

      $dec_x = $_POST['dec_x'];
      $dec_f = $_POST['dec_f'];
      $missing = $_POST['missing'];
      $filled = $_POST['filled'];
      $per_con = $_POST['per_con'];
      $con_rem = $_POST['con_rem'];
      $con_spec = $_POST['con_spec'];
      $denture = $_POST['denture'];
      $pro_rem1 = $_POST['pro_rem1'];
      $pro_spec1 = $_POST['pro_spec1'];
      $need = $_POST['need'];
      $pro_rem2 = $_POST['pro_rem2'];
      $pro_spec2 = $_POST['pro_spec2'];
      $pro_rem3 = $_POST['pro_rem3'];
      $checked_by = $_POST['checked_by'];
      $StudentID = $_POST['StudentID'];

      $identity = 'student';

      if (!$error) {        

        if(!empty($_POST['medHis_list'])) {
          $category = 'medHis';
          foreach($_POST['medHis_list'] as $med_his) {
            mysqli_query($DB_con,"INSERT INTO tbl_diseases (diseases,category,identity,PatientID) VALUES('$med_his','$category','$identity','$StudentID');");
          }
        }

        mysqli_query($DB_con,"INSERT INTO students_den (medHis,dec_x,dec_f,missing,filled,per_con,con_rem,con_spec,denture,pro_rem1,pro_spec1,need,pro_rem2,pro_spec2,pro_rem3,checked_by,StudentID) VALUES ('$medHis','$dec_x','$dec_f','$missing','$filled','$per_con','$con_rem','$con_spec','$denture','$pro_rem1','$pro_spec1','$need','$pro_rem2','$pro_spec2','$pro_rem3','$checked_by','$StudentID');");

        header('Location: profile.php?StudentID='.$StudentID);      

      } else {
        header("Location: index.php?error");
      }
    }
    else if($_REQUEST['action_type'] == 'save_cert') {

      $rest = $_POST['rest'];
      $resolution = $_POST['resolution'];
      $checked_by = $_POST['checked_by'];
      $StudentID = $_POST['StudentID'];

      if (!$error) {  

        mysqli_query($DB_con,"INSERT INTO students_cert (rest,resolution,checked_by,StudentID) VALUES ('$rest','$resolution','$checked_by','$StudentID');");

        header('Location: profile.php?StudentID='.$StudentID);      

      } else {
        header("Location: index.php?error");
      }
    }
  }

?>
<?php ob_end_flush(); ?>