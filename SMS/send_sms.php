<?php include 'itext.php';

if (!empty($_POST['message'])) {
  $phone = $_POST['phone'];
  $msg = implode("\n\n", $_POST['message'])."\n\n-----\nFrom: LU Clinic";
  $result = itexmo($phone,$msg,"ST-SHAIR374833_X9NKY");
  if ($result == ""){
    echo "iTexMo: No response from server!!!";  
  } else if ($result == 0){
    echo "ok";
  }
  else { 
    echo "Error #". $result . " was encountered! <br/>Please try again later.";
  }
}

?>