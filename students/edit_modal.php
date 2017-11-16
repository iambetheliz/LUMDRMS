<div class="modal fade" id="edit<?php echo $row['StudentID']; ?>" role="dialog">
  <div class="modal-dialog" style="width: 900px;">
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
                <label>Extension Name: </label> <small class="text-muted pull-right">(leave if none)</small> <span class="error pull-right" id="errExt"></span>
                <input type="text" class="form-control required" placeholder="Jr" name="ext" maxlength="3" id="ext<?php echo $row['StudentID']; ?>">
              </div>
            </div>
            <div class="col-2"></div>
            <div class="col-lg-2">
              <div class="form-group">
                <label class="col-2">Age</label> <span class="error pull-right" id="errAge"></span>
                <input class="form-control" type="text" value="<?php echo $nrow['age'];?>" id="age<?php echo $row['StudentID'];?>" name="age">
                <br>
                <label for="example-date-input" class="col-2 col-form-label">Gender</label> <span class="error pull-right" id="errSex"></span>
                <select class="form-control required" name="sex" id="sex<?php echo $row['StudentID']; ?>">
                  <option value="<?php echo $nrow['sex'];?>"><?php echo $nrow['sex'];?></option>
                  <option value="undefined">Select New</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
            </div>
            <div class="col-2"></div>
              <div class="col-lg-3">
                <div class="form-inline">
                  <label class="col-2 col-form-label">Department</label> <span class="error pull-right" id="errProg"></span>
                  <?php
                    //Include database configuration file
                    include('../includes/dbconnect.php');
                    $DB_con = new mysqli("localhost", "root", "", "records");
    
                    //Get all dept data
                    $query = $DB_con->query("SELECT * FROM department WHERE status = 1 ORDER BY dept_name ASC");
    
                    //Count total number of rows
                    $rowCount = $query->num_rows;
                    $n = mysqli_query($DB_con,"SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `department` ON `students`.`dept`=`department`.`dept_id` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE StudentID='".$row['StudentID']."'");
                    $nrow = mysqli_fetch_array($n);                    
                  ?>
                  <select class="form-control" name="dept" id="dept<?php echo $row['StudentID']; ?>"">
                    <option value="<?php echo $nrow['dept'] ;?>"><?php echo $nrow['dept_name'] ;?></option>
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
              <div class="col-lg-4">
                <div class="form-group">
                  <label>Program</label>                            
                  <select class="form-control" name="program" id="program<?php echo $row['StudentID'];?>">
                    <option value="<?php echo $nrow['program'];?>"><?php echo $nrow['program_name'];?></option>
                    <option value="">Select department first</option>
                  </select>
                </div>
              </div>
              <div class="col-2"></div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="example-date-input" class="col-2 col-form-label">Year</label> <span class="error pull-right" id="errLevel"></span>
                  <select class="form-control required" name="yearLevel" id="yearLevel<?php echo $row['StudentID']; ?>">
                    <option value="<?php echo $nrow['yearLevel'];?>"><?php echo $nrow['yearLevel'];?> Year</option>
                    <option value="unknown">Select new</option>
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
                  <select class="form-control" name="sem" id="sem<?php echo $row['StudentID']; ?>">
                    <option value="<?php echo $nrow['sem'];?>"><?php echo $nrow['sem'];?></option>
                    <option value="unknown">Select</option>
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
                    <select class="form-control" name="acadYear" id="acadYear<?php echo $row['StudentID']; ?>">
                      <option value="<?php echo $nrow['acadYear'];?>"><?php echo $nrow['acadYear'];?></option>
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
                    <textarea class="form-control" id="address<?php echo $row['StudentID']; ?>" name="address" style="height: 80px;"><?php echo $nrow['address'];?>
                    </textarea>
                  </div>
                </div>
                <div class="col-2"></div>
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label for="example-date-input" class="col-2 col-form-label">Contact Person in case of Emergency</label> <span class="error pull-right" id="errPer"></span>
                      <input type="text" class="form-control" id="cperson<?php echo $row['StudentID']; ?>" name="cperson" value="<?php echo $nrow['cperson'];?>">
                    </div>
                  </div>
                  <div class="col-lg-1"></div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="example-date-input" class="col-2 col-form-label">Cellphone/Telephone No.</label> <span class="error pull-right" id="errTel"></span>
                      <input type="text" name="cphone" id="cphone<?php echo $row['StudentID']; ?>" class="form-control" placeholder="0935 830 6457">
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