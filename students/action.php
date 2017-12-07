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

	if($_REQUEST['action_type'] == 'add'){

  		$studentNo = $_POST['studentNo'];
  		$first_name = $_POST['first_name'];
  		$middle_name = $_POST['middle_name'];
      $last_name = $_POST['last_name'];
      $ext = $_POST['ext'];
  		$age = $_POST['age'];
  		$sex = $_POST['sexOption'];
  		$program = $_POST['program'];
  		$yearLevel = $_POST['yearLevel'];
  		$sem = $_POST['semOption'];
  		$acadYear = $_POST['acadYear'];
  		$address = $_POST['address'];
  		$cperson = $_POST['cperson'];
  		$cphone = $_POST['cphone'];

  		if (empty($cphone)) {
  			$cphone = 'none';
  		}

      $med = 'Pending';
      $dent = 'Pending';

      //Validations
      if (strlen($studentNo) < 8) {
        $error = true;
        header("Location: new_student.php?error");
      }
      else {
        $query = "SELECT studentNo FROM students WHERE studentNo='$studentNo'";
        $result = $DB_con->query($query);

        if($result->num_rows != 0){
          $error = true;
          header("Location: new_student.php?error");
        }
      }

      // if there's no error, continue to signup
  		if( !$error ) {

        $query1 = "INSERT INTO students(studentNo,first_name,middle_name,last_name,ext,age,sex,program,yearLevel,sem,acadYear,address,cperson,cphone) VALUES('$studentNo','$first_name','$middle_name','$last_name','$ext','$age','$sex','$program','$yearLevel','$sem','$acadYear','$address','$cperson','$cphone')";
        $query3 = "INSERT INTO students_stats(med,dent,studentNo) VALUES('$med','$dent','$studentNo')";

  			$stmt1 = $DB_con->prepare($query1);
        $stmt3 = $DB_con->prepare($query3);

   			$stmt1->bind_param($studentNo,$first_name,$middle_name,$last_name,$ext,$age,$sex,$program,$yearLevel,$sem,$acadYear,$address,$cperson,$cphone);
        $stmt3->bind_param($med,$dent);

   			if (!$stmt1 || !$stmt3){
          header("Location: add_student.php?error");
   			} else {
          BEGIN;
      			$stmt1->execute();
            $stmt3->execute();
          $stmt1->close();
          $stmt3->close();
          COMMIT;
        		header("Location: index.php?success");
  			} 
  		}
	}
  elseif($_REQUEST['action_type'] == 'save'){

      //checkbox
      $sysRev = implode(', ', $_POST['sysRev_list']);
      $medHis = implode(', ', $_POST['medHis_list']);
     
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
	elseif($_REQUEST['action_type'] == 'edit'){

    if(!empty($_POST['StudentID'])){

        $studentNo = $_POST['studentNo'];
        $last_name = $_POST['last_name'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $ext = $_POST['ext'];
        $age = $_POST['age'];
        $sex = $_POST['sex'];
        $dept = $_POST['dept'];
        $program = $_POST['program'];
        $sem = $_POST['sem'];
        $acadYear = $_POST['acadYear'];
        $address = $_POST['address'];
        $cperson = $_POST['cperson'];
        $cphone = $_POST['cphone'];
        $StudentID = $_POST['StudentID'];

        $med = $_POST['med'];
        $dent = $_POST['dent'];

        // if everything is fine, update the record in the database
        if (!$error) {

          $stmt = 'UPDATE `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` SET last_name="'.$last_name.'", first_name="'.$first_name.'", middle_name="'.$middle_name.'", ext="'.$ext.'", age="'.$age.'", sex="'.$sex.'", dept="'.$dept.'", program="'.$program.'", sem="'.$sem.'", acadYear="'.$acadYear.'", address="'.$address.'", cperson="'.$cperson.'", cphone="'.$cphone.'", med="'.$med.'", dent="'.$dent.'" WHERE StudentID="'.$StudentID.'"';

          if (!$stmt) {
            header("Location: edit_student.php?error");
          }
          elseif (mysqli_query($DB_con,$stmt)) {
            header("Location: /lu_clinic/students/");
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

		if(!empty($_GET['StudentID'])){

      if( !$error ) {
        $stmt = $DB_con->prepare("DELETE FROM students WHERE StudentID =?");
        $stmt->bind_param('i', $_GET['StudentID']);

        if (!$stmt){
            $errMSG = "Something went wrong, try again later..."; 
        } else {
          $stmt->execute();
          header("Location: index.php?deleteSuccess");
        }
      }
    }
    else {
      // if the 'StudentID' variable isn't set, redirect the user
      header("Location: index.php?deleteError");
    }
	}
}

?>
<?php ob_end_flush(); ?>