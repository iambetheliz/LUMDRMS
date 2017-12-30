<?php
include_once '../db/dbconfig.php';
include('session.php');

if ($acceslevel!="admin") { 
header("location: mainmenu2.php");
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
<script src="js/bootstrap-modal1.js"></script>
<script src="js/validator.min.js"></script>

<script>
function checkDelete(){
    return confirm('Are you sure you want to delete?');
	
}
</script>

<style>
select {
	line-height: normal;
    vertical-align:top;
    height:25px;
}
	
</style>

<script type="text/javascript">
			
$(document).ready(function(){
    $('#myModal').on('show.bs.modal', function (e) {
        var bookid = $(e.relatedTarget).data('book-id');
        var name = $(e.relatedTarget).data('name');
        var pass = $(e.relatedTarget).data('password');
		var cname = $(e.relatedTarget).data('comname');
		var access = $(e.relatedTarget).data('level');
		var stat = $(e.relatedTarget).data('stat');
        //Can pass as many onpage values or information to modal
        //Pass value to text
        $('#mybId').val(bookid);
		$('#myname').val(name);
		$('#myword').val(pass);
		$('#mycname').val(cname);
		$('#myaccess').html(access);
		$('#mystat').html(stat);
		               
     });
});	
</script> 
</head>

<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#inverseNavbar1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand" href="#">Virtual File Archive</a></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="inverseNavbar1">
     <ul class="nav navbar-nav navbar-right">
        <li><a href="mainmenu2.php">Home</a></li>
        <li class="dropdown active"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php if($acceslevel!="admin") { ?>
            <li><a href="#">Change Password</a></li>
            <?php } else { ?>		
            <li class="active"><a href="usersaccount.php">Add/Edit account</a></li>
            <li><a href="changecateg.php">Add/Edit category</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
            <?php } ?>
          </ul>
        </li>
        <li><a href="searching.php">Search</a></li>
        <li><a href="logout.php">Log-out</a></li>
      </ul>
      
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
<?php

$query = (isset($_POST['name']) ? $_POST['name'] : null);
$query1 = (isset($_POST['word']) ? $_POST['word'] : null);
$query2 = (isset($_POST['cname']) ? $_POST['cname'] : null);
$query3 = (isset($_POST['level']) ? $_POST['level'] : null);
	
	if ($query!="" && $query1!="" && $query2!="" && $query3!="") {
	 
	 $name = $_POST['name'];
	 $word = $_POST['word'];
	 $comname = $_POST['cname'];
	 $level = $_POST['level'];
	 $stat = $_POST['status'];	
		
	  $md5 = md5($word);
      $sha1 = sha1($md5);
      $crypt = crypt($sha1,'st');
      $md51 = md5($crypt);
      $sha12 = sha1($md51);
      $crypt1 = crypt($sha12,'st');
      $kode = base64_encode($crypt1);
			 
		if (mysqli_query($connection, "INSERT INTO users_tbl (username, password, completename, 				  accesslevel, status) VALUES ('$name', '$kode', '$comname', '$level', '$stat')")) 
			{
			echo "<div align=\"center\"><font color=\"blue\">Successfully added!</font></div>";
			//header("location: usersaccount.php"); 
			
			}
		else	{ ?>
	<table align="center"><tr><td><font color="#C00508"><i><?php echo("Error description: " . mysqli_error($connection)); ?></i></font></td></tr></table><br>
			<?php	}
	}
	else
	{ ?>
		  
    	<table align="center"><tr><td><?php echo("Enter complete details to add an account." ); ?></td></tr></table><br>
      	
<?php	} ?>
<div class="container">
<form name="formadd" method = "POST" action="usersaccount.php" data-toggle="validator" role="form" class="form-horizontal">

<div class="form-group">
<label class="control-label col-sm-5">Username:</label>
<div class="col-xs-2"><input id="username" type="text" name="name" class="form-control" required/></div>
<div class="help-block with-errors"></div></div>	


<div class="form-group row">
<label class="control-label col-sm-5">Password:</label>
<div class="col-xs-2"><input id="password" type="text" name="word" class="form-control" data-minlength="5" required/></div>
<div class="help-block with-errors"></div></div>


<div class="form-group row">
<label class="control-label col-sm-5">Complete Name:</label>
<div class="col-xs-2"><input id="cname" type="text" name="cname" class="form-control" required/></div>
<div class="help-block with-errors"></div></div>


<div class="form-group">
<label class="control-label col-sm-5">Access Level:</label>
<div class="col-xs-2"><select id="level "name="level" class="form-control" required>
			<option disabled selected> -- select an option -- </option>
			<option value= "admin">admin</option>
			<option value= "user">user</option></select></div>
			<div class="help-block with-errors"></div></div>

<div class="form-group">
<label class="control-label col-sm-5">Status:</label>
<div class="col-xs-2"><select id="status" name="status" class="form-control" required>
			<option disabled selected> -- select an option -- </option>
			<option value= "active">active</option>
			<option value= "inactive">in-active</option></select></div>
			<div class="help-block with-errors"></div></div>

<div class="form-group" align="center">
<input type="button" class="btn btn-default" data-dismiss="formadd" value="CLEAR" onclick="this.form.submit()"/>
<input id="go" align="middle" type="submit" class="btn btn-primary" value="&nbsp; ADD &nbsp;"/></div> 
 
</form>
</div>	
<br> 
<div class="container-fluid">
<table id="tbldata" class="table table-bordered table-responsive">
<thead>
<tr style="background-color:#A29D9D; color:#000000;">
	<th hidden="true"><center>User ID</center></th>
	<th scope="col"><center>Username</center></th> 
	<th scope="col"><center>Password</center></th> 
	<th scope="col"><center>Complete Name</center></th> 
	<th scope="col"><center>Level</center></th>
	<th scope="col"><center>Status</center></th>
	<th scope="col"><center>Action</center></th> 
</tr>
</thead>
<?php
$result = mysqli_query($connection,"SELECT * FROM users_tbl")
or die('cannot connect to the server');

while($row = mysqli_fetch_assoc($result)) { ?>
<tbody>
 <tr align="left">
	<td hidden="true"><?php echo $row['users_id']; ?></td>
	<td>&nbsp;<?php echo $row['username']; ?></td>
	<td>&nbsp;<?php echo $row['password']; ?></td>	
	<td>&nbsp;<?php echo $row['completename']; ?></td>
	<td>&nbsp;<?php echo $row['accesslevel']; ?></td>
	<td>&nbsp;<?php echo $row['status']; ?></td>
	<td align="center"><span role="button">
      <a data-book-id="<?php echo $row['users_id']; ?>" data-name="<?php echo $row['username']; ?>" data-password="<?php echo $row['password']; ?>" data-comname="<?php echo $row['completename']; ?>" data-level="<?php echo $row['accesslevel']; ?>" data-stat="<?php echo $row['status']; ?>" class=btn-link data-toggle="modal" data-target="#myModal">Edit</a></span> | <a href="deleteusers.php?id=<?php echo $row['users_id']; ?>" onClick="return checkDelete()">Delete</a></td>
		
</tr><?php } ?>
</tbody>
</table>
</div>
<!-- Modal -->
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Account</h4>
      </div>
    <div class="modal-body"> 
     <form method="POST" action="user.php" class="form-horizontal" data-toggle="validator" role="form">
     	<div class="form-group">
			<label class="col-xs-3 control-label" hidden="true">User ID</label>
			<input id="mybId" name="mybId" type="hidden"/>
		</div>
		<div class="form-group">	
			<label class="col-xs-3 control-label">User Name:</label>
			<div class="col-xs-5"><input id="myname" name="myname" type="text" class="form-control" required/></div><div class="help-block with-errors"></div>
		</div>	
		<div class="form-group"> 
			<label class="col-xs-3 control-label">Password:</label>
			<div class="col-xs-5"><input id="myword" name="myword" type="password" class="form-control" data-minlength="5" required/></div><div class="help-block with-errors"></div>
		</div>
		<div class="form-group"> 
			<label class="col-xs-3 control-label">Complete Name:</label>
			<div class="col-xs-5"><input id="mycname" name="mycname" type="text" class="form-control" required/></div><div class="help-block with-errors"></div>
		</div>
		<div class="form-group"> 
			<label class="col-xs-3 control-label">Access Level:</label>
			<div class="col-xs-5"><select class="form-control"><option id="myaccess" name="myaccess"><option>admin</option><option>user</option></select></div><div class="help-block with-errors"></div>
		</div>
		<div class="form-group"> 
			<label class="col-xs-3 control-label">Status:</label>
			<div class="col-xs-5"><select class="form-control"><option id="mystat" name="mystat"></option><option>active</option><option>in-active</option></select></div><div class="help-block with-errors"></div>
		</div>
	</div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button name="update" type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
	</div>
  </div>
 </div>

</body>
</html>