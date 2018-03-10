<?php
require_once '../includes/dbconnect.php';

if (isset($_GET['StudentID'])) {

  $StudentID = $_GET['StudentID'];
  $med_res = mysqli_query($DB_con,"SELECT * FROM `students_med` WHERE StudentID = '$StudentID' AND `date_checked_up` IN (SELECT max(`date_checked_up`) FROM `students_med`)"); 

  if ($med_res->num_rows > 0) {
    $query = mysqli_query($DB_con,"SELECT * FROM `students_med` WHERE StudentID = '$StudentID'");
    while ($med = $query->fetch_assoc()) { 
      $update = date('F j, Y; h:i a', strtotime($med['date_checked_up']));
      $checked = $med['checked_by'];
      $output = "<tr>
                  <td>".date('F j, Y; h:i a', strtotime($med['date_checked_up']))."</td>
                  <td>".$med['checked_by']."</td>
                </tr>";
    } ?>
    <br />
    <a href="medical_form.php?StudentID=<?php echo $row['StudentID']; ?>" id="add_med" class="btn btn-success"> <i class="fa fa-plus"></i> ADD NEW RECORD</a>
    <a href="/LUMDRMS/students/medical.php?StudentID=<?php echo $row['StudentID']; ?>" class="btn btn-primary" title="View Medical" data-toggle="tooltip" data-placement="bottom"> <i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <br>             
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
        <br /><?php echo $checked;?>
      </div>
    </div>

    <br />

    <table class="table table-bordered">
      <thead>
        <th colspan="2">CURRENT SYSTEM</th>
        <th colspan="2">MEDICAL HISTORY</th>
      </thead>

      <?php
      // displaying records.
      while ($med = $med_res->fetch_assoc()) { ?>
        <tbody>
          <tr>
            <td colspan="2">
              <?php               
              if (!empty($med['sysRev'])) {
                echo $med['sysRev'];
              } 
              else {
                echo "No current illness.";
              }?>
            </td>
            <td colspan="2">
              <?php 
              if (!empty($med['medHis'])) {
                echo $med['medHis'];
              } 
              else {
                echo "None";
              }?>
            </td>
          </tr>
        </tbody>        
        <thead>
          <tr>
            <th colspan="4"><label>PERSONAL AND SOCIAL HISTORY</label></th>
          </tr>
        </thead>
        <tbody>
          <?php 
            echo "<tr>";
            echo "<td><label>Alcoholic Drinker:</label> ".$med['drinker']."</td>";
            echo "<td><label>Smoker:</label> ".$med['smoker']."</td>";
            echo "<td colspan='2'><label>Drug User:</label> ".$med['drug_user']."</td>";
            echo "</tr>";
          ?>
        </tbody>
        <thead>
          <tr>                          
            <th colspan="4"><label>O.B. GYNE</label></th>
          </tr>
        </thead>
        <?php 
          if ($med['mens'] == 'Not Applicable') {
            echo "<tr>";
            echo "<td colspan='4'>Not Applicable</td>";
            echo "</tr>";
          }
          else {
            echo "<tr>";
            echo "<th>Menstrual Period:</th>
                  <td colspan='3'>" .$med['mens']. "</td></tr>";
            echo "<tr><th>Duration:</th>
                  <td colspan='3'>" .$med['duration']. "</td>";
            echo "</tr>";
          }
          if (empty($med['mens'])) {
            echo "<tr>";
            echo "<td colspan='4'>&nbsp;</td>";
            echo "</tr>";
          }
        ?>
        <thead>
          <th colspan="4">E. PHYSICAL EXAMINATION I</th>
        </thead>
        <tbody>
          <tr>
            <td>
              <label>Height:</label> 
              <?php if (!empty($med['height'])) {
                echo $med['height']." cm.";
              } ?> 
            </td>
            <td>
              <label>Weight:</label> 
              <?php if (!empty($med['weight'])) {
                echo $med['weight']." kg.";
              } ?> 
            </td>
            <td>
              <label>BMI:</label> 
              <?php echo $med['bmi'];?>
            </td>
            <td>
              <label>Blood Pressure:</label> 
              <?php echo $med['bp']; ?>
            </td>
          </tr>
          <tr>
            <td>
              <label>Cardiac Rate:</label> <span data-toggle="tooltip" title="Beats per minute" style="cursor: pointer;">
                <?php if (!empty($med['cr'])) {
                echo $med['cr']." bpm.";
              } ?></span>
            </td>
            <td>
              <label>Respirtory Rate:</label> <span data-toggle="tooltip" title="Breaths per minute" style="cursor: pointer;">
                <?php if (!empty($med['rr'])) {
                echo $med['rr']." bpm.";
              } ?></span>
            </td>
            <td colspan="2">
              <label>Temperature:</label> 
              <?php if (!empty($med['temp'])) {
                echo $med['temp']." &#x2103;";
              } ?>
            </td>
          </tr>
        </tbody>
        <thead>
          <tr>
            <th colspan="4">F. PHYSICAL EXAMINATION II</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>CATEGORY</th>
            <th style="text-align: center;">NORMAL</th>
            <th colspan="2">ABNORMAL</th>
          </tr>
        </tbody>
        <tbody>
          <tr>
            <td><label>General Survey:</label> </td>
            <?php 
              if ($med['gen_sur'] == 'Normal') {
                echo "<td style='text-align:center;'><i class='fa fa-check'></i></td>";
                echo "<td colspan='2'></td>";
              }
              else {
                echo "<td></td>";
                echo "<td colspan='2'>". $med['gen_sur'] ."</td>";
              }
            ?>
          </tr>
          <tr>
            <td><label>Skin:</label> </td>
            <?php 
              if ($med['skin'] == 'Normal') {
                echo "<td style='text-align:center;'><i class='fa fa-check'></i></td>";
                echo "<td colspan='2'></td>";
              }
              else {
                echo "<td></td>";
                echo "<td colspan='2'>". $med['skin'] ."</td>";
              }
            ?>
          </tr>
          <tr>
            <td><label>HEENT:</label> </td>
            <?php 
              if ($med['heent'] == 'Normal') {
                echo "<td style='text-align:center;'><i class='fa fa-check'></i></td>";
                echo "<td colspan='2'></td>";
              }
              else {
                echo "<td></td>";
                echo "<td colspan='2'>". $med['heent'] ."</td>";
              }
            ?>
          </tr>
          <tr>
            <td><label>Lungs:</label> </td>
            <?php 
              if ($med['lungs'] == 'Normal') {
                echo "<td style='text-align:center;'><i class='fa fa-check'></i></td>";
                echo "<td colspan='2'></td>";
              }
              else {
                echo "<td></td>";
                echo "<td colspan='2'>". $med['lungs'] ."</td>";
              }
            ?>
          </tr>
          <tr>
            <td><label>Hear:</label> </td>
            <?php 
              if ($med['heart'] == 'Normal') {
                echo "<td style='text-align:center;'><i class='fa fa-check'></i></td>";
                echo "<td colspan='2'></td>";
              }
              else {
                echo "<td></td>";
                echo "<td colspan='2'>". $med['heart'] ."</td>";
              }
            ?>
          </tr>
          <tr>
            <td><label>Abdomen:</label> </td>
            <?php 
              if ($med['abdomen'] == 'Normal') {
                echo "<td style='text-align:center;'><i class='fa fa-check'></i></td>";
                echo "<td colspan='2'></td>";
              }
              else {
                echo "<td></td>";
                echo "<td colspan='2'>". $med['abdomen'] ."</td>";
              }
            ?>
          </tr>
          <tr>
            <td><label>Extremeties:</label> </td>
            <?php 
              if ($med['extreme'] == 'Normal') {
                echo "<td style='text-align:center;'><i class='fa fa-check'></i></td>";
                echo "<td colspan='2'></td>";
              }
              else {
                echo "<td></td>";
                echo "<td colspan='2'>". $med['extreme'] ."</td>";
              }
            ?>
          </tr>
        </tbody>
        <?php 
      }
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
        $query = mysqli_query($DB_con,"SELECT * FROM `students_med` WHERE StudentID = '$StudentID'");
        while ($med = $query->fetch_assoc()) { 
          echo "<tr>
                  <td>".date('F j, Y', strtotime($med['date_checked_up']))."</td>
                  <td>".date('h:i a', strtotime($med['date_checked_up']))."</td>
                  <td>".$med['checked_by']."</td>
                </tr>";
        }
        ?>
      </tbody>
    </table>
    <?php 
  }
  else { ?>
    <br />
    <a href="medical_form.php?StudentID=<?php echo $row['StudentID']; ?>" id="add_med" class="btn btn-success"> <i class="fa fa-plus"></i> ADD RECORD</a><br><br>
    <table class='table table-bordered'>
      <thead>
        <tr>
          <td>Date</td>
          <td>Time</td>
          <td>Attending Physician</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="3">No record</td>
        </tr>
      </tbody>
    </table>
    <?php
  }
}
?>