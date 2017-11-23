<?php
  ob_start();
  require_once '../includes/dbconnect.php';
  if(empty($_SESSION)) // if the session not yet started 
   session_start();
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: ../index.php?attempt");
    exit;
  }

  $DB_con = new mysqli("localhost", "root", "", "records");

    if ($DB_con->connect_errno) {
      echo "Connect failed: ", $DB_con->connect_error;
    exit();
    }

  // select loggedin users detail
  $res = "SELECT * FROM users WHERE userId=".$_SESSION['user'];
  $result = $DB_con->query($res);
  $userRow = $result->fetch_array(MYSQLI_BOTH);
    
    //Render facebook profile data
    $output = '';
    if(!empty($userRow)){
        $account = '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;'. ucwords($userRow['userName']).'&nbsp;&nbsp;<b class="caret"></b></a>';
        $logout = '<a href="logout.php?logout"><i class="glyphicon glyphicon-off">'.'</i>&nbsp;&nbsp;Logout</a>';
    }else{
        $output .= '<h3 class="alert alert-danger">Your google account does not exists in our database!<br>Redirecting to login page ...</h3>';
        header("Refresh:3; logout.php?logout");
    }

    if (isset($_GET['success'])) {
    	$successMSG = "<span class='glyphicon glyphicon-ok'></span> Data added successfully!";
    	header('Refresh:2; records.php');
    }
    elseif (isset($_GET['error'])) {
        $errorMSG = "<span class='glyphicon glyphicon-warning text-danger'></span> Something went wrong, try again later.";
        header('Refresh:3; records.php');
    }
    elseif (isset($_GET['deleteSuccess'])) {
        $successMSG = "<span class='glyphicon glyphicon-ok'></span> Data successfully deleted!";
        header('Refresh:3; records.php');
    }
    elseif (isset($_GET['deleteError'])) {
        $errorMSG = 'At least one checkbox Must be Selected !!!';
        header('Refresh:3; records.php');
    }

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Faculty Records | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/style.css" rel="stylesheet" type="text/css">
<style type="text/css">    
.pagination {
    display: inline-block;
    padding-left: 0;
    margin: 0;
    border-radius: 4px;
}
</style>
</head>
<body>

    <!-- Navbar -->
    <?php include 'header.php'; ?>
    <!-- End of Navbar -->

    <!-- Content -->
	<div id="wrapper">

        <!-- Sidebar Menu Items -->
        <div id="sidebar-wrapper">
          <nav id="spy">
            <ul class="sidebar-nav">                    
                <li>
                    <a href="/lu_clinic"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp; Dashboard</a>
                </li>
                <li>
                    <a href="/lu_clinic/calendar/"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp; Activities</a>
                </li>
                <li class="active have-child" role="presentation">
                    <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><i class="fa fa-table" aria-hidden="true"></i>&nbsp;&nbsp; Records &nbsp;&nbsp;<span class="caret"></span></a>
                    <ul id="demo" class="panel-collapse collapse in">
                        <li>
                            <a href="/lu_clinic/students/index.php"><span class="glyphicon glyphicon-education"></span>&nbsp;&nbsp; Students</a>
                        </li>
                        <li class="active">
                            <a href="/lu_clinic/faculties/records.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; Faculties</a>
                        </li>
                    </ul>
                </li>
            </ul>
          </nav>
        </div>  
        <!-- End of Sidebar --> 

	    <!-- Begin Main Screen -->
        <div id="page-content-wrapper">
          <div class="page-content">
            <div class="container-fluid">   

    	        <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Faculties and Staffs Records <small class="text-muted text-success pull-right"><?php  echo $successMSG; echo $errorMSG; ?></small></h1>
                    </div>
                </div>
                <!-- End of Page Heading -->
                
                <!-- Buttons -->
                <div class="container-fluid">
                  <div class="row">
                    <!-- Start btn-toolbar -->
                	<div class="btn-toolbar">
                    	<a href="new_faculty.php" class="btn btn-success" title="Add" data-toggle="tooltip">Add New</a>
                        <!-- Filter -->
                        <!-- End -->
                        <!-- Sort button -->
                        <div class="btn-group">
                            <button type="button" id="sort" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-sort"></span> Sort by <span class="caret"></span>
                            </button>
                            <?php 
                                $table_data='date_registered';
                                $sort='DESC';
                                if(isset($_GET['sorting']))
                                    {
                                        if($_GET['sorting']=='ASC')
                                            {
                                                $sort='DESC';
                                            }
                                        else { $sort='ASC'; }
                                    }
                                if(isset($_GET['table_data']))
                                    {
                                        if($_GET['table_data']=='last_name')
                                            { 
                                                $table_data = "last_name";  
                                            }
                                        elseif($_GET['table_data']=='program')
                                            { 
                                                $table_data = "program";  
                                            }
                                        elseif($_GET['table_data']=='yearLevel')
                                            { 
                                                $table_data = "yearLevel";  
                                            }
                                        elseif($_GET['table_data']=='date_registered')
                                            { 
                                                $table_data="date_registered"; 
                                                $sort="DESC";
                                            }
                                    }
                            ?>
                            <ul class="dropdown-menu">
                                <li><a href="records.php?sorting='.$sort.'&table_data=last_name">Last Name</a></li>
                                <li><a href="records.php?sorting='.$sort.'&table_data=program">Program</a></li>
                                <li><a href="records.php?sorting='.$sort.'&table_data=yearLevel">Year Level</a></li>
                                <li><a href="records.php">Latest (Default)</a></li>
                            </ul>
                        </div>
                        <!-- End Sort button -->

                        <!-- Filter button -->
                        <div class="btn-group" data-toggle="buttons">         
                        </div>
                        <!-- End Filter button -->

                        <!-- Search Button -->
                        <form action="" method="get">
                        <div class="form-inline">
                          <div class="input-group pull-right">
                            <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                            <span class="input-group-btn"><button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button></span>
                          </div>
                        </div>
                        </form>                        
                        <!-- End of Search Button -->

                    </div>
                    <!-- End btn-toolbar -->
                  </div>
            	</div>
                <!-- End of Buttons -->

                <!-- Table -->
                <?php 
  					require_once '../includes/dbconnect.php';
                	include '../includes/pagination.php';

                	$DB_con = new mysqli("localhost", "root", "", "records");

                	$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);

                    $result = mysqli_query($DB_con,"SELECT * FROM `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo`"); 
                    $count = $result->num_rows;
    				
    				if ($page <= 0) $page = 1;
    					$per_page = 5; // Set how many records do you want to display per page.
    
    					if (isset($_GET['search'])) {
    						$search = $_GET['search'];
    						$search = $DB_con->real_escape_string($search);
    
        					if (empty($search)) {
            					$output = "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close' id='close'><span aria-hidden='true'>&times;</span></button>Please enter a keyword.</div>";
        					}
                            else {
                                $output = '<div class="alert alert-info" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" id="close"><span aria-hidden="true">&times;</span></button>Showing result for <strong>"'.$search.'."</strong></div>';
                            }
    
    						$startpoint = ($page * $per_page) - $per_page;
    						$statement = "`faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` WHERE CONCAT(`last_name`,`first_name`,`middle_name`,`ext`) LIKE '%".$search."%' OR CONCAT(program,yearLevel,acadYear,med,dent,`faculty_stats`.`facultyNo`) LIKE '%".$search."%'";
    						$result = mysqli_query($DB_con,"SELECT * FROM {$statement} ORDER BY $table_data $sort LIMIT {$startpoint} , {$per_page}");
                            $count = $result->num_rows;
						}
						else {
    						$startpoint = ($page * $per_page) - $per_page;
                            $statement = "`faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo`";
    						$result = mysqli_query($DB_con,"SELECT * FROM $statement ORDER BY {$table_data} {$sort} LIMIT {$startpoint} , {$per_page}");
						}
                ?>
                <br>
                <?php 
                    if (isset($_GET['search'])) {
    				    echo $output;
				    }
                ?>
                <?php
                if ($result->num_rows != 0) { ?>
                <!-- Start of Table -->
                <div class="row">
                	<div class="col-lg-12">
                    <form method="post" name="frm">
                    <label><input type="checkbox" class="select-all" /> Check / Uncheck All</label>
                    <label id="actions">
                    <span style="word-spacing:normal;"> | With selected :</span>
                    <span><a class="text-danger" href="#" onClick="delete_records();"> <span class="glyphicon glyphicon-trash"></span> Delete</a></span>
                    </label>
                    <label class="pull-right">Total number of rows: <?php echo $count; ?></label>
                    <br>
                    <div class="table-responsive">
                	<table class="table  table-striped table-bordered" id="myTable">
                		<thead style="background-color:#eee;cursor: pointer;">
                			<tr>
                                <th></th>
                                <th title="Click to sort" onclick="sortTable(0)">Medical <i class="fa fa-sort"></i></th>
                                <th title="Click to sort" onclick="sortTable(1)">Dental <i class="fa fa-sort"></i></th>
                				<th title="Click to sort" onclick="sortTable(2)">Last Name <i class="fa fa-sort"></i></th>
                				<th title="Click to sort" onclick="sortTable(3)">First Name <i class="fa fa-sort"></i></th>
                				<th title="Click to sort" onclick="sortTable(4)">Middle Name <i class="fa fa-sort"></i></th>
                				<th title="Click to sort" onclick="sortTable(5)">Faculty No. <i class="fa fa-sort"></i></th>
                				<th title="Click to sort" onclick="sortTable(6)">Program <i class="fa fa-sort"></i></th>
                				<th title="Click to sort" onclick="sortTable(7)">Year <i class="fa fa-sort"></i></th>
                				<th title="Click to sort" onclick="sortTable(8)">Academic Year <i class="fa fa-sort"></i></th>
                				<th>Action</th>
                			</tr>
                		</thead>
                		<tbody>
                			<?php 
    						// displaying records.
    						while ($row = $result->fetch_assoc()){ 
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
                                <td><input type="checkbox" name="chk[]" class="chk-box" value="<?php echo $row['FacultyID']; ?>"  /></td>
                                <td style="color:<?php echo $color;?>;">
                                    <?php echo $row['med']; ?> 
                                </td>
                                <td style="color:<?php echo $color2;?>;">
                                    <?php echo $row['dent']; ?>
                                </td>
                				<td><?php echo strtoupper($row['ext'])." "; echo strtoupper($row['last_name']); ?></td>
                				<td><?php echo strtoupper($row['first_name']); ?></td>
                				<td><?php echo strtoupper($row['middle_name']); ?></td>
                				<td><?php echo $row['facultyNo']; ?></td>
                				<td><?php echo $row['program'];?></td>
                				<td><?php echo $row['yearLevel'];?></td>
                				<td><?php echo $row['acadYear'];?></td>
                				<td width="145px"><a href="profile.php?FacultyID=<?php echo $row['FacultyID']; ?>" class="btn btn-sm btn-warning" title="View" data-toggle="tooltip"> <i class="fa fa-external-link" aria-hidden="true"></i></a> | <a href="edit_faculty.php?FacultyID=<?php echo $row['FacultyID']; ?>" class="btn btn-sm btn-primary" title="Edit" data-toggle="tooltip"> <i class="fa fa-pencil"></i></a> | <a href="action.php?action_type=delete&FacultyID=<?php echo $row['FacultyID']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');" title="Delete" data-toggle="tooltip"> <span class="glyphicon glyphicon-trash"></span></a></td>
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
                            <span class="glyphicon glyphicon-info"></span> <?php echo $errMSG; ?>
                        </div>
                            
                    <?php }
                    ?>
                    </div>
                    </form>
                	</div>
                </div>
                <!-- End of Table -->

                <?php echo pagination($statement,$per_page,$page,$url='?');?>
                
            </div>  
          </div>
        </div>
        <!-- End of Main Screen -->
  
    </div>
    <!-- End of Content -->

    <footer class="footer">
        <div class="container-fluid">
            <p class="text-muted" align="right"><a href="http://lu.edu.ph/" target="_blank">Laguna University</a> &copy; <script type="text/javascript">document.write(new Date().getFullYear());</script></p>
        </div>
    </footer>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/index.js" type="text/javascript"></script>
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
    
</body>
</html>
<?php ob_end_flush(); ?>