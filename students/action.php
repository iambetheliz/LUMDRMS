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
        $sysRev = implode(', ', $_POST['sysRev_list']);
        $medHis = implode(', ', $_POST['medHis_list']);

        foreach($_POST['sysRev_list'] as $index => $val){
          echo "sysRev_list[".$index."]=".$val;
        }
       
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

        if (empty($sysRev)) {
          $sysRev = 'none';
        }
        if (empty($medHis)) {
          $medHis = 'none';
        }

        if (!$error) {        

          $sql = "INSERT INTO students_med (sysRev,medHis,drinker,smoker,drug_user,mens,duration,weight,height,bmi,bp,cr,rr,temp,xray,assess,plan,studentNo,StudentID) VALUES ('" . $sysRev . "','". $medHis. "','$drinker','$smoker','$drug_user','$mens','$duration','$weight','$height','$bmi','$bp','$cr','$rr','$temp','$xray','$assess','$plan','$studentNo','".$StudentID."')";
          $result = mysqli_query($DB_con,$sql);

          if (!$result) {
            header("Location: index.php?error");
          }
          else{
            header('Location: profile.php?StudentID='.$StudentID);
          }
          // show an error message if the query has an error        

        } else {
            echo "ERROR: could not prepare SQL statement.";
        }
    }
  }

?>
<?php ob_end_flush(); ?>