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
     
      $drinker = $_POST['drinker'];
      $smoker = $_POST['smoker'];
      $drug_user = $_POST['drug_user'];
      $weight = $_POST['weight'];
      $height = $_POST['height'];
      $bmi = $_POST['bmi'];
      $bp = $_POST['bp'];
      $cr = $_POST['cr'];
      $rr = $_POST['rr'];
      $t = $_POST['t'];
      $xray = $_POST['xray'];
      $assess = $_POST['assess'];
      $plan = $_POST['plan'];
      $facultyNo = $_POST['facultyNo'];
      $FacultyID = $_POST['FacultyID'];

      if (empty($sysRev)) {
        $sysRev = 'none';
      }
      if (empty($medHis)) {
        $medHis = 'none';
      }

      if (!$error) {

        $sql = "INSERT INTO faculty_med (sysRev,medHis,drinker,smoker,drug_user,weight,height,bmi,bp,cr,rr,t,xray,assess,plan,facultyNo,FacultyID) VALUES ('" . $sysRev . "','". $medHis. "','$drinker','$smoker','$drug_user','$weight','$height','$bmi','$bp','$cr','$rr','$t','$xray','$assess','$plan','$facultyNo','".$FacultyID."')";
        $result = mysqli_query($DB_con,$sql);

        if (!$result) {
          header("Location: index.php?error");
        }
        else{
          header("Location: index.php");
        }
        // show an error message if the query has an error

      } else {
          echo "ERROR: could not prepare SQL statement.";
      }
  }
	elseif($_REQUEST['action_type'] == 'edit'){

		if(!empty($_POST['FacultyID'])){

			  $facultyNo = $_POST['facultyNo'];
  			$last_name = $_POST['last_name'];
  			$first_name = $_POST['first_name'];
  			$middle_name = $_POST['middle_name'];
        $ext = $_POST['ext'];
  			$age = $_POST['age'];
  			$sex = $_POST['sexOption'];
  			$program = $_POST['program'];
  			$sem = $_POST['semOption'];
  			$acadYear = $_POST['acadYear'];
  			$address = $_POST['address'];
  			$cperson = $_POST['cperson'];
  			$cphone = $_POST['cphone'];
  			$tphone = $_POST['tphone'];
        $FacultyID = $_POST['FacultyID'];

        $med = $_POST['med'];
        $dent = $_POST['dent'];

        // if everything is fine, update the record in the database
        if (!$error) {

          $stmt = 'UPDATE `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` SET last_name="'.$last_name.'", first_name="'.$first_name.'", middle_name="'.$middle_name.'", ext="'.$ext.'", age="'.$age.'", sex="'.$sex.'", program="'.$program.'", sem="'.$sem.'", acadYear="'.$acadYear.'", address="'.$address.'", cperson="'.$cperson.'", cphone="'.$cphone.'", tphone="'.$tphone.'", med="'.$med.'", dent="'.$dent.'" WHERE FacultyID="'.$FacultyID.'"';

          if (!$stmt) {
            header("Location: medical_form.php?error");
          }
          elseif (mysqli_query($DB_con,$stmt)) {
            header("Location: index.php?success");
          }
            mysqli_close($DB_con);
        }
        // show an error message if the query has an error
        else {
          echo "ERROR: could not prepare SQL statement.";
        }
		}
	}
	elseif($_REQUEST['action_type'] == 'delete'){

		if(!empty($_GET['FacultyID'])){

      if( !$error ) {
        $stmt = $DB_con->prepare("DELETE FROM faculties WHERE FacultyID =?");
        $stmt->bind_param('i', $_GET['FacultyID']);

        if (!$stmt){
            $errMSG = "Something went wrong, try again later..."; 
        } else {
          $stmt->execute();
          header("Location: index.php?deleteSuccess");
        }
      }
    }
    else {
      // if the 'FacultyID' variable isn't set, redirect the user
      header("Location: index.php?deleteError");
    }
	}
}

?>
<?php ob_end_flush(); ?>