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
    $sortBy = $_POST['sortBy'];

    $whereSQL = $orderSQL = '';
    $keywords = $_POST['keywords'];
    $prog = $_POST["program_id"];
    $stats = $_POST["stats"];
    $archive = $_POST["archive"];
    $count = $_POST['num_rows'];

    if ( $count ){
      $limit = $_POST['num_rows']; 
    }
    if ( !empty($count) && !empty($archive) ){
      $limit = $_POST['num_rows']; 
      $whereSQL = " WHERE CONCAT(`students`.`status` = '".$archive."' AND `students`.`status` = '".$archive."') ";
    }
    if ( !empty($count) && !empty($prog) ){
      $limit = $_POST['num_rows']; 
      $whereSQL = " WHERE `students`.`status` = 'active' AND program = '".$prog."' ";
    }

    if ( !empty($keywords) ) {
      $whereSQL = " WHERE `students`.`status` = 'active' AND CONCAT(last_name LIKE '%".$keywords."%' or first_name LIKE '%".$keywords."%' or middle_name LIKE '%".$keywords."%' or ext LIKE '%".$keywords."%' or `students`.`studentNo` LIKE '%".$keywords."%') ";
    }
    if ( !empty($keywords) && !empty($prog) ) {
      $whereSQL = " WHERE `students`.`status` = 'active' AND program = '".$prog."' AND CONCAT(last_name LIKE '%".$keywords."%' or first_name LIKE '%".$keywords."%' or middle_name LIKE '%".$keywords."%' or ext LIKE '%".$keywords."%') ";
    }

    if ( !empty($prog) ) {
      $whereSQL = " WHERE `students`.`status` = 'active' AND program = '".$prog."' ";
    }
    if ( !empty($prog) && !empty($keywords) ) {
      $whereSQL = " WHERE `students`.`status` = 'active' AND CONCAT(last_name LIKE '%".$keywords."%' or first_name LIKE '%".$keywords."%' or middle_name LIKE '%".$keywords."%' or ext LIKE '%".$keywords."%') AND  program = '".$prog."' ";
    }

    if ( !empty($stats) ) {
      $whereSQL = " WHERE `students`.`status` = 'active' AND CONCAT(med = '".$stats."' OR dent = '".$stats."') ";
    }
    if ( !empty($stats) && !empty($prog) ) {
      $whereSQL = " WHERE `students`.`status` = 'active' AND CONCAT(med = '".$stats."' OR dent = '".$stats."') AND CONCAT(med = '".$stats."' OR dent = '".$stats."') AND program = '".$prog."' ";
    }
    if ( !empty($stats) && !empty($keywords) ) {
      $whereSQL .= " WHERE `students`.`status` = 'active' AND CONCAT(med = '".$stats."' OR dent = '".$stats."') AND CONCAT(last_name LIKE '%".$keywords."%' OR first_name LIKE '%".$keywords."%' OR middle_name LIKE '%".$keywords."%' OR ext LIKE '%".$keywords."%') ";
    }
    if ( !empty($stats) && !empty($prog) && !empty($keywords) ) {
      $whereSQL = " WHERE `students`.`status` = 'active' AND CONCAT(med = '".$stats."' OR dent = '".$stats."') AND program = '".$prog."' AND CONCAT(last_name LIKE '%".$keywords."%' OR first_name LIKE '%".$keywords."%' OR middle_name LIKE '%".$keywords."%' OR ext LIKE '%".$keywords."%') ";
    }

    if ( !empty($archive) ) {
      $whereSQL = " WHERE CONCAT(`students`.`status` = '".$archive."' AND `students`.`status` = '".$archive."') ";
    }
    if ( !empty($archive) && !empty($stats) ) {
      $whereSQL = " WHERE CONCAT(`students`.`status` = '".$archive."' AND `students`.`status` = '".$archive."') AND CONCAT(med = '".$stats."' OR dent = '".$stats."') ";
    }
    if ( !empty($archive) && !empty($prog) ) {
      $whereSQL = " WHERE CONCAT(`students`.`status` = '".$archive."' AND `students`.`status` = '".$archive."') AND program = '".$prog."' ";
    }
    if ( !empty($archive) && !empty($keywords) ) {
      $whereSQL = " WHERE CONCAT(`students`.`status` = '".$archive."' AND `students`.`status` = '".$archive."') AND CONCAT(last_name LIKE '%".$keywords."%' OR first_name LIKE '%".$keywords."%' OR middle_name LIKE '%".$keywords."%' OR ext LIKE '%".$keywords."%') ";
    }
    if ( !empty($archive) && !empty($prog) && !empty($keywords) ) {
      $whereSQL = " WHERE CONCAT(`students`.`status` = '".$archive."' AND `students`.`status` = '".$archive."') AND CONCAT(last_name LIKE '%".$keywords."%' OR first_name LIKE '%".$keywords."%' OR middle_name LIKE '%".$keywords."%' OR ext LIKE '%".$keywords."%') ";
    }

    if ( !empty($sortBy) ){
      $orderSQL = " ORDER BY last_name ".$sortBy;
    } 
    elseif ( !empty($sortBy) && !empty($prog) ) {
      $orderSQL = " ORDER BY last_name ".$sortBy;
    }
    elseif (empty($prog) || empty($sortBy)) {
      $orderSQL = " ORDER BY modified DESC ";
    } 

    //get number of rows
    $queryNum = $DB_con->query("SELECT COUNT(*) as postNum FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id`".$whereSQL.$orderSQL);
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
    $query = $DB_con->query("SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` $whereSQL $orderSQL LIMIT $start,$limit");
    
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
                <th><label class="checkbox-inline"><input type="checkbox" class="select-all form-check-input" /><span class="lbl"></span> </label></th>
                <th>No.</th>
                <th>Dental</th>
                <th>Medical</th>
                <th width="100px">Last Name</th>
                <th width="100px">First Name</th>
                <th>Middle</th>
                <th>Suffix</th>
                <th width="110px">Student No.</th>
                <th>Program</th>
                <th>Year</th>    
                <th>Added</th>      
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr id="overlay" style="display: none;">
                <td colspan="13" align="center">
                  <p>Loading records <i class="fa fa-refresh fa-spin"></i></p>
                </td>
              </tr>
            <?php
              while($row = $query->fetch_assoc()){
              $start++; ?>
              <tr id="table-row-<?php echo $row["StatsID"]; ?>" class="students">
                <td>
                  <label class="checkbox-inline"><input type="checkbox" name="chk[]" id="check" class="chk-box form-check-input" value="<?php echo $row['StudentID']; ?>"  /> <span class="lbl"></span></label>
                </td>
                <td><?php echo $start;?></td>
                <td><?php echo $row['dent']; ?></td>
                <td><?php echo $row['med']; ?></td>
                <td contenteditable="true" onblur="saveToDatabase(this,'last_name','<?php echo $row["StatsID"]; ?>')" ondblclick="editRow(this);"><span title="Click to quick edit." data-toggle="tooltip" data-placement="right"><?php echo $row['last_name']; ?></span></td>
                <td contenteditable="true" onblur="saveToDatabase(this,'first_name','<?php echo $row["StatsID"]; ?>')" ondblclick="editRow(this);"><span title="Click to quick edit." data-toggle="tooltip" data-placement="right"><?php echo $row['first_name']; ?></span></td>
                <td contenteditable="true" onblur="saveToDatabase(this,'middle_name','<?php echo $row["StatsID"]; ?>')" ondblclick="editRow(this);"><span title="Click to quick edit." data-toggle="tooltip" data-placement="right"><?php echo $row['middle_name']; ?></span></td>
                <td contenteditable="true" onblur="saveToDatabase(this,'ext','<?php echo $row["StatsID"]; ?>')" ondblclick="editRow(this);"><span title="Click to quick edit." data-toggle="tooltip" data-placement="right"><?php echo $row['ext'];?></span></td>
                <td contenteditable="true" onblur="saveToDatabase(this,'studentNo','<?php echo $row["StatsID"]; ?>')" ondblclick="editRow(this);"><span title="Click to quick edit." data-toggle="tooltip" data-placement="right"><?php echo $row['studentNo']; ?></span></td>
                <td><?php echo $row['program_name'];?></td>
                <td><?php echo $row['yearLevel'];?></td>
                <td><?php echo date('m/d/Y <br/> h:i a', strtotime($row['date_registered']));?></td>
                <td>
                  <div class="btn-toolbar action" role="toolbar">
                    <?php 
                      if ($row['status'] == 'deleted') { 
                        ?>
                        <button type="button" class="btn btn-success" id="restore" value="<?php echo $row['StudentID']; ?>"> Restore</button>
                        <?php 
                      }
                      else { 
                        ?>
                        <a href="profile.php?StudentID=<?php echo $row['StudentID']; ?>" class="btn btn-sm btn-warning" title="Profile" data-toggle="tooltip" data-placement="top"> <i class="glyphicon glyphicon-user"></i></a><a class="btn btn-sm btn-primary" title="Edit" data-toggle="modal" data-target="#view-modal" data-id="<?php echo $row['StudentID']; ?>" id="getUser"> <i class="fa fa-pencil"></i></a><button class="btn btn-sm btn-danger delete" title="Delete" data-toggle="tooltip" data-placement="top" value="<?php echo $row['StudentID']; ?>"><span class = "glyphicon glyphicon-trash"></span></button>
                        <?php 
                      }
                    ?>
                  </div>
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
  } 
  else { ?>
    <div  align="center">
      <span class="pull-right">
        <strong class="text-success">Total no. of rows: 0</strong>
      </span>
      <br>
      <div class="table-responsive">
        <table class="table table-striped table-bordered" id="myTable">
          <thead>
            <tr>
              <th><label class="checkbox-inline"><input type="checkbox" class="select-all form-check-input" /><span class="lbl"></span> </label></th>
              <th>No.</th>
              <th>Dental</th>
              <th>Medical</th>
              <th width="100px">Last Name</th>
              <th width="100px">First Name</th>
              <th>Middle</th>
              <th>Suffix</th>
              <th width="110px">Student No.</th>
              <th>Program</th>
              <th>Year</th>    
              <th>Added</th>        
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="13" align="center">
                <p>No records found</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- End of Table Responsive -->
    </div>
    <?php 
  }
} 
else {
  $start = !empty($_POST['page'])?$_POST['page']:0;
  $limit = 5;

  //get number of rows
  $queryNum = $DB_con->query("SELECT COUNT(*) as postNum FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE `students`.`status` = 'active'");
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
  $query = $DB_con->query("SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE `students`.`status` = 'active' ORDER BY modified DESC LIMIT $limit");

  if($query->num_rows > 0){ ?>
    <span class="pull-right">
      <strong class="text-success">Total no. of rows: <?php echo $rowCount;?></strong>
    </span>
    <br>
    <div class="table-responsive">
      <table class="table table-striped table-bordered" id="myTable">
        <thead>
          <tr>
            <th><label class="checkbox-inline"><input type="checkbox" class="select-all form-check-input" /><span class="lbl"></span> </label></th>
            <th>No.</th>
            <th>Dental</th>
            <th>Medical</th>
            <th width="100px">Last Name</th>
            <th width="100px">First Name</th>
            <th>Middle</th>
            <th>Suffix</th>
            <th width="110px">Student No.</th>
            <th>Program</th>
            <th>Year</th>    
            <th>Added</th>        
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
          while($row = $query->fetch_assoc()){
          $start++; ?>
          <tr id="table-row-<?php echo $row["StatsID"]; ?>">
            <td>
              <label class="checkbox-inline"><input type="checkbox" name="chk[]" id="check" class="chk-box form-check-input" value="<?php echo $row['StudentID']; ?>"  /> <span class="lbl"></span></label>
            </td>
            <td><?php echo $start;?></td>
            <td><?php echo $row['dent']; ?></td>
            <td><?php echo $row['med']; ?></td>
            <td contenteditable="true" onblur="saveToDatabase(this,'last_name','<?php echo $row["StatsID"]; ?>')" ondblclick="editRow(this);"><span title="Click to quick edit." data-toggle="tooltip" data-placement="right"><?php echo $row['last_name']; ?></span></td>
            <td contenteditable="true" onblur="saveToDatabase(this,'first_name','<?php echo $row["StatsID"]; ?>')" ondblclick="editRow(this);"><span title="Click to quick edit." data-toggle="tooltip" data-placement="right"><?php echo $row['first_name']; ?></span></td>
            <td contenteditable="true" onblur="saveToDatabase(this,'middle_name','<?php echo $row["StatsID"]; ?>')" ondblclick="editRow(this);"><span title="Click to quick edit." data-toggle="tooltip" data-placement="right"><?php echo $row['middle_name']; ?></span></td>
            <td contenteditable="true" onblur="saveToDatabase(this,'ext','<?php echo $row["StatsID"]; ?>')" ondblclick="editRow(this);"><span title="Click to quick edit." data-toggle="tooltip" data-placement="right"><?php echo $row['ext'];?></span></td>
            <td contenteditable="true" onblur="saveToDatabase(this,'studentNo','<?php echo $row["StatsID"]; ?>')" ondblclick="editRow(this);"><span title="Click to quick edit." data-toggle="tooltip" data-placement="right"><?php echo $row['studentNo']; ?></span></td>
            <td><?php echo $row['program_name'];?></td>
            <td><?php echo $row['yearLevel'];?></td>
            <td><?php echo date('m/d/Y <br/> h:i a', strtotime($row['date_registered']));?></td>
            <td>
              <div class="btn-toolbar action" role="toolbar">
                <a href="profile.php?StudentID=<?php echo $row['StudentID']; ?>" class="btn btn-sm btn-warning" title="Profile" data-toggle="tooltip" data-placement="top"> <i class="glyphicon glyphicon-user"></i></a>
                <a class="btn btn-sm btn-primary" title="Edit" data-toggle="modal" data-target="#view-modal" data-placement="top" data-id="<?php echo $row['StudentID']; ?>" id="getUser"> <i class="fa fa-pencil"></i></a>
                <button class="btn btn-sm btn-danger delete" title="Delete" data-toggle="tooltip" data-placement="top" value="<?php echo $row['StudentID']; ?>"><span class = "glyphicon glyphicon-trash"></span></button>
              </div>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- End of Table Responsive -->
    <?php echo $pagination->createLinks();  
  } else { ?>
    <div  align="center">
      <span class="pull-right">
        <strong class="text-success">Total no. of rows: 0</strong>
      </span>
      <br>
      <div class="table-responsive">
        <table class="table table-striped table-bordered" id="myTable">
          <thead>
            <tr>
              <th><label class="checkbox-inline"><input type="checkbox" class="select-all form-check-input" /><span class="lbl"></span> </label></th>
              <th>No.</th>
              <th>Dental</th>
              <th>Medical</th>
              <th width="100px">Last Name</th>
              <th width="100px">First Name</th>
              <th>Middle</th>
              <th>Suffix</th>
              <th width="110px">Student No.</th>
              <th>Program</th>
              <th>Year</th>    
              <th>Added</th>        
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="13" align="center">
                <p>No records found</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- End of Table Responsive -->
    </div> 
    <?php
  }
}
?>

<script type="text/javascript">
$(document).ready(function() {

  $("[data-toggle=tooltip]").tooltip();
  $("[data-toggle=modal]").tooltip();

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
      method:'POST',
      data:{id:id},
      success:function() {
        for(var i=0; i<id.length; i++) {
          $('tr#table-row-'+id[i]+'').css('background-color', '#ddd');
          $('tr#table-row-'+id[i]+'').fadeOut('slow');
        }
        $("#tbl_students").load("../students/tbl_students.php");
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

//Send SMS
function send_sms() {
  var id = [];       
  $('input[name="chk[]"]:checked').each(function(i){
    id[i] = $(this).val();
  });
         
  if(id.length === 0) { //tell you if the array is empty
    alert("Please Select atleast one checkbox");
    return false;
  }
  else {
    $.ajax({
      url:'send_sms.php',
      method:'POST',
      data:{id:id},
      success : function(response) {           
        if(response=="ok"){
          $.bootstrapGrowl("<span class='fa fa-check'></span> Message sent!", // Messages
            { // options
              type: "success", // info, success, warning and danger
              ele: "body", // parent container
              offset: {
                from: "top",
                amount: 20
              },
              align: "right", // right, left or center
              width: 300,
              allow_dismiss: true, // add a close button to the message
              stackup_spacing: 10
            }
          );
        }
        else {
          $.bootstrapGrowl("<i class='fa fa-info'></i> "+response, { // Messages
            // options
            type: "danger", // info, success, warning and danger
            ele: "body", // parent container
            offset: {
              from: "top",
              amount: 20
            },
            align: "right", // right, left or center
            width: 300,
            allow_dismiss: true, // add a close button to the message
            stackup_spacing: 10
          });
        }
      }
    });
  }  
}

// Quick Edit 
$('document').ready(function() {
  $('td:contains("Pending")').css('color', 'red');
  $('td:contains("Ok")').css('color', 'green');
});

function editRow(editableObj) {
  $(editableObj).css("background","white");
}

function saveToDatabase(editableObj,column,id) {
  $(editableObj).css("background","#ddd url(/lu_clinic/images/loading.gif) no-repeat right");
  $.ajax({
    url: "quick_edit.php",
    type: "POST",
    data: 'med='+column+'&dent='+column+'&editval='+$(editableObj).text()+'&StatsID='+id,
    success: function(data){
      $(editableObj).css("background","#FDFDFD");
      $('#overlay').show();
      $('#overlay').fadeOut();
      $('td:contains("Pending")').css('color', 'red');
      $('td:contains("Ok")').css('color', 'green');

    }
  });
}
</script>