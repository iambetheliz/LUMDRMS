<?php
   
//Include database configuration file
include('../includes/dbconnect.php');
 
if (isset($_POST['FacultyID']) && is_numeric($_POST['FacultyID']) && $_POST['FacultyID'] > 0) {
   
$id = $_POST['FacultyID'];
$query = mysqli_query($DB_con,"SELECT * FROM `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id` WHERE FacultyID = $id");
$row = mysqli_fetch_array($query);

	if(!empty($row)){
?>
   
	<div class="row">
	  <div id="msg"></div>
	  <div class="col-lg-6">
	    <div class="form-group"> 
	      <label><i class="fa fa-asterisk text-danger"></i> Faculty No.: </label> <span class="error pull-right" id="errFN"></span>
	      <input type="text" class="form-control" value="<?php echo $row['facultyNo'];?>" name="facultyNo" id="facultyNo">
	      <br>
	      <label><i class="fa fa-asterisk text-danger"></i> First Name: </label> <span class="error pull-right" id="errFirst"></span>
	      <input type="text" class="form-control" id="first_name" value="<?php echo $row['first_name'];?>" name="first_name">
	      <br>                        
	      <label>Middle Name: </label> <span class="text-muted">(Optional)</span> <span class="error pull-right" id="errMid"></span>
	      <input type="text" class="form-control" value="<?php echo $row['middle_name'];?>" name="middle_name" id="middle_name">
	      <br>
	      <label><i class="fa fa-asterisk text-danger"></i> Last Name: </label> <span class="error pull-right" id="errLast"></span>
	      <input type="text" class="form-control" value="<?php echo $row['last_name'];?>" name="last_name" id="last_name">
	      <br>
	      <label>Extension Name: </label> <small class="text-muted pull-right">(leave if none)</small> <span class="error pull-right" id="errExt"></span>
	      <input type="text" class="form-control" placeholder="Jr" name="ext" maxlength="3" id="ext" value="<?php echo $row['ext'];?>">
	      <br>
	      <label>Age:</label> <span class="error pull-right" id="errAge"></span>
	      <input class="form-control" type="text" value="<?php echo $row['age'];?>" id="age" name="age">
	      <br>	      
	      <label>Address</label> <span class="error pull-right" id="errAdd"></span>
	      <textarea class="form-control" id="address" name="address" style="height: 80px;"><?php echo $row['address'];?>
	      </textarea>
	    </div>
	  </div>
	  <div class="col-lg-1"></div>
      <div class="col-lg-5">
	    <div class="form-group">
	      <label><i class="fa fa-asterisk text-danger"></i> Gender</label> <span class="error pull-right" id="errSex"></span>
	      <select class="form-control" name="sex" id="sex">
	      	<option value="<?php echo $row['sex'];?>"><?php echo $row['sex'];?></option>
	        <option value="Male">Male</option>
	        <option value="Female">Female</option>
	      </select>
	      <br>
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
            <option value="<?php echo $row['civil'] ;?>"><?php echo $row['civil'] ;?></option>
            <option value="Single">Single</option>
            <option value="Married">Married</option>
          </select>
          <br>
<?php  } ?>
	      <label><i class="fa fa-asterisk text-danger"></i> Department</label> <span class="error pull-right" id="errProg"></span>
	      <?php

            //Get all dept data
            $query = $DB_con->query("SELECT * FROM department WHERE stat = 1 ORDER BY dept_id ASC");

            //Count total number of rows
            $rowCount = $query->num_rows;
            $res = "SELECT * FROM `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id` WHERE FacultyID =".$_POST['FacultyID'];
            $result = $DB_con->query($res);
            $row = $result->fetch_array(MYSQLI_BOTH);
          ?>
	      <select class="form-control" name="dept" id="dept">
		    <option value="<?php echo $row['dept'] ;?>"><?php echo $row['dept_name'] ;?></option>
		    <option value="">Select Department</option>
		    <?php
		        if($rowCount > 0){
		          while($row = $query->fetch_assoc()){ 
		              echo '<option value="'.$row['dept_id'].'">'.$row['dept_name'].'</option>';
		          }
		        }else{
		          echo '<option value="">Department not available</option>';
		        }
		    ?>
		  </select>
		  <br>
		  <?php
		 
		  if (isset($_POST['FacultyID']) && is_numeric($_POST['FacultyID']) && $_POST['FacultyID'] > 0) {	   
		    $id = $_POST['FacultyID'];
		    $res = "SELECT * FROM `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id` WHERE FacultyID = $id";
		    $result = $DB_con->query($res);
	        $row = $result->fetch_array(MYSQLI_BOTH); 

	        if(!empty($row)){
		  ?>
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

          <input type="hidden" name="FacultyID" id="hidden_user_id" value="<?php echo $row['FacultyID']; ?>"/>
	    </div>
	  </div>
	</div>
<?php }}}?>
<!-- DAtepicker -->
<script type="text/javascript">
  $('#dob, #dob_edit').datetimepicker({
    format:'MM/DD/YYYY',
  	useCurrent: false,
    icons: {
		time: "fa fa-clock-o",
		date: "fa fa-calendar",
		up: "fa fa-arrow-up",
		down: "fa fa-arrow-down"
	}
  });
</script>
<script src="../assets/js/form_validate_custom.js"></script> 