<?php
  require_once '../includes/dbconnect.php';

 // Request sending

	$url = "https://www.proovl.com/api/send.php";
	$user = "cR2stkS";
	$token = "B2JaacKAzkvvkH0fATYsm9Y8b1N9Va9k";
	$route = "";
	$from = "639358306457";
	$to = $_POST['cphone'];
	$text = $_POST['message'];

	$postfields = array(
		'user' => "$user",
		'token' => "$token",
		'route' => "$route",
		'from' => "$from",
		'to' => "$to",
		'text' => "$text"
	);

	if (!$curld = curl_init()) {
		exit;
	}

	curl_setopt($curld, CURLOPT_POST, true);
	curl_setopt($curld, CURLOPT_POSTFIELDS, $postfields);
	curl_setopt($curld, CURLOPT_URL,$url);
	curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);

	$output = curl_exec($curld);

	curl_close ($curld);



 // Handle the response

	$result = explode(';',$output);

	if ($result[0] == "Error") {
		echo "Error message: $result[1]";
		die;
	} else {
		echo "Message ID: $result[1]; Status: $result[0]";
	}

?>

<!DOCTYPE html>
<html>
<head>
<title>SMS</title>
</head>
<body>

<center>
<form method="POST" action="">
<div class="control-group">	

<?php 
	$query = mysqli_query($DB_con,"SELECT * from students where StudentID='198'") or die(mysqli_error());
	$row = mysqli_fetch_array($query);

?>
	
 
  Enter phone number:
 <div class="controls">
 
 <input name="phone" type="number" value="<?php echo $row['cphone']; ?>"/>
 </div>
								</div>
<br><br />
      <div class="control-group">
 Enter Message: 
	  <div class="controls">
<textarea name="message"></textarea><br />
</div>
</div>

<div class="control-group">
<div class="controls"><br />
 <input type="submit" value="Send" />
  </div></div>
</form>
<div align="left"></div>
</center>

</body>
</html>