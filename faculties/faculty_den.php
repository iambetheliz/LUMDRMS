<?php
require_once '../includes/dbconnect.php';

if (isset($_GET['FacultyID'])) {

  $FacultyID = $_GET['FacultyID'];
  $den_res = mysqli_query($DB_con,"SELECT * FROM `faculty_den` WHERE FacultyID = '$FacultyID' AND date_checked IN (SELECT max(date_checked) FROM faculty_den)"); 

  if ($den_res->num_rows == 0) {
    $errMSG = "No records found."; ?>
    <br />
    <a href="dental_form.php?FacultyID=<?php echo $row['FacultyID']; ?>" id="add_den" class="btn btn-success"> <i class="fa fa-plus"></i> ADD RECORD</a><br><br>
    <?php 
  }
  else { 
    $query = mysqli_query($DB_con,"SELECT * FROM faculty_den WHERE FacultyID = '$FacultyID'");
      while ($den = $query->fetch_assoc()){ 
        $update = date('F j, Y; h:i a', strtotime($den['date_checked']));
        $checked = $den['checked_by'];
        $output = "<tr>
                  <td>".date('F j, Y; h:i a', strtotime($den['date_checked']))."</td>
                  <td>".$den['checked_by']."</td>
                </tr>";
      } ?>
    <div class="row">
      <div class="container-fluid">
        <br />
        <a href="dental_form.php?FacultyID=<?php echo $row['FacultyID']; ?>" id="add_den" class="btn btn-success"> <i class="fa fa-plus"></i> ADD NEW RECORD</a>
        <a href="/LUMDRMS/faculties/dental.php?FacultyID=<?php echo $row['FacultyID']; ?>" class="btn btn-primary" title="View Dental" data-toggle="tooltip" data-placement="bottom"> <i class="fa fa-print" aria-hidden="true"></i> Print</a><br><br>
        <div class="col-lg-6">
          <div class="form-group row">
            <label id="date_time">Date Recorded:</label>
            <br/><?php echo $update;?>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group row">
            <label id="date_time">Physician:</label>
            <br /><?php echo $den['checked_by'];?>
          </div>
        </div>
      </div>
    </div>

    <br>                       

    <table class="table table-bordered">
      <thead>
        <th colspan="3">MEDICAL HISTORY</th>
      </thead>
      <?php 
      // displaying records.
      while ($den = $den_res->fetch_assoc()) { ?>
        <tbody>
          <tr>
            <td colspan="3">
              <?php 
              if (empty($den['medHis'])) {
                echo "None";
              }
              else {
                echo $den['medHis'];
              }              
              ?>
            </td>
          </tr>
        </tbody>
        <thead>
          <th colspan="3">DENTITION STATUS</th>
        </thead>
        <tbody>
          <tr>
            <td>
              <label>Personal Condition:</label> 
              <?php echo $den['per_con']; ?> 
            </td>
            <td rowspan="2">
              <label>Dental Prostheses:</label>
            </td>
            <td>
              <label>Denture Wearer: </label>
              <?php echo $den['denture']; ?>
            </td>
          </tr>
          <tr>
            <td><label>Remarks:</label> <?php echo $den['con_rem1']."".$den['con_rem2']."".$den['con_rem3']."".$den['con_rem4']; ?></td>
            <td>
              <label>Need for Denture:</label>
              <?php echo $den['need']; ?>
            </td>
          </tr>
        </tbody>
        <thead>
          <tr>
            <th colspan="3"><label>INDEX: DMFT</label></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td rowspan="2">
              <label>No. of T/Decayed:</label>
            </td>
            <td>
              <label>X:</label> <?php echo $den['dec_x']; ?>
            </td>
            <td><label>No. of Missing:</label> <?php echo $den['missing']; ?></td>
          </tr>
          <tr>
            <td><label>F:</label> <?php echo $den['dec_f']; ?></td>
            <td><label>No. of Filled:</label> <?php echo $den['filled']; ?></td>
          </tr>
        </tbody>
        <?php 
      } 
      // End of Dental records
      ?>
    </table> 
    <br>
    <div class="alert alert-success">
      <strong>Previous checkups</strong>
    </div>

    <table class='table table-bordered'>
      <thead>
        <tr>
          <td>Date</td>
          <td>Time</td>
          <td>Attending Physician</td>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = mysqli_query($DB_con,"SELECT * FROM `faculty_den` WHERE FacultyID = '$FacultyID'");
        while ($med = $query->fetch_assoc()) { 
          echo "<tr>
                  <td>".date('F j, Y', strtotime($med['date_checked']))."</td>
                  <td>".date('h:i a', strtotime($med['date_checked']))."</td>
                  <td>".$med['checked_by']."</td>
                </tr>";
        }
        ?>
      </tbody>
    </table>

    <?php 
  }
}
if(isset($errMSG)) { 
  echo "<div class='alert alert-warning'>
          <span class='glyphicon glyphicon-info'></span> 
            ".$errMSG."
        </div>";      
}
?>