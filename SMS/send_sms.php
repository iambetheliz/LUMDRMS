<?php include 'itext.php';

if (!empty($_POST['message'])) {
  $phone = $_POST['phone'];
  $msg = implode("\n\n", $_POST['message'])."\n\n-----";
  $result = itexmo($phone,$msg,"TR-ELIZA306457_AUYQD");
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