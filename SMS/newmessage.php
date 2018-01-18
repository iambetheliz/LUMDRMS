<?php include('../includes/dbconnect.php'); ?>
<?php $get_id = $_GET['id']; ?>
<title>Send Message</title>
<style type="text/css">
a {
	font-size: 18px;
}
</style>
<body bgcolor="#999999" text="#FFFFFF"><center>
<form method="POST" action="send_sms.php">
<div class="control-group">	

<?php 
	$query = mysqli_query($DB_con, "SELECT * from students where StudentID='$get_id'")or die(mysqli_error());
	$row = mysqli_fetch_array($query);

?>
	
 
  Enter phone number:
 <div class="controls">
 
 <input name="cphone" type="number" value="<?php echo $row['cphone']; ?>"/>
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