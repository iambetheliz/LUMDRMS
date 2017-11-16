<div class="modal fade" id="edit<?php echo $row['StudentID']; ?>" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Student's Information</h4>
      </div>
      <?php
        $n = mysqli_query($DB_con,"SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE StudentID='".$row['StudentID']."'");
        $nrow = mysqli_fetch_array($n);
      ?>
      <form method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label>Student No.</label>
                <input type="text" class="form-control" value="<?php echo $nrow['studentNo'];?>" name="studentNo" readonly title="Cannot be edited" data-toggle="tooltip" id="first_name<?php echo $row['StudentID']; ?>">
                <br>
                <label for="first_name">First Name: </label> 
                <input type="text" class="form-control" value="<?php echo $nrow['first_name']; ?>" name="first_name" id="first_name<?php echo $row['StudentID']; ?>" class="form-control">
                <br>                       
                <label for="inlineFormInput">Middle Name: </label> 
                <input type="text" class="form-control" value="<?php echo $nrow['middle_name'];?>" name="middle_name" id="middle_name<?php echo $row['StudentID']; ?>">
                <br>
                <label for="inlineFormInput">Last Name: </label>
                <input type="text" value="<?php echo $nrow['last_name']; ?>" id="last_name<?php echo $row['StudentID']; ?>" class="form-control">
                <br>
                <label class="col-2 col-form-label">Department</label> <span class="error pull-right" id="errProg"></span>
                        <?php
                        //Include database configuration file
                        include('../includes/dbconnect.php');
                        $DB_con = new mysqli("localhost", "root", "", "records");
    
                        //Get all dept data
                        $query = $DB_con->query("SELECT * FROM department WHERE status = 1 ORDER BY dept_name ASC");
    
                        //Count total number of rows
                        $rowCount = $query->num_rows;
                        $n = mysqli_query($DB_con,"SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `department` ON `students`.`dept`=`department`.`dept_id` WHERE StudentID='".$row['StudentID']."'");
                        $nrow = mysqli_fetch_array($n);
                        ?>
                        <select class="form-control" name="dept" id="dept<?php echo $row['StudentID']; ?>"">
                            <option value="<?php echo $nrow['dept'] ;?>"><?php echo $nrow['dept'] ;?></option>
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
                        <div class="form-group">
                        <label>Program</label>                            
                        <select class="form-control" name="program" id="program<?php echo $row['StudentID'];?>">
                            <option value="<?php echo $nrow['program'];?>"><?php echo $nrow['program_name'];?></option>
                            <option value="">Select department first</option>
                        </select>
                        </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><span class = "glyphicon glyphicon-remove"></span> Cancel</button> | <button type="submit" class="updateuser btn btn-success" value="<?php echo $row['StudentID']; ?>"><span class = "glyphicon glyphicon-floppy-disk"></span> Save</button>
        </div>
      </form>
    </div>
  </div>
</div>