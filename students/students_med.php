<?php
require_once '../includes/dbconnect.php';

if (isset($_GET['StudentID'])) {
  $StudentID = $_GET['StudentID'];

  $med_res = mysqli_query($DB_con,"SELECT * FROM `students_med` WHERE StudentID = '".$_GET['StudentID']."'"); 

  if ($med_res->num_rows == 0) {
    $errMSG = "No records found."; ?>
    <br />
    <a href="medical_form.php?StudentID=<?php echo $row['StudentID']; ?>" id="add_med" class="btn btn-success"> <i class="fa fa-plus"></i> ADD RECORD</a><br><br>
    <?php 
  }
  else { 
    $query = mysqli_query($DB_con,"SELECT date_checked_up FROM students_med");
      while ($med = $query->fetch_assoc()){ 
        $update = date('F j, Y; h:i a', strtotime($med['date_checked_up']));
      } ?>
    <div class="row">
      <div class="container-fluid">
        <?php echo $add_btn; ?>                 
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
            <br /><?php echo $med['checked_by'];?>
          </div>
        </div>
      </div>
    </div>

    <br>                       

    <table class="table table-bordered">
      <thead>
        <th colspan="2">CURRENT SYSTEM</th>
        <th colspan="2">PAST MEDICAL HISTORY</th>
      </thead>
      <?php 
      // displaying records.
      while ($med = $med_res->fetch_assoc()) { ?>
        <tbody>
          <tr>
            <td colspan="2"><?php echo $med['sysRev'];?></td>
            <td colspan="2"><?php echo $med['medHis'];?></td>
          </tr>
        </tbody>
        <thead>
          <th colspan="4">PHYSICAL</th>
        </thead>
        <tbody>
          <tr>
            <td>
              <label>Height:</label> <?php echo $med['height'] ;?> cm.
            </td>
            <td>
              <label>Weight:</label> <?php echo $med['weight'] ;?> kg.
            </td>
            <td><label>BMI:</label> <?php echo $med['bmi'];?></td>
            <td><label>Blood Pressure:</label> <?php echo $med['bp'] ;?></td>
          </tr>
          <tr>
            <td><label>Cardiac Rate:</label> <span data-toggle="tooltip" title="Beats per minute" style="cursor: pointer;"><?php echo $med['cr']. ' bpm.' ;?></span></td>
            <td><label>Respirtory Rate:</label> <span data-toggle="tooltip" title="Breaths per minute" style="cursor: pointer;"><?php echo $med['rr']. " bpm." ;?></span></td>
            <td colspan="2"><label>Temperature:</label> <?php echo $med['temp']. " &#x2103;" ;?></td>
          </tr>
        </tbody>
        <thead>
          <tr>
            <th colspan="4"><label>PERSONAL AND SOCIAL HISTORY</label></th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if (!empty($med['drinker']) || !empty($med['smoker']) || !empty($med['drug_user'])) {
            if ($med['drinker'] == 'Yes') {
              echo "<tr>
                      <td colspan='2' id='drinker'>Alcoholic Drinker</td>
                    </tr>";
            } else if ($med['smoker'] == 'Yes') {
              echo "<tr>
                      <td colspan='2' id='smoker'>Smoker</td>
                    </tr>";
            } else if ($med['drug_user'] == 'Yes') {
              echo "<tr>
                      <td colspan='2' id='drug_user'>Drug User</td>
                    </tr>";
            }
            else {
              echo "<tr>
                      <td colspan='4'>None</td>
                    </tr>";
            }
          }
          else {
            echo "<tr>
                    <td colspan='4'>None</td>
                  </tr>";
          }
        ?>
        </tbody>
        <thead>
          <tr>                          
            <th colspan="4"><label>O.B. GYNE</label></th>
          </tr>
        </thead>
        <tbody>
        <?php 
          if (!empty($med['mens']) || !empty($med['dys'])) {
            echo "<tr>
                    <th>Menstrual Period:</th>
                    <td colspan='3'>" .$med['mens']. "</td>
                  </tr>";
            echo "<tr>
                    <th>Duration:</th>
                    <td colspan='3'>" .$med['duration']. "</td>
                  </tr>";
          }
          else {
            echo "<tr>
                    <td colspan='4'>Not Applicable</td>
                  </tr>";
          }
        ?>                        
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