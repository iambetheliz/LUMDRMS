<?php
	require_once '../includes/dbconnect.php';
    $DB_con = new mysqli("localhost", "root", "", "records");
    $result = mysqli_query($DB_con,"SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` JOIN `program` ON `students`.`program`=`program`.`program_id` ORDER BY StudentID DESC"); 
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
                                <th title="Click to sort" >Middle Name</th>
                                <th title="Click to sort">Student No.</th>
                                <th title="Click to sort">Program</th>
                                <th title="Click to sort">Year</th>             
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
							?>
								<tr data-status="<?php echo $status;?>">
                                <td><input type="checkbox" name="chk[]" class="chk-box" value="<?php echo $row['StudentID']; ?>"  /></td>
                                <td style="color:<?php echo $color;?>;">
                                    <?php echo $row['med']; ?> 
                                </td>
                                <td style="color:<?php echo $color2;?>;">
                                    <?php echo $row['dent']; ?>
                                </td>
                                <td><?php echo strtoupper($row['ext'])." "; echo strtoupper($row['last_name']); ?></td>
                                <td><?php echo strtoupper($row['first_name']); ?></td>
                                <td><?php echo strtoupper($row['middle_name']); ?></td>
                                <td><?php echo $row['studentNo']; ?></td>
                                <td><?php echo $row['program_name'];?></td>
                                <td><?php echo $row['yearLevel'];?></td>
								<td style="width: 145px;"><a href="profile.php?StudentID=<?php echo $row['StudentID']; ?>" class="btn btn-sm btn-warning" title="View" data-toggle="tooltip"> <i class="fa fa-external-link" aria-hidden="true"></i></a> |  <a href="edit_student.php?StudentID=<?php echo $row['StudentID']; ?>" class="btn btn-sm btn-primary" title="Edit" data-toggle="tooltip"> <i class="fa fa-pencil"></i></a> | <button class="btn btn-sm btn-danger delete" title="Delete" data-toggle="tooltip" value="<?php echo $row['StudentID']; ?>"><span class = "glyphicon glyphicon-trash"></span></button>
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
        window.location.href = 'records.php';
        return false;
    });
    </script>
<script src="../assets/js/sorttable.js"></script>