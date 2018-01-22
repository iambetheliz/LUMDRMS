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
        <a href="dental_form.php?FacultyID=<?php echo $row['FacultyID']; ?>" id="add_den" class="btn btn-success"> <i class="fa fa-plus"></i> ADD RECORD</a><br><br>
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
        <th colspan="2">MEDICAL HISTORY</th>
      </thead>
      <?php 
      // displaying records.
      while ($den = $den_res->fetch_assoc()) { ?>
        <tbody>
          <tr>
            <td colspan="2"><?php echo $den['medHis'];?></td>
          </tr>
        </tbody>
        <thead>
          <th colspan="2">DENTITION STATUS</th>
        </thead>
        <tbody>
          <tr>
            <td>
              <label>Personal Condition:</label> 
              <?php if (!empty($den['per_con'])) {
                echo $den['per_con'] . " - " .$den['con_rem'];
              } else {
                echo "None";
              }?> 
            </td>
            <td>
              <label>Dental Prostheses:</label>
              <?php 
              if ($den['denture'] == 'Yes') {
                echo "Denture Wearer.";
              } else if ($den['need'] == 'Yes') {
                echo "Need for a denture.";
              } 
              else {
                echo "Not Applicable";
              }
            ?>
            </td>
          </tr>
        </tbody>
        <thead>
          <tr>
            <th colspan="2"><label>INDEX: DMFT</label></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <label>No. of T/Decayed:</label><br>
              <label>X:</label> <?php echo $den['dec_x']; ?><span  style="margin-right:10em"></span>
              <label>F:</label> <?php echo $den['dec_f']; ?>
            </td>
            <td>
              <label>No. of Missing:</label> <?php echo $den['missing']; ?> <br>
              <label>No. of Filled:</label> <?php echo $den['filled']; ?>
            </td>
          </tr>
        </tbody>
        <?php 
      } 
      // End of displaying records
      ?>
    </table> 

    <br>

    <?php 
  }

  if(isset($errMSG)) { 
    echo "<div class='alert alert-warning'>
            <span class='glyphicon glyphicon-info'></span> 
              ".$errMSG."
          </div>";      
  }
}
?>