<?php
  //Include pagination class file
  include('../includes/Pagination.php');

  //Include database configuration file
  include('../includes/dbconnect.php');

  $DB_con = new mysqli("localhost", "root", "", "records");

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
        <label class="checkbox-inline"><input type="checkbox" class="select-all" /> <strong><span id="check-all">Check</span> <span id="uncheck-all" style="display: none;">Uncheck</span> All</strong></label>
        <span style="word-spacing:normal;"> | With selected :</span>
        <label id="actions">
          <span><a class="text-danger" style="cursor: pointer;" onClick="delete_records();" title="Click to delete selected rows" data-toggle="tooltip"> Delete</a>
        </label>
        <br>
        <div class="table-responsive">
          <table class="table  table-striped table-bordered" id="myTable">
            <thead>
              <tr>
                <th></th>
                <th>No.</th>
                <th width="70px">Medical</th>
                <th width="70px">Dental</th>
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
              while($row = $query->fetch_assoc()){ ?>
              <tr data-row-id="<?php echo $row['StatsID'];?>">
                <td><input type="checkbox" name="chk[]" class="chk-box" value="<?php echo $row['FacultyID']; ?>"  /></td>
                <td><?php echo $row['FacultyID'];?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'med','<?php echo $row['StatsID']; ?>')" onClick="editRow(this);">
                    <?php echo $row['med']; ?> 
                </td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'dent','<?php echo $row['StatsID']; ?>')" onClick="editRow(this);">
                    <?php echo $row['dent']; ?>
                </td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'last_name','<?php echo $row['StatsID']; ?>')" onClick="editRow(this);"><?php echo strtoupper($row['last_name']); ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'first_name','<?php echo $row['StatsID']; ?>')" onClick="editRow(this);"><?php echo strtoupper($row['first_name']); ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'middle_name','<?php echo $row['StatsID']; ?>')" onClick="editRow(this);"><?php echo strtoupper($row['middle_name']); ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'ext','<?php echo $row['StatsID']; ?>')" onClick="editRow(this);"><?php echo $extension.strtoupper($row['ext']);?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'facultyNo','<?php echo $row['StatsID']; ?>')" onClick="editRow(this);"><?php echo $row['facultyNo']; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'dept','<?php echo $row['StatsID']; ?>')" onClick="editRow(this);"><?php echo $row['dept_name'];?></td>
                <td style="width: 145px;"><a href="profile.php?FacultyID=<?php echo $row['FacultyID']; ?>" class="btn btn-sm btn-warning" title="View More Details" data-toggle="tooltip" data-placement="bottom"> <i class="fa fa-external-link" aria-hidden="true"></i></a> | <a class="btn btn-sm btn-primary" title="Edit" data-toggle="modal" data-target="#view-modal" data-id="<?php echo $row['FacultyID']; ?>" id="getUser"> <i class="fa fa-pencil"></i></a> | <button class="btn btn-sm btn-danger delete" title="Delete" data-toggle="tooltip" data-placement="bottom" value="<?php echo $row['FacultyID']; ?>"><span class = "glyphicon glyphicon-trash"></span></button>
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
<?php } else { echo "<div class='alert alert-warning'>No result</div>"; }?>
<script type="text/javascript">
  //  for select / deselect all
  $('document').ready(function() {
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

  //  for select / deselect all
  function delete_records() {
      document.frm.action = "delete_mul.php";
      document.frm.submit();
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