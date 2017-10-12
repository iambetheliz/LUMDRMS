<?php
  ob_start();
  require_once '../dbconnect.php';
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
        $account = '<a href="#"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;'. ucwords($userRow['userName']).'</a>';
        $logout = '<a href="logout.php?logout"><i class="glyphicon glyphicon-off">'.'</i>&nbsp;&nbsp;Logout</a>';
    }else{
        $output .= '<h3 class="alert alert-danger">Your google account does not exists in our database!<br>Redirecting to login page ...</h3>';
        header("Refresh:3; logout.php?logout");
    }

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/style.css" rel="stylesheet" type="text/css">
</head>
<body>

  <!-- Navbar -->
  <?php include 'header.php'; ?>
  <!-- End of Navbar -->

  <!-- Content -->
	<div id="wrapper" class="toggled">

        <!-- Sidebar Menu Items -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">                    
                <li>
                    <a href="/lu_clinic"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp; Dashboard</a>
                </li>
                <li class="active">
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp; Tables &nbsp;&nbsp;<span class="caret"></span></a>
                    <ul id="demo" class="collapse in">
                        <li>
                            <a href="/lu_clinic/students/tbl_rec.php"><span class="glyphicon glyphicon-education"></span>&nbsp;&nbsp; Students</a>
                        </li>
                        <li>
                            <a href="/lu_clinic/faculties/add_new.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; Faculties</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>  
        <!-- End of Sidebar --> 

	    <!-- Begin Main Screen -->
        <div id="page-content-wrapper">
            <div class="container-fluid">   
    	        <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Students Medical Records</h1>
                    </div>
                </div>
                <!-- End of Page Heading -->
                
                <!-- Buttons -->
                <div class="row">
                    <div class="col-xs-4">
                    	<a href="medical_form.php" class="btn btn-success">Add New</a>
                    </div>
                    <div class="col-xs-3"></div>
                    <div class="col-xs-2">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-sort"></span> Sort by <span class="caret"></span>
                            </button>
                            <?php 
                                $table_data='id';
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
                                        if($_GET['table_data']=='age')
                                            { 
                                                $table_data = "age";  
                                            }
                                        if($_GET['table_data']=='last_name')
                                            { 
                                                $table_data = "last_name";  
                                            }
                                        elseif($_GET['table_data']=='id')
                                            { 
                                                $table_data="id"; 
                                                $sort="ASC";
                                            }
                                    }
                            ?>
                            <ul class="dropdown-menu">
                                <li><a href="tbl_rec.php?sorting='.$sort.'&table_data=last_name">Surname</a></li>
                            </ul>
                        </div>
                    </div>
                    <form action="" method="get">
                    <div class="col-xs-3 text-right">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search for terms..">
                            <span class="input-group-btn"><button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button></span>
                        </div>
                    </div>
                	</form>
                </div>
                <!-- End of Buttons -->
                <br>
                <!-- Table -->
                <?php 
  					require_once '../dbconnect.php';
                	include '../includes/pagination.php';

                	$DB_con = new mysqli("localhost", "root", "", "records");

                	$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
    				
    				if ($page <= 0) $page = 1;
    				$per_page = 10; // Set how many records do you want to display per page.
    
    					if (isset($_GET['search'])) {
    						$search = $_GET['search'];
    						$search = $DB_con->real_escape_string($search);
    
        					if (empty($search)) {
            					$output1 = "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Please enter a keyword.</div>";
        					}
        					else {
            					$output1 = '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Showing result for <strong>"'.$search.'."</strong></div>';
        					}
    
    						$startpoint = ($page * $per_page) - $per_page;
    						$statement = "`students` WHERE CONCAT(`id`, `last_name`,`first_name`, `middle_name`,`age`) LIKE '%".$search."%'";
    						$result = mysqli_query($DB_con,"SELECT * FROM {$statement} ORDER BY $table_data $sort LIMIT {$startpoint} , {$per_page}");
						}
						else {
    						$startpoint = ($page * $per_page) - $per_page;
    						$statement = "`students` WHERE CONCAT(`id`, `last_name`,`first_name`, `middle_name`, `age`)";
    						$result = mysqli_query($DB_con,"SELECT * FROM {$statement} ORDER BY $table_data $sort LIMIT {$startpoint} , {$per_page}"); 
						}
                ?>
                <?php if (isset($_GET['search'])) {
    				echo $output1;
				}  ?>
                <div class="row">
                	<div class="col-lg-12">
                	<table class="table sortable table-responsive table-striped table-bordered">
                		<thead style="background-color:#eee;cursor: pointer;">
                			<tr>
                				<th>Surname</th>
                				<th>First Name</th>
                				<th>Middle Name</th>
                				<th>Gender</th>
                				<th>Program</th>
                				<th>Year Level</th>
                				<th>Academic Year</th>
                				<th>Action</th>
                			</tr>
                		</thead>
                		<?php
						if ($result->num_rows != 0) { ?>
                		<tbody>
                			<?php 
    						// displaying records.
    						while ($row = $result->fetch_assoc()){ ?>
                			<tr>
                				<td><?php echo $row['last_name']; ?></td>
                				<td><?php echo $row['first_name']; ?></td>
                				<td><?php echo $row['middle_name']; ?></td>
                				<td><?php echo $row['sex']; ?></td>
                				<td><?php echo $row['program'];?></td>
                				<td><?php echo $row['yearLevel'];?></td>
                				<td><?php echo $row['acadYear'];?></td>
                				<td><a href="#" class="btn btn-default">View</a> <a href="#" class="btn btn-primary">Edit</a> <a href="#" class="btn btn-danger">Delete</a></td>
                			<?php }
 						} 
						else {
     						$errMSG = "No files to display.";
						}

                    	if(isset($errMSG)){
                		?>
                    		<td colspan="8">
                        	<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                    		</td>
                		<?php
                		}
                		?>
                			</tr>
                		</tbody>
                	</table>
                	</div>
                </div>
                <!-- End of Table -->
                <?php echo pagination($statement,$per_page,$page,$url='?');?>

            </div>  
        </div>
        <!-- End of Main Screen -->
  
  </div>
  <!-- End of Content -->

  <footer class="footer">
    <div class="container-fluid">
        <p class="text-muted" align="right"><a href="http://lu.edu.ph/" target="_blank">Laguna University</a> &copy; <?php echo date("Y"); ?></p>
    </div>
  </footer>
    
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/sorttable.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>