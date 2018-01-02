<?php
require_once '../includes/dbconnect.php';
$DB_con = new mysqli("localhost", "root", "", "records");

if (isset($_GET['StudentID'])) {
  $StudentID = $_GET['StudentID'];

  $den_res = mysqli_query($DB_con,"SELECT * FROM `students_den` WHERE StudentID = '".$_GET['StudentID']."'"); 

  if ($den_res->num_rows == 0) {
    $errMSG = "No records found."; ?>
    <br />
    <a href="dental_form.php?StudentID=<?php echo $row['StudentID']; ?>" id="add_den" class="btn btn-success"> <i class="fa fa-plus"></i> ADD RECORD</a><br><br>
    <?php 
  }
  else { 
    $query = mysqli_query($DB_con,"SELECT date_checked FROM students_den");
      while ($den = $query->fetch_assoc()){ 
        $update = date('F j, Y; h:i a', strtotime($den['date_checked']));
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
            <br /><?php echo $den['physician'];?>
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
      while ($den = $den_res->fetch_assoc()) { ?>
        <tbody>
          <tr>
            <td colspan="2"><?php echo $den['sysRev'];?></td>
            <td colspan="2"><?php echo $den['medHis'];?></td>
          </tr>
        </tbody>
        <thead>
          <th colspan="4">PHYSICAL</th>
        </thead>
        <tbody>
          <tr>
            <td>
              <label>Height:</label> <?php echo $den['height'] ;?> cm.
            </td>
            <td>
              <label>Weight:</label> <?php echo $den['weight'] ;?> kg.
            </td>
            <td><label>BMI:</label> <?php echo $den['bmi']. ' - ' .$den['bmi_cat'];?></td>
            <td><label>Blood Pressure:</label> <?php echo $den['bp'] ;?></td>
          </tr>
          <tr>
            <td><label>Cardiac Rate:</label> <span data-toggle="tooltip" title="Beats per minute" style="cursor: pointer;"><?php echo $den['cr']. ' bpm.' ;?></span></td>
            <td><label>Respirtory Rate:</label> <span data-toggle="tooltip" title="Breaths per minute" style="cursor: pointer;"><?php echo $den['rr']. " bpm." ;?></span></td>
            <td colspan="2"><label>Temperature:</label> <?php echo $den['temp']. " &#x2103;" ;?></td>
          </tr>
        </tbody>
        <thead>
          <tr>
            <th colspan="4"><label>PERSONAL AND SOCIAL HISTORY</label></th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if ($den['drinker'] == 'Yes') {
            echo "<tr>
                    <td colspan='2' id='drinker'>Alcoholic Drinker</td>
                  </tr>";
          } else if ($den['smoker'] == 'Yes') {
            echo "<tr>
                    <td colspan='2' id='smoker'>Smoker</td>
                  </tr>";
          } else if ($den['drug_user'] == 'Yes') {
            echo "<tr>
                    <td colspan='2' id='drug_user'>Drug User</td>
                  </tr>";
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
          if (!empty($den['mens'])) {
            echo "<tr>
                    <th>Menstrual Period:</th>
                    <td colspan='3'>" .$den['mens']. "</td>
                  </tr>";
            echo "<tr>
                    <th>Duration:</th>
                    <td colspan='3'>" .$den['duration']. "</td>
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