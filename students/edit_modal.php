<div class="modal fade" id="edit<?php echo $StudentID; ?>" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Records</h4>
      </div>
      <?php

              $StudentID = (int) $_GET['StudentID'];
              $res = "SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE StudentID=$StudentID";
              $result = $DB_con->query($res);
              $row1 = $result->fetch_array(MYSQLI_BOTH);
      ?>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">First Name: </label>
                <p><?php echo $row1['first_name']; ?></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Last Name: </label>
                <p><?php echo $row1['last_name']; ?></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Email: </label>
                <p><?php echo $row1['email']; ?></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Mobile: </label>
                <p><?php echo $row1['mobile']; ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>