<?php
  //Include pagination class file
  include('Pagination.php');

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
  $query = $DB_con->query("SELECT * FROM `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id` ORDER BY date_updated ASC LIMIT $limit");

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
                <th>Faculty No.</th>
                <th>Department</th>           
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
              while($row = $query->fetch_assoc()){ 
                $postID = $row['FacultyID'];
                if (($row['med']) != 'Ok') {
                    $color = "red";
                    $status = "Ok";
                }
                else {
                    $color = "green";
                }
                if (($row['dent']) != 'Pending') {
                    $color2 = "green";
                }
                else {
                    $color2 = "red";
                }
                if (!empty($row['ext'])) {
                    $extension = ", ";
                }
                else {
                    $extension = " ";
                }
            ?>
              <tr data-row-id="<?php echo $row['FacultyID'];?>">
                <td><input type="checkbox" name="chk[]" class="chk-box" value="<?php echo $row['FacultyID']; ?>"  /></td>
                <td><?php echo $row['FacultyID'];?></td>
                <td style="color:<?php echo $color;?>;">
                    <?php echo $row['med']; ?> 
                </td>
                <td style="color:<?php echo $color2;?>;">
                    <?php echo $row['dent']; ?>
                </td>
                <td><?php echo strtoupper($row['last_name']); ?></td>
                <td><?php echo strtoupper($row['first_name']);echo $extension.strtoupper($row['ext']); ?></td>
                <td><?php echo strtoupper($row['middle_name']); ?></td>
                <td><?php echo $row['facultyNo']; ?></td>
                <td><?php echo $row['dept_name'];?></td>
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