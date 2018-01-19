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
    $prog = $_POST["program_id"];

    if ( !empty($keywords) && !empty($prog) ) {
      $whereSQL = " WHERE program = '".$prog."' AND last_name LIKE '%".$keywords."%' or first_name LIKE '%".$keywords."%' or middle_name LIKE '%".$keywords."%' or ext LIKE '%".$keywords."%' ";
    }
    elseif ( !empty($keywords) ) {
      $whereSQL = " WHERE last_name LIKE '%".$keywords."%' or first_name LIKE '%".$keywords."%' or middle_name LIKE '%".$keywords."%' or ext LIKE '%".$keywords."%' ";
    }
    elseif ( !empty($prog) ) {
      $whereSQL = " WHERE program = '".$prog."' ";
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
                <th width="100px">Last Name</th>
                <th width="100px">First Name</th>
                <th width="120px">Middle Name</th>
                <th>Ext.</th>
                <th width="100px">Student No.</th>
                <th>Program</th>
                <th width="50px">Year</th>   
                <th width="100px">Date Added</th>         
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
                <td contenteditable="true" onBlur="saveToDatabase(this,'last_name','<?php echo $row["StatsID"]; ?>')" onClick="editRow(this);"><?php echo $row['last_name']; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'first_name','<?php echo $row["StatsID"]; ?>')" onClick="editRow(this);"><?php echo $row['first_name']; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'middle_name','<?php echo $row["StatsID"]; ?>')" onClick="editRow(this);"><?php echo $row['middle_name']; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'ext','<?php echo $row["StatsID"]; ?>')" onClick="editRow(this);"><?php echo $row['ext'];?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'studentNo','<?php echo $row["StatsID"]; ?>')" onClick="editRow(this);"><?php echo $row['studentNo']; ?></td>
                <td><?php echo $row['program_name'];?></td>
                <td><?php echo $row['yearLevel'];?></td>
                <td><?php echo get_timeago(strtotime($row['date_registered']));?></td>
                <td style="width: 145px;">
                  <a href="profile.php?StudentID=<?php echo $row['StudentID']; ?>" class="btn btn-sm btn-warning" title="View Profile" data-toggle="tooltip" data-placement="bottom"> <i class="fa fa-external-link" aria-hidden="true"></i></a> | <a class="btn btn-sm btn-primary" title="Edit" data-toggle="modal" data-target="#view-modal" data-id="<?php echo $row['StudentID']; ?>" id="getUser"> <i class="fa fa-pencil"></i></a> | <button class="btn btn-sm btn-danger delete" title="Delete" data-toggle="tooltip" data-placement="bottom" value="<?php echo $row['StudentID']; ?>"><span class = "glyphicon glyphicon-trash"></span></button>
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
  <?php } 
  else { 
    echo "<div class='alert alert-warning'>No result</div>"; 
  }
} 
else {
  $start = !empty($_POST['page'])?$_POST['page']:0;
  $limit = 5;

  //get number of rows
  $queryNum = $DB_con->query("SELECT COUNT(*) as postNum FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id`");
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
  $query = $DB_con->query("SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` ORDER BY modified DESC LIMIT $limit");

  if($query->num_rows > 0){ ?>
  <div class="row">
    <div class="container-fluid">
      <form method="post" name="frm">
        <label class="checkbox-inline"><input type="checkbox" class="select-all form-check-input" /><span class="lbl"></span> <strong><span id="check-all">Check</span> <span id="uncheck-all" style="display: none;">Uncheck</span> All</strong></label>
        <span style="word-spacing:normal;"> | With selected :</span>
        <label id="actions">
          <span><a class="text-danger" style="cursor: pointer;" onClick="delete_records();" title="Click to delete selected rows" data-toggle="tooltip"> Delete</a></span>
        </label>
        <span class="pull-right"><strong class="text-success">Total no. of rows: <?php echo $rowCount;?></strong></span>
        <br>
        <div class="table-responsive">
          <table class="table  table-striped table-bordered" id="myTable">
            <thead>
              <tr>
                <th></th>
                <th>No.</th>
                <th width="100px">Last Name</th>
                <th width="100px">First Name</th>
                <th width="120px">Middle Name</th>
                <th>Ext.</th>
                <th width="100px">Student No.</th>
                <th>Program</th>
                <th width="50px">Year</th>    
                <th width="100px">Date Added</th>        
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
                <td contenteditable="true" onBlur="saveToDatabase(this,'last_name','<?php echo $row["StatsID"]; ?>')" onClick="editRow(this);"><?php echo $row['last_name']; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'first_name','<?php echo $row["StatsID"]; ?>')" onClick="editRow(this);"><?php echo $row['first_name']; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'middle_name','<?php echo $row["StatsID"]; ?>')" onClick="editRow(this);"><?php echo $row['middle_name']; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'ext','<?php echo $row["StatsID"]; ?>')" onClick="editRow(this);"><?php echo $row['ext'];?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'studentNo','<?php echo $row["StatsID"]; ?>')" onClick="editRow(this);"><?php echo $row['studentNo']; ?></td>
                <td><?php echo $row['program_name'];?></td>
                <td><?php echo $row['yearLevel'];?></td>
                <td><?php echo get_timeago(strtotime($row['date_registered']));?></td>
                <td style="width: 145px;">
                  <a href="profile.php?StudentID=<?php echo $row['StudentID']; ?>" id="view_profile" class="btn btn-sm btn-warning" title="View Profile" data-toggle="tooltip" data-placement="bottom"> <i class="fa fa-external-link" aria-hidden="true"></i></a> | <a class="btn btn-sm btn-primary" title="Edit" data-toggle="modal" data-target="#view-modal" data-id="<?php echo $row['StudentID']; ?>" id="getUser"> <i class="fa fa-pencil"></i></a> | <button class="btn btn-sm btn-danger delete" title="Delete" data-toggle="tooltip" data-placement="bottom" value="<?php echo $row['StudentID']; ?>"><span class = "glyphicon glyphicon-trash"></span></button>
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
  $('document').ready(function() {

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

  // Quick Edit 
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