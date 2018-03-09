<?php   
//Include database configuration file
include('../includes/dbconnect.php');
 
if (isset($_POST['StudentID']) && is_numeric($_POST['StudentID']) && $_POST['StudentID'] > 0) {
   
$id = $_POST['StudentID'];
$query = mysqli_query($DB_con,"SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE StudentID = $id");
$row = mysqli_fetch_array($query);

	if(!empty($row)){
?>
   
	<div class="row">
	  <div id="msg"></div>
	  <div class="col-lg-6">
	    <div class="form-group"> 
	      <label for="studentNo"><i class="fa fa-asterisk text-danger"></i> Student No.: </label> <span class="error pull-right" id="errSN"></span>
	      <input type="text" class="form-control" value="<?php echo $row['studentNo'];?>" name="studentNo" readonly title="Cannot be edited" data-toggle="tooltip">
	      <br>
	      <label for="first_name"><i class="fa fa-asterisk text-danger"></i> First Name: </label> <span class="error pull-right" id="errFirst"></span>
	      <input type="text" class="form-control" id="first_name_edit" value="<?php echo $row['first_name'];?>" name="first_name">
	      <br>                        
	      <label>Middle Name: </label> <span class="text-muted">(Optional)</span> <span class="error pull-right" id="errMid"></span>
	      <input type="text" class="form-control" value="<?php echo $row['middle_name'];?>" name="middle_name" id="middle_name_edit">
	      <br>
	      <label><i class="fa fa-asterisk text-danger"></i> Last Name: </label> <span class="error pull-right" id="errLast"></span>
	      <input type="text" class="form-control" value="<?php echo $row['last_name'];?>" name="last_name" id="last_name_edit">
	      <br>
	      <label>Extension Name: </label> <small class="text-muted pull-right">(leave if none)</small> <span class="error pull-right" id="errExt"></span>
	      <input type="text" class="form-control" placeholder="Jr" name="ext" maxlength="3" id="ext_edit" value="<?php echo $row['ext'];?>">
	      <br>
	      <label>Age</label> <span class="error pull-right" id="errAge"></span>
	      <input class="form-control" type="text" value="<?php echo $row['age'];?>" id="age_edit" name="age">
	      <br>
	      <label><i class="fa fa-asterisk text-danger"></i> Gender</label> <span class="error pull-right" id="errSex"></span>
	      <select class="form-control" name="sex" id="sex_edit">
	      	<option value="<?php echo $row['sex'];?>"><?php echo $row['sex'];?></option>
	        <option value="Male">Male</option>
	        <option value="Female">Female</option>
	      </select>
	      <br>
	      <label>Address</label> <span class="error pull-right" id="errAdd"></span>
	      <textarea class="form-control" id="address" name="address" style="height: 80px;"><?php echo $row['address'];?>
	      </textarea>
	    </div>
	  </div>
      <div class="col-lg-1"></div>
      <div class="col-lg-5">
	    <div class="form-group">
          <label>Date of Birth:</label> <span class="error pull-right" id="errDOB"></span>
          <div class="input-group date">
            <input type="text" class="form-control" value="<?php echo $row['dob'] ;?>" name="dob" id="dob_edit" /> 
            <span class="input-group-addon">
              <span class="fa fa-calendar"></span>
            </span>
          </div>
          <br>
          <label>Marital Status:</label> <span class="error pull-right" id="errStat"></span>
          <select class="form-control" name="civil" id="civil">
            <option value="<?php echo $row['civil'];?>"><?php echo $row['civil'];?></option>
            <option value="Single">Single</option>
            <option value="Married">Married</option>
          </select>
<?php  } ?>
          <br>
	      <label><i class="fa fa-asterisk text-danger"></i> Department</label> <span class="error pull-right" id="errProg"></span>
	      <?php

            //Get all dept data
            $query = $DB_con->query("SELECT * FROM department WHERE stat = 1 AND cat = 2 ORDER BY dept_id ASC");

            //Count total number of rows
            $rowCount = $query->num_rows;
            $res = "SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `department` ON `students`.`dept`=`department`.`dept_id` WHERE StudentID =".$_POST['StudentID'];
            $result = $DB_con->query($res);
            $row = $result->fetch_array(MYSQLI_BOTH);
          ?>
	      <select class="form-control" name="dept" id="dept_edit">
	      	<option value="<?php echo $row['dept'] ;?>"><?php echo $row['dept_name'] ;?></option>
	      	<option value="">Select Department</option>
	      	<?php
	        	if($rowCount > 0){
	          		while($row = $query->fetch_assoc()){ 
	              		echo '<option value="'.$row['dept_id'].'">'.$row['dept_name'].'</option>';
	          		}
	        	} else {
	          		echo '<option value="">Department not available</option>';
	        	}
	      	?>
	      </select>
		  <?php
		 
		  if (isset($_POST['StudentID']) && is_numeric($_POST['StudentID']) && $_POST['StudentID'] > 0) {	   
		    $id = $_POST['StudentID'];
		    $res = "SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE StudentID = $id";
		    $result = $DB_con->query($res);
	        $row = $result->fetch_array(MYSQLI_BOTH); 

	        if(!empty($row)){
		  ?>
		  <br>
	      <label><i class="fa fa-asterisk text-danger"></i> Program</label> 
	      <select class="form-control" name="program" id="prog_edit">
	    	<option value="<?php echo $row['program'];?>"><?php echo $row['program_name'];?></option>
	        <option value="">Select department first</option>
	      </select>
	      <br>
	      <label><i class="fa fa-asterisk text-danger"></i> Year Level:</label> <span class="error pull-right" id="errLevel"></span>
	      <select class="form-control" name="yearLevel" id="yearLevel">
	        <option value="<?php echo $row['yearLevel'];?>"><?php echo $row['yearLevel'];?> Year</option>
	        <option value="1st">1st Year</option>
	        <option value="2nd">2nd Year</option>
	        <option value="3rd">3rd Year</option>
	        <option value="4th">4th Year</option>
	      </select>
	      <br>
	      <label><i class="fa fa-asterisk text-danger"></i> Semester</label> <span class="error pull-right" id="errSem"></span>
	      <select class="form-control" name="sem" id="sem">
	        <option value="<?php echo $row['sem'];?>"><?php echo $row['sem'];?></option>
	        <option value="1st">1st</option>
	        <option value="2nd">2nd</option>
	      </select>
	      <br>
	      <label><i class="fa fa-asterisk text-danger"></i> Academic Year</label> <span class="error pull-right" id="errYear"></span>
	      <?php
	        $currently_selected = date('Y'); 
	        $earliest_year = 2006; 
	        $latest_year = date('Y');
	      ?>
	      <select class="form-control" name="acadYear" id="acadYear">
	        <option value="<?php echo $row['acadYear'];?>"><?php echo $row['acadYear'];?></option>
	        <?php 
	          foreach ( range( $latest_year, $earliest_year ) as $i ) {
	            print '<option value="'.$i.' - '.++$i.'"'.(--$i === $currently_selected ? 'selected="selected"' : '').'>'.$i.' - '.++$i.'';
	            print '</option>';
	              }
	        ?> 
	      </select>
	      <br>
	      <label>Cellphone No.:</label> <span class="error pull-right" id="errTel"></span>
	      <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $row['phone'];?>">
	      <small class="text-muted"><i>(Format: 09xx xxx xxxx)</i></small>
	      <br><br><br>
	    </div>
	  </div>

	  <div class="col-lg-6">
	    <div class="form-group">
	      <label>Contact Person in case of Emergency</label> <span class="error pull-right" id="errPer"></span>
	      <input type="text" class="form-control" id="cperson" name="cperson" value="<?php echo $row['cperson'];?>">
	    </div>
	  </div>
	  <div class="col-lg-1"></div>
	  <div class="col-lg-5">
	    <div class="form-group">
	      <label>Cellphone/Telephone No.</label> <span class="error pull-right" id="errTel"></span>
	      <input type="text" name="cphone" id="cphone" class="form-control" value="<?php echo $row['cphone'];?>">
	      <small class="text-muted"><i>(Format: 09xx xxx xxxx)</i></small>

          <input type="hidden" name="StudentID" id="hidden_user_id" value="<?php echo $row['StudentID']; ?>"/>
	    </div>
	  </div>

	</div>
  </div>
<?php }}}?>

<!-- DAtepicker -->
<script type="text/javascript">
$(document).ready(function(){
  $('#dob_edit').datetimepicker({
    format:'MM/DD/YYYY',
    icons: {
		time: "fa fa-clock-o",
		date: "fa fa-calendar",
		up: "fa fa-arrow-up",
		down: "fa fa-arrow-down"
	}
  });
	//Select courses            
    $('#dept_edit').on('change',function(){
      var deptID = $(this).val();
      if(deptID){
        $.ajax({
          type:'POST',
          url:'courses.php',
          data:'dept_id='+deptID,
          success:function(html){
            $('#prog_edit').html(html); 
          }
        }); 
      } else {
        $('#prog_edit').html('<option value="">Select department first</option>');
      }
    });
});
</script>
<script src="../assets/js/form_validate_custom.js"></script> 