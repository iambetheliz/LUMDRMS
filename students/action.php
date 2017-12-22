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

  	if($_REQUEST['action_type'] == 'save'){

        //checkbox

        $sysRev = $_POST['sysRev_list'];
        $medHis = $_POST['medHis_list'];
       
        $drinker = $_POST['drinker'];
        $smoker = $_POST['smoker'];
        $drug_user = $_POST['drug_user'];
        $mens = $_POST['mens'];
        $duration = $_POST['duration'];
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $bmi = $_POST['bmi'];
        $bp = $_POST['bp'];
        $cr = $_POST['cr'];
        $rr = $_POST['rr'];
        $temp = $_POST['temp'];
        $xray = $_POST['xray'];
        $assess = $_POST['assess'];
        $plan = $_POST['plan'];
        $studentNo = $_POST['studentNo'];
        $StudentID = $_POST['StudentID'];

        foreach($sysRev as $one_sys){
            $source1 .= $one_sys.", ";
        }
        $sys = substr($source1, 0, -2);

        foreach($medHis as $one_med){
            $source2 .= $one_med.", ";
        }
        $med = substr($source2, 0, -2);

        if (empty($sysRev)) {
          $sys = 'none';
        }
        if (empty($medHis)) {
          $med = 'none';
        }

        if (!$error) {        

          mysqli_multi_query($DB_con,"INSERT INTO students_med (sysRev,medHis,drinker,smoker,drug_user,mens,duration,weight,height,bmi,bp,cr,rr,temp,xray,assess,plan,studentNo,StudentID) VALUES ('$sys','$med','$drinker','$smoker','$drug_user','$mens','$duration','$weight','$height','$bmi','$bp','$cr','$rr','$temp','$xray','$assess','$plan','$studentNo','$StudentID'); INSERT INTO students_stats(med,dent,studentNo) VALUES('$med','$dent','$studentNo');");

          header('Location: profile.php?StudentID='.$StudentID);      

        } else {
          header("Location: index.php?error");
        }
    }
  }

?>
<?php ob_end_flush(); ?>