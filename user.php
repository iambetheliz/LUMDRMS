<?php
include_once '../db/dbconfig.php';
include('session.php');


if ($acceslevel!="admin") { 
header("location: mainmenu2.php");
} 
?>
 <?php 

//$input = htmlspecialchars($_REQUEST['myname']);
//$input0 = htmlspecialchars($_REQUEST['mybId']);
//$input1 = htmlspecialchars($_REQUEST['myword']);
//$input2 = htmlspecialchars($_REQUEST['mycname']);
//$input3 = htmlspecialchars($_REQUEST['myaccess']);
//$input4 = htmlspecialchars($_REQUEST['mystat']);
	$input=(isset($_POST['myname']) ? $_POST['myname'] : null);
	$input0=(isset($_POST['mybId']) ? $_POST['mybId'] : null);
	$input1=(isset($_POST['myword']) ? $_POST['myword'] : null);
	$input2=(isset($_POST['mycname']) ? $_POST['mycname'] : null);
	$input3=(isset($_POST['myaccess']) ? $_POST['myaccess'] : null);
	$input4=(isset($_POST['mystat']) ? $_POST['mystat'] : null);
	
  if (isset($_POST['update'])) 	{
	
		// checking empty fields
	if(empty($input) || empty($input1) || empty($input2) || empty($input3) || empty($input4)) {	
			
		if(empty($input)) {
			echo "<font color='red'>Username field is empty.</font><br/>";
					}
			if(empty($input1)) {
			echo "<font color='red'>Password field is empty.</font><br/>";
								}
				if(empty($input2)) {
				echo "<font color='red'>Completename field is empty.</font><br/>";
									}	
					if(empty($input3)) {
					echo "<font color='red'>Access Level field is empty.</font><br/>";
										}
						if(empty($input4)) {
						echo "<font color='red'>Status field is empty.</font><br/>";
											}
						else {	}
		//updating the table
	 	
		}
else {	
	
	$id = mysqli_real_escape_string($connection, $input0);
	$uname = mysqli_real_escape_string($connection, $input);
	$sword = mysqli_real_escape_string($connection, $input1);
	$cname = mysqli_real_escape_string($connection, $input2);	
	$alevel = mysqli_real_escape_string($connection, $input3);
	$stat = mysqli_real_escape_string($connection, $input4);
	
	  $md5 = md5($input1);
      $sha1 = sha1($md5);
      $crypt = crypt($sha1,'st');
      $md51 = md5($crypt);
      $sha12 = sha1($md51);
      $crypt1 = crypt($sha12,'st');
      $kode = base64_encode($crypt1);
		mysqli_query($connection, "UPDATE users_tbl SET username='$uname', password='$kode', completename ='$cname', accesslevel='$alevel', status='$stat' WHERE users_id='$id'") or die ('cannot connect to the server');
			echo '<script language="javascript" type="text/javascript"> ;
		alert("Edit successfull!")
        window.location = "usersaccount.php"
       	</script>'; 
			//redirectig to the display page.
		//header("Location: usersaccount.php"); 
		//mysqli_refresh($connection, MYSQLI_REFRESH_LOG); 
	 	//else {
			
		
		
			
		}
	//}          		 
 //}
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="css/bootstrap.css" rel="stylesheet" >

<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.bundle.js"></script>

</head>

<body>



</body>
</html>