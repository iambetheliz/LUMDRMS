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
      $facultyNo = $_POST['facultyNo'];
      $FacultyID = $_POST['FacultyID'];

      $identity = 'faculty';

      if (!$error) {        

        if(!empty($_POST['sysRev_list'])) {
          $category = 'sysRev';
          foreach($_POST['sysRev_list'] as $sys_rev) {
            mysqli_query($DB_con,"INSERT INTO tbl_diseases (diseases,category,identity,PatientID) VALUES('$sys_rev','$category','$identity','$FacultyID');");
          }
        }
        if(!empty($_POST['medHis_list'])) {
          $category = 'medHis';
          foreach($_POST['medHis_list'] as $med_his) {
            mysqli_query($DB_con,"INSERT INTO tbl_diseases (diseases,category,identity,PatientID) VALUES('$med_his','$category','$identity','$FacultyID');");
          }
        }

        mysqli_query($DB_con,"START TRANSACTION;");
        mysqli_query($DB_con,"INSERT INTO faculty_med (sysRev,medHis,drinker,smoker,drug_user,mens,duration,dys,weight,height,bmi,bp,cr,rr,temp,gen_sur,skin,heent,lungs,heart,abdomen,extreme,xray,assess,plan,checked_by,facultyNo,FacultyID) VALUES ('$sysRev','$medHis','$drinker','$smoker','$drug_user','$mens','$duration','$dysMe','$weight','$height','$bmi_cat','$bp_val','$cr','$rr','$temp','$gen_sur','$skin','$heent','$lungs','$heart','$abdomen','$extreme','$xray','$assess','$plan','$checked_by','$facultyNo','$FacultyID');");
        mysqli_query($DB_con,"UPDATE faculty_stats SET med='Ok' WHERE facultyNo='$facultyNo';");
        mysqli_query($DB_con,"COMMIT;");

        header('Location: profile.php?FacultyID='.$FacultyID);      

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
      $FacultyID = $_POST['FacultyID'];
      $identity = 'faculty';

      if (!$error) {        

        if(!empty($_POST['sysRev_list'])) {
          $category = 'sysRev';
          foreach($_POST['sysRev_list'] as $sys_rev) {
            mysqli_query($DB_con,"INSERT INTO tbl_diseases (diseases,category,identity,PatientID) VALUES('$sys_rev','$category','$identity','$FacultyID');");
          }
        }

        mysqli_query($DB_con,"INSERT INTO faculty_soap (sysRev,med,weight,height,bmi,bp,cr,rr,temp,assess,plan,checked_by,FacultyID) VALUES ('$sysRev','$med','$weight','$height','$bmi','$bp','$cr','$rr','$temp','$assess','$plan','$checked_by','$FacultyID');");

        header('Location: profile.php?FacultyID='.$FacultyID);      

      } else {
        header("Location: index.php?error");
      }
    }
    else if($_REQUEST['action_type'] == 'save_dental') {

      //checkbox

      $medHis = implode(", ",$_POST['medHis_list']);
      $D18 = $_POST['D18'];
      $D17 = $_POST['D17'];
      $D16 = $_POST['D16'];
      $D15 = $_POST['D15'];
      $D14 = $_POST['D14'];
      $D13 = $_POST['D13'];
      $D12 = $_POST['D12'];
      $D11 = $_POST['D11'];
      $D21 = $_POST['D21'];
      $D22 = $_POST['D22'];
      $D23 = $_POST['D23'];
      $D24 = $_POST['D24'];
      $D25 = $_POST['D25'];
      $D26 = $_POST['D26'];
      $D27 = $_POST['D27'];
      $D28 = $_POST['D28'];
      $D48 = $_POST['D48'];
      $D47 = $_POST['D47'];
      $D46 = $_POST['D46'];
      $D45 = $_POST['D45'];
      $D44 = $_POST['D44'];
      $D43 = $_POST['D43'];
      $D42 = $_POST['D42'];
      $D41 = $_POST['D41'];
      $D31 = $_POST['D31'];
      $D32 = $_POST['D32'];
      $D33 = $_POST['D33'];
      $D34 = $_POST['D34'];
      $D35 = $_POST['D35'];
      $D36 = $_POST['D36'];
      $D37 = $_POST['D37'];
      $D38 = $_POST['D38'];
      $dec_x = $_POST['dec_x'];
      $dec_f = $_POST['dec_f'];
      $missing = $_POST['missing'];
      $filled = $_POST['filled'];
      $per_con = $_POST['per_con'];
      $con_rem1 = $_POST['con_rem1'];
      $con_rem2 = $_POST['con_rem2'];
      $con_rem3 = $_POST['con_rem3'];
      $con_rem4 = $_POST['con_rem4'];
      $con_spec = $_POST['con_spec'];
      $denture = $_POST['denture'];
      $pro_rem1 = $_POST['pro_rem1'];
      $pro_spec1 = $_POST['pro_spec1'];
      $need = $_POST['need'];
      $pro_rem2 = $_POST['pro_rem2'];
      $pro_spec2 = $_POST['pro_spec2'];
      $pro_rem3 = $_POST['pro_rem3'];
      $checked_by = $_POST['checked_by'];
      $facultyNo = $_POST['facultyNo'];
      $FacultyID = $_POST['FacultyID'];

      $identity = 'faculty';

      if (!$error) {        

        if(!empty($_POST['medHis_list'])) {
          $category = 'medHis';
          foreach($_POST['medHis_list'] as $med_his) {
            mysqli_query($DB_con,"INSERT INTO tbl_diseases (diseases,category,identity,PatientID) VALUES('$med_his','$category','$identity','$FacultyID');");
          }
        }

        mysqli_query($DB_con,"START TRANSACTION;");
        mysqli_query($DB_con,"INSERT INTO faculty_den (medHis,D18,D17,D16,D15,D14,D13,D12,D11,D21,D22,D23,D24,D25,D26,D27,D28,D48,D47,D46,D45,D44,D43,D42,D31,D32,D33,D34,D35,D36,D37,D38,dec_x,dec_f,missing,filled,per_con,con_rem1,con_rem2,con_rem3,con_rem4,con_spec,denture,pro_rem1,pro_spec1,need,pro_rem2,pro_spec2,pro_rem3,checked_by,FacultyID) VALUES ('$medHis','$D18','$D17','$D16','$D15','$D14','$D13','$D12','$D11','$D21','$D22','$D23','$D24','$D25','$D26','$D27','$D28','$D48','$D47','$D46','$D45','$D44','$D43','$D42','$D31','$D32','$D33','$D34','$D35','$D36','$D37','$D38','$dec_x','$dec_f','$missing','$filled','$per_con','$con_rem1','$con_rem2','$con_rem3','$con_rem4','$con_spec','$denture','$pro_rem1','$pro_spec1','$need','$pro_rem2','$pro_spec2','$pro_rem3','$checked_by','$FacultyID');");
        mysqli_query($DB_con,"UPDATE faculty_stats SET dent='Ok' WHERE facultyNo='$facultyNo';");
        mysqli_query($DB_con,"COMMIT;");

        header('Location: profile.php?FacultyID='.$FacultyID);      

      } else {
        header("Location: index.php?error");
      }
    }
    else if($_REQUEST['action_type'] == 'save_cert') {

      $rest = $_POST['rest'];
      $resolution = $_POST['resolution'];
      $checked_by = $_POST['checked_by'];
      $FacultyID = $_POST['FacultyID'];

      if (!$error) {  

        mysqli_query($DB_con,"INSERT INTO faculty_cert (rest,resolution,checked_by,FacultyID) VALUES ('$rest','$resolution','$checked_by','$FacultyID');");

        header('Location: profile.php?FacultyID='.$FacultyID);      

      } else {
        header("Location: index.php?error");
      }
    }
  }

?>
<?php ob_end_flush(); ?>