<?php
   
//Include database configuration file
include('../includes/dbconnect.php');

$DB_con = new mysqli("localhost", "root", "", "records");
 
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
	      <label for="facultyNo">Student No.: </label> <span class="error pull-right" id="errSN"><?php echo $errorMSG; ?></span>
	      <input type="text" class="form-control" value="<?php echo $row['facultyNo'];?>" name="facultyNo" readonly title="Cannot be edited" data-toggle="tooltip">
	      <br>
	      <label for="first_name">First Name: </label> <span class="error pull-right" id="errFirst"></span>
	      <input type="text" class="form-control" id="first_name_edit" value="<?php echo $row['first_name'];?>" name="first_name">
	      <br>                        
	      <label for="inlineFormInput">Middle Name: </label> <span class="error pull-right" id="errMid"></span>
	      <input type="text" class="form-control" value="<?php echo $row['middle_name'];?>" name="middle_name" id="middle_name_edit">
	      <br>
	      <label for="inlineFormInput">Last Name: </label> <span class="error pull-right" id="errLast"></span>
	      <input type="text" class="form-control" value="<?php echo $row['last_name'];?>" name="last_name" id="last_name_edit">
	      <br>
	      <label>Extension Name: </label> <small class="text-muted pull-right">(leave if none)</small> <span class="error pull-right" id="errExt"></span>
	      <input type="text" class="form-control" placeholder="Jr" name="ext" maxlength="3" id="ext_edit" value="<?php echo $row['ext'];?>">
	      <br>
	      <label class="col-2">Age:</label> <span class="error pull-right" id="errAge"></span>
	      <input class="form-control" type="text" value="<?php echo $row['age'];?>" id="age_edit" name="age">
	    </div>
	  </div>
	  <div class="col-lg-1"></div>
      <div class="col-lg-5">
	    <div class="form-group">
	      <label for="example-date-input" class="col-2 col-form-label">Gender</label> <span class="error pull-right" id="errSex"></span>
	      <select class="form-control" name="sex" id="sex_edit">
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
          <select class="form-control" name="stat" id="stat">
            <option value="<?php echo $row['stat'];?>"><?php echo $row['stat'];?></option>
            <option value="Single">Single</option>
            <option value="Married">Married</option>
          </select>
          <br>
<?php  } ?>
	      <label class="col-2 col-form-label">Department</label> <span class="error pull-right" id="errProg"></span>
	      <?php
            //Include database configuration file
            include('../includes/dbconnect.php');
            $DB_con = new mysqli("localhost", "root", "", "records");

            //Get all dept data
            $query = $DB_con->query("SELECT * FROM department WHERE status = 1 ORDER BY dept_id ASC");

            //Count total number of rows
            $rowCount = $query->num_rows;
            $res = "SELECT * FROM `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id` WHERE FacultyID =".$_POST['FacultyID'];
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
		        }else{
		          echo '<option value="">Department not available</option>';
		        }
		    ?>
		  </select>
		  <br>
		  <?php
		  //Include database configuration file
		  include('../includes/dbconnect.php');
		  $DB_con = new mysqli("localhost", "root", "", "records");
		 
		  if (isset($_POST['FacultyID']) && is_numeric($_POST['FacultyID']) && $_POST['FacultyID'] > 0) {	   
		    $id = $_POST['FacultyID'];
		    $res = "SELECT * FROM `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id` WHERE FacultyID = $id";
		    $result = $DB_con->query($res);
	        $row = $result->fetch_array(MYSQLI_BOTH); 

	        if(!empty($row)){
		  ?>
	      <label for="example-date-input" class="col-2 col-form-label">Semester</label> <span class="error pull-right" id="errSem"></span>
	      <select class="form-control" name="sem" id="sem_edit">
	        <option value="<?php echo $row['sem'];?>"><?php echo $row['sem'];?></option>
	        <option value="1st">1st</option>
	        <option value="2nd">2nd</option>
	      </select>
	      <br>
	      <label for="example-date-input" class="col-2 col-form-label">Academic Year</label> <span class="error pull-right" id="errYear"></span>
	      <?php
	        $currently_selected = date('Y'); 
	        $earliest_year = 2006; 
	        $latest_year = date('Y');
	      ?>
	      <select class="form-control" name="acadYear" id="acadYear_edit">
	        <option value="<?php echo $row['acadYear'];?>"><?php echo $row['acadYear'];?></option>
	        <?php 
	          foreach ( range( $latest_year, $earliest_year ) as $i ) {
	            print '<option value="'.$i.' - '.++$i.'"'.(--$i === $currently_selected ? 'selected="selected"' : '').'>'.$i.' - '.++$i.'';
	            print '</option>';
	              }
	        ?> 
	      </select>
	    </div>
	  </div>
	  
	  <div class="container-fluid">
	    <div class="form-group">
	      <label for="example-date-input" class="col-2 col-form-label">Address</label> <span class="error pull-right" id="errAdd"></span>
	      <textarea class="form-control" id="address_edit" name="address" style="height: 80px;"><?php echo $row['address'];?>
	      </textarea>
	    </div>
	  </div>
	  
	  <div class="col-lg-6">
	    <div class="form-group">
	      <label for="example-date-input" class="col-2 col-form-label">Contact Person in case of Emergency</label> <span class="error pull-right" id="errPer"></span>
	      <input type="text" class="form-control" id="cperson_edit" name="cperson" value="<?php echo $row['cperson'];?>">
	    </div>
	  </div>
	  <div class="col-lg-1"></div>
	  <div class="col-lg-5">
	    <div class="form-group">
	      <label for="example-date-input" class="col-2 col-form-label">Cellphone/Telephone No.</label> <span class="error pull-right" id="errTel"></span>
	      <input type="text" name="cphone" id="cphone_edit" class="form-control" value="<?php echo $row['cphone'];?>">

          <input type="hidden" name="FacultyID" id="hidden_user_id" value="<?php echo $row['FacultyID']; ?>"/>
	    </div>
	  </div>
	</div>
<?php }}}?>
<!-- DAtepicker -->
<script type="text/javascript">
  $('#dob, #dob_edit').datetimepicker({
    format:'MM/DD/YYYY',
    icons: {
				time: "fa fa-clock-o",
				date: "fa fa-calendar",
				up: "fa fa-arrow-up",
				down: "fa fa-arrow-down"
			}
  });
</script>
<script type="text/javascript">
	//Capitalize each word
  $("input, textarea").keyup(function(e) {
    var arr = $(this).val().split(' ');
    var result = '';
    for (var x = 0; x < arr.length; x++)
    result += arr[x].substring(0, 1).toUpperCase() + arr[x].substring(1) + ' ';
    $(this).val(result.substring(0, result.length - 1));
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
        $('#prog_edit').html('<option value="">Select departmentt first</option>');
      }
    });
</script>