<?php
require_once '../includes/dbconnect.php';
$DB_con = new mysqli("localhost", "root", "", "records");

if (isset($_GET['StudentID'])) {
  $StudentID = $_GET['StudentID'];

  $query = $DB_con->query("SELECT * FROM `students_soap` WHERE StudentID=".$StudentID);
  if ($query->num_rows > 0) {
    while ($soap = $query->fetch_assoc()){ 
      $update = date('F j, Y; h:i a', strtotime($soap['date_checked'])); 
      ?>
      <div class="row">
        <div class="container-fluid">           
          <br />
          <div class="col-lg-6">
            <div class="form-group row">
              <label id="date_time">Date Recorded:</label>
              <br/><?php echo $update;?>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group row">
              <label id="date_time">Physician:</label>
              <br /><?php echo $soap['checked_by'];?>
            </div>
          </div>
        </div>
      </div>

      <br>                       

      <table class="table table-bordered">
        <thead>
          <th colspan="2">CURRENT SYSTEM</th>
          <th colspan="2">ASSESSMENT</th>
        </thead>
        <tbody>
          <tr>
            <td colspan="2"><?php echo $soap['sysRev'];?></td>
            <td colspan="2"><?php echo $soap['assess'];?></td>
          </tr>
        </tbody>
        <thead>
          <th colspan="4">PHYSICAL</th>
        </thead>
        <tbody>
          <tr>
            <td>
              <label>Height:</label> <?php echo $soap['height'] ;?> cm.
            </td>
            <td>
              <label>Weight:</label> <?php echo $soap['weight'] ;?> kg.
            </td>
            <td><label>BMI:</label> <?php echo $soap['bmi']. ' - ' .$soap['bmi_cat'];?></td>
            <td><label>Blood Pressure:</label> <?php echo $soap['bp'] ;?></td>
          </tr>
          <tr>
            <td><label>Cardiac Rate:</label> <span data-toggle="tooltip" title="Beats per minute" style="cursor: pointer;"><?php echo $soap['cr']. ' bpm.' ;?></span></td>
            <td><label>Respirtory Rate:</label> <span data-toggle="tooltip" title="Breaths per minute" style="cursor: pointer;"><?php echo $soap['rr']. " bpm." ;?></span></td>
            <td colspan="2"><label>Temperature:</label> <?php echo $soap['temp']. " &#x2103;" ;?></td>
          </tr>
        </tbody>
        <thead>
          <tr>
            <th colspan="4"><label>MEDICINE(s) GIVEN</label></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $soap['med'];?></td>
          </tr>
        </tbody>

      </table> 

      <br>
      <?php 
    }
  }
  else { ?>
    <br />
    <a href="soap_form.php?StudentID=<?php echo $row['StudentID']; ?>" id="add_soap" class="btn btn-success"> <i class="fa fa-plus"></i> ADD RECORD</a><br><br>
    <?php 
    echo "<div class='alert alert-warning'>
            <span class='glyphicon glyphicon-info'></span> 
              No records found.
          </div>";
  }

}

?>