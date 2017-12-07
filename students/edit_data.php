<?php
   
//Include database configuration file
include('../includes/dbconnect.php');

$DB_con = new mysqli("localhost", "root", "", "records");
 
if (isset($_POST['StudentID']) && is_numeric($_POST['StudentID']) && $_POST['StudentID'] > 0) {
   
$id = $_POST['StudentID'];
$query = mysqli_query($DB_con,"SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE StudentID = $id");
$row = mysqli_fetch_array($query);

	if(!empty($row)){
?>
   
	<div class="row">
	  <div class="col-lg-3">
	    <div class="form-group"> 
	      <label for="studentNo">Student No.: </label> <span class="error pull-right" id="errSN"><?php echo $errorMSG; ?></span>
	      <input type="text" class="form-control" value="<?php echo $row['studentNo'];?>" name="studentNo" readonly title="Cannot be edited" data-toggle="tooltip">
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
	    </div>
	  </div>
	  <div class="col-2"></div>
	  <div class="col-lg-2">
	    <div class="form-group">
	      <label class="col-2">Age</label> <span class="error pull-right" id="errAge"></span>
	      <input class="form-control" type="text" value="<?php echo $row['age'];?>" id="age_edit" name="age">
	      <br>
	      <label for="example-date-input" class="col-2 col-form-label">Gender</label> <span class="error pull-right" id="errSex"></span>
	      <select class="form-control" name="sex" id="sex_edit">
	      	<option value="<?php echo $row['sex'];?>"><?php echo $row['sex'];?></option>
	        <option value="Male">Male</option>
	        <option value="Female">Female</option>
	      </select>
	    </div>
	  </div>
	  <div class="col-2"></div>
<?php  } ?>
	  <div class="col-lg-3">
	    <div class="form-group">
	      <label class="col-2 col-form-label">Department</label> <span class="error pull-right" id="errProg"></span>
	      <?php
            //Include database configuration file
            include('../includes/dbconnect.php');
            $DB_con = new mysqli("localhost", "root", "", "records");

            //Get all dept data
            $query = $DB_con->query("SELECT * FROM department WHERE status = 1 ORDER BY dept_id ASC");

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
		        }else{
		          echo '<option value="">Department not available</option>';
		        }
		      ?>
		    </select>
	    </div>
	  </div>
	  <?php
	  //Include database configuration file
	  include('../includes/dbconnect.php');
	  $DB_con = new mysqli("localhost", "root", "", "records");
	 
	  if (isset($_POST['StudentID']) && is_numeric($_POST['StudentID']) && $_POST['StudentID'] > 0) {	   
	    $id = $_POST['StudentID'];
	    $res = "SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE StudentID = $id";
	    $result = $DB_con->query($res);
        $row = $result->fetch_array(MYSQLI_BOTH); 

        if(!empty($row)){
	  ?>
	  <div class="col-lg-4">
	    <div class="form-group">
	      <label>Program</label>                            
	      <select class="form-control" name="program" id="prog_edit">
	      	<option value="<?php echo $row['program'];?>"><?php echo $row['program_name'];?></option>
	        <option value="">Select department first</option>
	      </select>
	    </div>
	  </div>
	  <div class="col-2"></div>
	  <div class="col-lg-3">
	    <div class="form-group">
	      <label for="example-date-input" class="col-2 col-form-label">Year</label> <span class="error pull-right" id="errLevel"></span>
	      <select class="form-control" name="yearLevel" id="yearLevel_edit">
	        <option value="<?php echo $row['yearLevel'];?>"><?php echo $row['yearLevel'];?> Year</option>
	        <option value="1st">1st Year</option>
	        <option value="2nd">2nd Year</option>
	        <option value="3rd">3rd Year</option>
	        <option value="4th">4th Year</option>
	      </select>
	    </div>
	  </div>
	  <div class="col-2"></div>
	  <div class="col-lg-2"> 
	    <div class="form-group">
	      <label for="example-date-input" class="col-2 col-form-label">Semester</label> <span class="error pull-right" id="errSem"></span>
	      <select class="form-control" name="sem" id="sem_edit">
	        <option value="<?php echo $row['sem'];?>"><?php echo $row['sem'];?></option>
	        <option value="1st">1st</option>
	        <option value="2nd">2nd</option>
	      </select>
	    </div>
	  </div>
	  <div class="col-2"></div>
	  <div class="col-lg-2">
	    <div class="form-group">
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
	  <div class="col-2"></div>
	  <div class="col-lg-8">
	    <hr>
	  </div>
	  <div class="col-2"></div>
	  <div class="col-lg-9">
	    <div class="form-group">
	      <label for="example-date-input" class="col-2 col-form-label">Address</label> <span class="error pull-right" id="errAdd"></span>
	      <textarea class="form-control" id="address_edit" name="address" style="height: 80px;"><?php echo $row['address'];?>
	      </textarea>
	    </div>
	  </div>
	  <div class="col-2"></div>
	  <div class="col-lg-5">
	    <div class="form-group">
	      <label for="example-date-input" class="col-2 col-form-label">Contact Person in case of Emergency</label> <span class="error pull-right" id="errPer"></span>
	      <input type="text" class="form-control" id="cperson_edit" name="cperson" value="<?php echo $row['cperson'];?>">
	    </div>
	  </div>
	  <div class="col-lg-1"></div>
	  <div class="col-lg-3">
	    <div class="form-group">
	      <label for="example-date-input" class="col-2 col-form-label">Cellphone/Telephone No.</label> <span class="error pull-right" id="errTel"></span>
	      <input type="text" name="cphone" id="cphone_edit" class="form-control" value="<?php echo $row['cphone'];?>">

          <input type="hidden" name="StudentID" id="hidden_user_id" value="<?php echo $row['StudentID']; ?>"/>
	    </div>
	  </div>
	</div>
<?php }}}?>

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