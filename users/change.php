<?php 
  ob_start();
  require_once '../includes/dbconnect.php';
  if(empty($_SESSION)) // if the session not yet started 
   session_start();
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: /lu_clinic/index.php?attempt");
    exit;
  }

  if (isset($_POST['change'])) {
  $curr_pass = (isset($_POST['current_password']) ? $_POST['current_password'] : null);
  $new_pass = (isset($_POST['new_password']) ? $_POST['new_password'] : null);
  $retype_pass = (isset($_POST['retype_password']) ? $_POST['retype_password'] : null);
  
    if ($curr_pass!="" && $new_pass!="" && $retype_pass!="") {
      $res = "SELECT userPass FROM users WHERE userId=".$_SESSION['user'];
      $result = $DB_con->query($res);
      $userRow = $result->fetch_array(MYSQLI_BOTH);
      $old_pwd = $userRow['userPass'];
    
      $curr_pwd = hash('sha256', $curr_pass);
    
      if ($old_pwd == $curr_pwd) {
        //echo $pssw;
        if ($new_pass == $retype_pass) {
          
          $new_pwd = hash('sha256',$new_pass);
   
          mysqli_query($DB_con, "UPDATE users SET userPass='$new_pwd' WHERE userId=".$_SESSION['user']) or die ('cannot connect to the server');

          echo 'ok';
          unset($_SESSION['user']);
          session_unset();
          session_destroy();
          $sql = mysqli_query($DB_con,'UPDATE `users` SET `login_date` = now()');
        }
        else if ($new_pass != $retype_pass) {
          echo "Passwords do not match!";
        }
      }
      else { 
        echo "Your current password is incorrect.";
      } 
    }
  }
?>