<?php
	require_once '../includes/dbconnect.php';
    $DB_con = new mysqli("localhost", "root", "", "records");
    $result = mysqli_query($DB_con,"SELECT * FROM `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` JOIN `department` ON `faculties`.`dept`=`department`.`dept_id` ORDER BY FacultyID DESC"); 
    $count = $result->num_rows;
	if(isset($_POST['show'])){
		?>
		<div class="row">
                <div class="container-fluid">
                <form method="post" name="frm">
                <label><input type="checkbox" class="select-all" /> Check / Uncheck All</label>
                <label id="actions">
                    <span style="word-spacing:normal;"> | With selected :</span>
                    <span><a class="text-danger" href="#" onClick="delete_records();"> <span class="glyphicon glyphicon-trash"></span> Delete</a></span>
                </label>
                <label class="pull-right">Total number of rows: <?php echo $count; ?></label>
                <br>
                <div class="table-responsive">
                <?php        
                if ($result->num_rows != 0) { ?>
                    <table class="table  table-striped table-bordered sortable" id="myTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th title="Click to sort" data-toggle="tooltip">Medical</th>
                                <th title="Click to sort">Dental</th>
                                <th title="Click to sort">Last Name</th>
                                <th title="Click to sort">First Name</th>
                                <th title="Click to sort">Middle Initial</th>
                                <th title="Click to sort">Faculty No.</th>
                                <th title="Click to sort">Department</th>      
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
					<?php
						while($row = $result->fetch_assoc()){
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
								<tr data-status="<?php echo $status;?>">
                                <td><input type="checkbox" name="chk[]" class="chk-box" value="<?php echo $row['FacultyID']; ?>"  /></td>
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
								<td style="width: 145px;"><a href="profile.php?FacultyID=<?php echo $row['FacultyID']; ?>" class="btn btn-sm btn-warning" title="View" data-toggle="tooltip"> <i class="fa fa-external-link" aria-hidden="true"></i></a> |  <a href="edit_faculty.php?FacultyID=<?php echo $row['FacultyID']; ?>" class="btn btn-sm btn-primary" title="Edit" data-toggle="tooltip"> <i class="fa fa-pencil"></i></a> | <button class="btn btn-sm btn-danger delete" title="Delete" data-toggle="tooltip" value="<?php echo $row['FacultyID']; ?>"><span class = "glyphicon glyphicon-trash"></span></button>
								</td>
							</tr>
                        <?php }
                            } 
                        else {
                                $errMSG = "No records found."; 
                        }?>
                    </tbody>
                </table>
                <?php 
                        if(isset($errMSG)){ ?>

                        <div class="alert alert-warning">
                            <span class="glyphicon glyphicon-info"></span> 
                            <?php echo $errMSG; ?>
                        </div>
                </div>
                <!-- End of Table Responsive -->
                </form>
                </div>
                <!-- End of Container Fluid -->
                </div>
                <!-- End of Table -->
		<?php
	}}

?>
<script type="text/javascript">
        //  for select / deselect all
    $('document').ready(function() {
        $(".select-all").change(function () {
            $(".chk-box").prop('checked', $(this).prop("checked"));
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
<script src="../assets/js/sorttable.js"></script>