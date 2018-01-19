<?php
//Include database configuration file
include('../includes/dbconnect.php');
include '../includes/date_time_diff.php';
//Include pagination class file
include('../includes/Pagination.php');

if(isset($_POST['page'])){
    
    $start = !empty($_POST['page'])?$_POST['page']:0;
    $limit = 5;
    
    //set conditions for search
    $whereSQL = $orderSQL = '';
    $keywords = $_POST['keywords'];
    $sortBy = $_POST['sortBy'];
    $dept = $_POST["dept_id"];

    if ( !empty($keywords) && !empty($dept) ) {
      $whereSQL = " WHERE dept = '".$dept."' AND last_name LIKE '%".$keywords."%' or first_name LIKE '%".$keywords."%' or middle_name LIKE '%".$keywords."%' or ext LIKE '%".$keywords."%' ";
    }
    elseif ( !empty($keywords) ) {
      $whereSQL = " WHERE last_name LIKE '%".$keywords."%' or first_name LIKE '%".$keywords."%' or middle_name LIKE '%".$keywords."%' or ext LIKE '%".$keywords."%' ";
    }
    elseif ( !empty($dept) ) {
      $whereSQL = " WHERE dept = '".$dept."' ";
    }

    if ( !empty($sortBy) ){
      $orderSQL = " ORDER BY last_name ".$sortBy;
    } 
    elseif ( !empty($sortBy) && !empty($dept) ) {
      $orderSQL = " ORDER BY last_name ".$sortBy;
    }
    elseif (empty($dept) || empty($sortBy)) {
      $orderSQL = " ORDER BY date_updated DESC ";
    }

    //get number of rows
    $queryNum = $DB_con->query("SELECT COUNT(*) as postNum FROM `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id`".$whereSQL.$orderSQL);
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
    $query = $DB_con->query("SELECT * FROM `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id` $whereSQL $orderSQL LIMIT $start,$limit");
    
    if($query->num_rows > 0){ ?>
    <div class="row">
      <div class="container-fluid">
        <form method="post" name="frm">
          <label class="checkbox-inline"><input type="checkbox" class="select-all form-check-input" /><span class="lbl"></span> <strong><span id="check-all">Check</span> <span id="uncheck-all" style="display: none;">Uncheck</span> All</strong></label>
          <span style="word-spacing:normal;"> | With selected :</span>
          <label id="actions">
            <span><a class="text-danger" style="cursor: pointer;" onClick="delete_records();" title="Click to delete selected rows" data-toggle="tooltip"> Delete</a>
          </label>
          <span class="pull-right"><strong class="text-success">Total no. of rows: <?php echo $rowCount;?></strong></span>
          <br>
          <div class="table-responsive">
          <table class="table  table-striped table-bordered" id="myTable">
            <thead>
                <tr>
                    <th></th>
                    <th>No.</th>
                    <th width="150px">Last Name</th>
                    <th width="150px">First Name</th>
                    <th width="150px">Middle Name</th>
                    <th>Ext.</th>
                    <th>Faculty No.</th>
                    <th>Deparment</th>        
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
              while($row = $query->fetch_assoc()){ 
              $start++; ?>
              <tr id="table-row-<?php echo $row["StatsID"]; ?>">
                <td>
                  <label class="checkbox-inline"><input type="checkbox" name="chk[]" id="check" class="chk-box form-check-input" value="<?php echo $row['FacultyID']; ?>"  /> <span class="lbl"></span></label>
                </td>
                <td><?php echo $start;?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'last_name','<?php echo $row['StatsID']; ?>')" onClick="editRow(this);"><?php echo $row['last_name']; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'first_name','<?php echo $row['StatsID']; ?>')" onClick="editRow(this);"><?php echo $row['first_name']; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'middle_name','<?php echo $row['StatsID']; ?>')" onClick="editRow(this);"><?php echo $row['middle_name']; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'ext','<?php echo $row['StatsID']; ?>')" onClick="editRow(this);"><?php echo $row['ext'];?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'facultyNo','<?php echo $row['StatsID']; ?>')" onClick="editRow(this);"><?php echo $row['facultyNo']; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'dept','<?php echo $row['StatsID']; ?>')" onClick="editRow(this);"><?php echo $row['dept_name'];?></td>
                <td style="width: 145px;"><a href="profile.php?FacultyID=<?php echo $row['FacultyID']; ?>" class="btn btn-sm btn-warning" title="View Profile" data-toggle="tooltip" data-placement="bottom"> <i class="fa fa-external-link" aria-hidden="true"></i></a> | <a class="btn btn-sm btn-primary" title="Edit" data-toggle="modal" data-target="#view-modal" data-id="<?php echo $row['FacultyID']; ?>" id="getUser"> <i class="fa fa-pencil"></i></a> | <button class="btn btn-sm btn-danger delete" title="Delete" data-toggle="tooltip" data-placement="bottom" value="<?php echo $row['FacultyID']; ?>"><span class = "glyphicon glyphicon-trash"></span></button>
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
else {
  $start = !empty($_POST['page'])?$_POST['page']:0;
  $limit = 5;

  //get number of rows
  $queryNum = $DB_con->query("SELECT COUNT(*) as postNum FROM faculties");
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
  $query = $DB_con->query("SELECT * FROM `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id` ORDER BY date_updated DESC LIMIT $limit");

  if($query->num_rows > 0){ ?>
  <div class="row">
    <div class="container-fluid">
      <form method="post" name="frm">
        <label class="checkbox-inline"><input type="checkbox" class="select-all form-check-input" /><span class="lbl"></span> <strong><span id="check-all">Check</span> <span id="uncheck-all" style="display: none;">Uncheck</span> All</strong></label>
        <span style="word-spacing:normal;"> | With selected :</span>
        <label id="actions">
          <span><a class="text-danger" style="cursor: pointer;" onClick="delete_records();" title="Click to delete selected rows" data-toggle="tooltip"> Delete</a>
        </label>
        <span class="pull-right"><strong class="text-success">Total no. of rows: <?php echo $rowCount;?></strong></span>
        <br>
        <div class="table-responsive">
          <table class="table  table-striped table-bordered" id="myTable">
            <thead>
              <tr>
                <th></th>
                <th>No.</th>
                <th width="150px">Last Name</th>
                <th width="150px">First Name</th>
                <th width="150px">Middle Name</th>
                <th>Ext. </th>
                <th>Faculty No.</th>
                <th>Department</th>           
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
              while($row = $query->fetch_assoc()){ 
              $start++; ?>
              <tr id="table-row-<?php echo $row["StatsID"]; ?>">
                <td>
                  <label class="checkbox-inline"><input type="checkbox" name="chk[]" id="check" class="chk-box form-check-input" value="<?php echo $row['FacultyID']; ?>"  /> <span class="lbl"></span></label>
                </td>
                <td><?php echo $start;?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'last_name','<?php echo $row['StatsID']; ?>')" onClick="editRow(this);"><?php echo $row['last_name']; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'first_name','<?php echo $row['StatsID']; ?>')" onClick="editRow(this);"><?php echo $row['first_name']; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'middle_name','<?php echo $row['StatsID']; ?>')" onClick="editRow(this);"><?php echo $row['middle_name']; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'ext','<?php echo $row['StatsID']; ?>')" onClick="editRow(this);"><?php echo $row['ext'];?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'facultyNo','<?php echo $row['StatsID']; ?>')" onClick="editRow(this);"><?php echo $row['facultyNo']; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'dept','<?php echo $row['StatsID']; ?>')" onClick="editRow(this);"><?php echo $row['dept_name'];?></td>
                <td style="width: 145px;"><a href="profile.php?FacultyID=<?php echo $row['FacultyID']; ?>" class="btn btn-sm btn-warning" title="View Profile" data-toggle="tooltip" data-placement="bottom"> <i class="fa fa-external-link" aria-hidden="true"></i></a> | <a class="btn btn-sm btn-primary" title="Edit" data-toggle="modal" data-target="#view-modal" data-id="<?php echo $row['FacultyID']; ?>" id="getUser"> <i class="fa fa-pencil"></i></a> | <button class="btn btn-sm btn-danger delete" title="Delete" data-toggle="tooltip" data-placement="bottom" value="<?php echo $row['FacultyID']; ?>"><span class = "glyphicon glyphicon-trash"></span></button>
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
} ?>

<script type="text/javascript">
//  for select / deselect all
$(document).ready(function() {
    $("[data-toggle=tooltip]").tooltip();
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

function delete_records() {
    var id = [];       
    $(':checkbox:checked').each(function(i){
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
        method:'POST',
        data:{id:id},
        success:function() {
          for(var i=0; i<id.length; i++) {
            $('tr#table-row-'+id[i]+'').css('background-color', '#ddd');
            $('tr#table-row-'+id[i]+'').fadeOut('slow');
          }
          $("#tbl_faculties").load("../faculties/tbl_faculties.php");
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

<!-- Quick Edit -->
<script>
  $('document').ready(function() {
    $('td:contains("Pending")').css('color', 'red');
    $('td:contains("Ok")').css('color', 'green');
  });
  
  function editRow(editableObj) {
    $(editableObj).css("background","#FFF");
  }

  function saveToDatabase(editableObj,column,id) {
    $(editableObj).css("background","#FFF url(../images/loading.gif) no-repeat right");
    $.ajax({
      url: "quick_edit.php",
      type: "POST",
      data:'med='+column+'&dent='+column+'&last_name='+column+'&editval='+$(editableObj).text()+'&StatsID='+id,
      success: function(data){
        $(editableObj).css("background","#FDFDFD");

        $('#overlay').show();
        $('#overlay').fadeOut('fast');

        $('td:contains("Pending")').css('color', 'red');
        $('td:contains("Ok")').css('color', 'green');

      }
    });
  }
</script>