<?php
//Include database configuration file
include('../../includes/dbconnect.php');
include '../../includes/date_time_diff.php';
//Include pagination class file
include('../../includes/Pagination.php');

if(isset($_POST['page'])){
    
  $start = !empty($_POST['page'])?$_POST['page']:0;
  $limit = 5;
  
  //set conditions for search
  $whereSQL = $orderSQL = '';
  $keywords = $_POST['keywords'];
  $sortBy = $_POST['sortBy'];
  $dept = $_POST["dept_id"];
  $archive = $_POST["archive"];
  $count = $_POST['num_rows'];

  //For number of rows per page
  if ( $count ){
    $limit = $_POST['num_rows']; 
  }

  if ( !empty($keywords) ) {
    $whereSQL = " WHERE `faculty_med`.`status` = 'active' AND CONCAT(last_name LIKE '%".$keywords."%' or first_name LIKE '%".$keywords."%' or middle_name LIKE '%".$keywords."%' or ext LIKE '%".$keywords."%') ";
    }
  if ( !empty($keywords) && !empty($dept) ) {
    $whereSQL = " WHERE `faculty_med`.`status` = 'active' AND dept = '".$dept."' AND CONCAT(last_name LIKE '%".$keywords."%' or first_name LIKE '%".$keywords."%' or middle_name LIKE '%".$keywords."%' or ext LIKE '%".$keywords."%' or facultyNo LIKE '%".$keywords."%') ";
  }
  if ( !empty($dept) ) {
    $whereSQL = " WHERE `faculty_med`.`status` = 'active' AND dept = '".$dept."' ";
  }
  if ( !empty($dept) && !empty($keywords) ) {
    $whereSQL = " WHERE `faculty_med`.`status` = 'active' AND CONCAT(last_name LIKE '%".$keywords."%' or first_name LIKE '%".$keywords."%' or middle_name LIKE '%".$keywords."%' or ext LIKE '%".$keywords."%') AND  dept = '".$dept."' ";
  }

  //For showing/hiding deleted rows   
  if ( !empty($archive) ) {
    $whereSQL .= " AND CONCAT(`faculty_med`.`status` = '".$archive."' OR `faculty_med`.`status` = '".$archive."') ";
  }
  elseif ( empty($archive) ) {
    $whereSQL .= " AND CONCAT(`faculty_med`.`status` = 'active' OR `faculty_med`.`status` = 'deleted') ";
  }

  if ( !empty($sortBy) ){
    $whereSQL .= " ORDER BY last_name ".$sortBy;
  }
  elseif ( !empty($sortBy) && !empty($archive) ){
    $whereSQL .= " ORDER BY date_deleted ".$sortBy;
  } 
  elseif ( !empty($sortBy) && !empty($dept) ) {
    $whereSQL .= " ORDER BY last_name ".$sortBy;
  }
  elseif (empty($dept) || empty($sortBy)) {
    $orderSQL .= " ORDER BY date_checked_up DESC ";
  }

  //get number of rows
  $queryNum = $DB_con->query("SELECT COUNT(*) as postNum, CONCAT(`faculty_med`.`status`) AS stat_med FROM `faculty_med` JOIN `faculties` ON `faculties`.`FacultyID`=`faculty_med`.`FacultyID` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id` $whereSQL $orderSQL");
  $resultNum = $queryNum->fetch_assoc();
  $rowCount = $resultNum['postNum'];

  //initialize pagination class
  $pagConfig = array(
      'currentPage' => $start,
      'totalRows' => $rowCount,
      'perPage' => $limit,
      'link_func' => 'searchFilter'
  );
  $pagination =  new Pagination($pagConfig);
  
  //get rows
  $query = $DB_con->query("SELECT *, CONCAT(`faculty_med`.`status`) AS stat_med FROM `faculty_med` JOIN `faculties` ON `faculties`.`FacultyID`=`faculty_med`.`FacultyID` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id` $whereSQL $orderSQL LIMIT $start,$limit");
  
  if($query->num_rows > 0){ ?>
  <div class="row">
    <div class="container-fluid">
      <form method="post" name="frm">
        <span class="pull-right"><strong class="text-success">Total no. of rows: <?php echo $rowCount;?></strong></span>
        <br>
        <div class="table-responsive">
          <table class="table  table-striped table-bordered" id="myTable">
          <thead>
            <tr>
              <th>
              <label class="checkbox-inline"><input type="checkbox" class="select-all form-check-input" /><span class="lbl"></span> </label></th>
              <th>No.</th>
              <th width="100px">Student No.</th>
              <th>Current System</th>
              <th>Assessment</th>
              <th>School Nurse</th>   
              <th>Date of Checkup</th>         
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
            while($row = $query->fetch_assoc()){ 
            $start++; ?>
            <tr id="table-row-<?php echo $row["StatsID"]; ?>">
              <td>
                <label class="checkbox-inline"><input type="checkbox" name="chk[]" id="check" class="chk-box form-check-input" value="<?php echo $row['MedID']; ?>"  /> <span class="lbl"></span></label>
              </td>
              <td><?php echo $start;?></td>
              <td><?php echo $row['facultyNo']; ?></td>
              <td><?php echo $row['sysRev'];?></td>
              <td><?php echo $row['assess'];?></td>
              <td><?php echo $row['checked_by'];?></td>
              <td><?php echo date('F j, Y; h:i a', strtotime($row['date_checked_up']));?></td>
              <td style="width: 145px;">
                <?php 
                  if ($row['stat_med'] == 'deleted') { 
                    ?>
                    <button type="button" name="restore" class="btn btn-success" id="restore" value="<?php echo $row['MedID']; ?>"><i class="fa fa-undo"></i> Restore</button>
                    <?php 
                  }
                  else { 
                    ?>
                    <a href="/LUMDRMS/medical/faculties/medical.php?MedID=<?php echo $row['MedID']; ?>" class="btn btn-sm btn-warning" title="View Medical" data-toggle="tooltip" data-placement="bottom"> <i class="fa fa-external-link" aria-hidden="true"></i></a> | <button class="btn btn-sm btn-danger delete" title="Delete" data-toggle="tooltip" data-placement="bottom" value="<?php echo $row['MedID']; ?>"><span class = "glyphicon glyphicon-trash"></span></button>
                    <?php 
                    }
                  ?>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
        </div>
        <!-- End of Table Responsive -->
      </form>
    </div>
    <!-- End of Container Fluid -->
  </div>
  <!-- End of Table -->
  <?php echo $pagination->createLinks(); ?>
  <?php 
  } 
  else { 
    echo "<div class='alert alert-warning'>No result</div>"; 
  }
} 
else {
  $start = !empty($_POST['page'])?$_POST['page']:0;
  $limit = 5;

  //get number of rows
  $queryNum = $DB_con->query("SELECT COUNT(*) as postNum, CONCAT(`faculty_med`.`status`) AS stat_med FROM `faculty_med` JOIN `faculties` ON `faculties`.`FacultyID`=`faculty_med`.`FacultyID` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id` WHERE `faculty_med`.`status` = 'active'");
  $resultNum = $queryNum->fetch_assoc();
  $rowCount = $resultNum['postNum'];

  //initialize pagination class
  $pagConfig = array(
    'totalRows' => $rowCount,
    'perPage' => $limit,
    'link_func' => 'searchFilter'
  );
  $pagination =  new Pagination($pagConfig);

  //get rows
  $query = $DB_con->query("SELECT *, CONCAT(`faculty_med`.`status`) AS stat_med FROM `faculty_med` JOIN `faculties` ON `faculties`.`FacultyID`=`faculty_med`.`FacultyID` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id` WHERE `faculty_med`.`status` = 'active' ORDER BY date_checked_up DESC LIMIT $limit");

  if($query->num_rows > 0){ ?>
  <div class="row">
    <div class="container-fluid">
      <form method="post" name="frm">
        <span class="pull-right"><strong class="text-success">Total no. of rows: <?php echo $rowCount;?></strong></span>
        <br>
        <div class="table-responsive">
          <table class="table  table-striped table-bordered" id="myTable">
            <thead>
              <tr>
                <th>
                <label class="checkbox-inline"><input type="checkbox" class="select-all form-check-input" /><span class="lbl"></span> </label></th>
                <th>No.</th>
                <th width="100px">Student No.</th>
                <th>Current System</th>
                <th>Assessment</th>
                <th>School Nurse</th>   
                <th>Date of Checkup</th>         
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
              while($row = $query->fetch_assoc()){ 
              $start++; ?>
              <tr id="table-row-<?php echo $row["StatsID"]; ?>">
                <td>
                  <label class="checkbox-inline"><input type="checkbox" name="chk[]" id="check" class="chk-box form-check-input" value="<?php echo $row['MedID']; ?>"  /> <span class="lbl"></span></label>
                </td>
                <td><?php echo $start;?></td>
                <td><?php echo $row['facultyNo']; ?></td>
                <td><?php echo $row['sysRev'];?></td>
                <td><?php echo $row['assess'];?></td>
                <td><?php echo $row['checked_by'];?></td>
                <td><?php echo date('F j, Y; h:i a', strtotime($row['date_checked_up']));?></td>
                <td style="width: 145px;">
                  <?php 
                    if ($row['stat_med'] == 'deleted') { 
                      ?>
                      <button type="button" name="restore" class="btn btn-success" id="restore" value="<?php echo $row['MedID']; ?>"><i class="fa fa-undo"></i> Restore</button>
                      <?php 
                    }
                    else { 
                      ?>
                      <a href="/LUMDRMS/medical/faculties/medical.php?MedID=<?php echo $row['MedID']; ?>" class="btn btn-sm btn-warning" title="View Medical" data-toggle="tooltip" data-placement="bottom"> <i class="fa fa-external-link" aria-hidden="true"></i></a> | <button class="btn btn-sm btn-danger delete" title="Delete" data-toggle="tooltip" data-placement="bottom" value="<?php echo $row['MedID']; ?>"><span class = "glyphicon glyphicon-trash"></span></button>
                      <?php 
                      }
                    ?>
                </td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- End of Table Responsive -->
      </form>
    </div>
    <!-- End of Container Fluid -->
  </div>
  <!-- End of Table -->
  <?php echo $pagination->createLinks(); 
  } else { 
    echo "<div class='alert alert-warning'>No result</div>"; 
  }
}
?>

<script type="text/javascript">
  $(document).ready(function() {

    $("[data-toggle=tooltip]").tooltip();

    //  for select / deselect all
    $(".select-all").change(function () {
      $(".chk-box").prop('checked', $(this).prop("checked"));
      $("#uncheck-all").toggle();
      $("#check-all").toggle();
    });        
    $(".chk-box").click(function() {
      if($(".chk-box").length == $(".chk-box:checked").length) {
          $(".select-all").attr("checked", "checked");
      }
      else {
          $(".select-all").removeAttr("checked");
      }
    });
  });

  //  for select / deselect all
  function delete_records() {
    var id = [];       
    $('input[name="chk[]"]:checked').each(function(i){
      id[i] = $(this).val();
    });
           
    if(id.length === 0) { //tell you if the array is empty
      alert("Please Select atleast one checkbox");
      return false;
    }
    else {
      confirm("Are you sure you want to delete this?");
      $.ajax({
        url:'delete_mul.php',
        type:'POST',
        data:{id:id},
        success:function() {
          for(var i=0; i<id.length; i++) {
            $('tr#table-row-'+id[i]+'').css('background-color', '#ddd');
            $('tr#table-row-'+id[i]+'').fadeOut('slow');
          }
          $("#userTable").load("tbl_medical.php");
          $.bootstrapGrowl("Deleted successfully", // Messages
            { // options
              type: "success", // info, success, warning and danger
              ele: "body", // parent container
              offset: {
                from: "top",
                amount: 20
              },
              align: "right", // right, left or center
              width: 300,
              delay: 4000,
              allow_dismiss: true, // add a close button to the message
              stackup_spacing: 10
          });
        }
      });
    }  
  }
  $('#close').click(function() {
    window.location.href = 'index.php';
    return false;
  });


</script>