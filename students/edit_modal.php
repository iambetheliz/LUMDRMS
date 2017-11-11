<div class="modal fade" id="edit<?php echo $row['StudentID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<?php
		$n=mysqli_query($DB_con,"select * from `students` where StudentID='".$row['StudentID']."'");
		$nrow=mysqli_fetch_array($n);
	?>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
		<div class = "modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<center><h3 class = "text-success modal-title">Update Member</h3></center>
		</div>
		<form method="post">
		<div class="modal-body">
			first_name: <input type="text" value="<?php echo $nrow['first_name']; ?>" id="first_name<?php echo $row['StudentID']; ?>" class="form-control">
			last_name: <input type="text" value="<?php echo $nrow['last_name']; ?>" id="last_name<?php echo $row['StudentID']; ?>" class="form-control">
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal"><span class = "glyphicon glyphicon-remove"></span> Cancel</button> | <button type="button" class="updateuser btn btn-success" value="<?php echo $row['StudentID']; ?>"><span class = "glyphicon glyphicon-floppy-disk"></span> Save</button>
		</div>
		</form>
    </div>
  </div>
</div>