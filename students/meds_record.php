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
        $account = '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;'. ucwords($userRow['userName']).'&nbsp;&nbsp;<b class="caret"></b></a>';
        $logout = '<a href="logout.php?logout"><i class="glyphicon glyphicon-off">'.'</i>&nbsp;&nbsp;Logout</a>';
    }else{
        $output .= '<h3 class="alert alert-danger">Your google account does not exists in our database!<br>Redirecting to login page ...</h3>';
        header("Refresh:3; logout.php?logout");
    }

    if (isset($_GET['success'])) {
        $successMSG = "<span class='glyphicon glyphicon-ok'></span> Data added successfully!";
        header('Refresh:2; tbl_rec.php');
    }
    elseif (isset($_GET['error'])) {
        $errorMSG = "<span class='glyphicon glyphicon-warning text-danger'></span> Something went wrong, try again later.";
        header('Refresh:3; tbl_rec.php');
    }
    elseif (isset($_GET['deleteSuccess'])) {
        $successMSG = "<span class='glyphicon glyphicon-ok'></span> Data successfully deleted!";
        header('Refresh:3; tbl_rec.php');
    }
    elseif (isset($_GET['deleteError'])) {
        $errorMSG = 'At least one checkbox Must be Selected !!!';
        header('Refresh:3; tbl_rec.php');
    }

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student Records | Laguna University - Clinic | Medical Records System</title>
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
    <div id="wrapper">

        <!-- Sidebar Menu Items -->
        <div id="sidebar-wrapper">
          <nav id="spy">
            <ul class="sidebar-nav">                    
                <li>
                    <a href="/lu_clinic"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp; Dashboard</a>
                </li>
                <li>
                    <a href="../activities.php"><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp; Activities</a>
                </li>
                <li class="active have-child" role="presentation">
                    <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp; Records &nbsp;&nbsp;<span class="caret"></span></a>
                    <ul id="demo" class="panel-collapse collapse in">
                        <li class="active">
                            <a href="/lu_clinic/students/tbl_rec.php"><span class="glyphicon glyphicon-education"></span>&nbsp;&nbsp; Students</a>
                        </li>
                        <li>
                            <a href="/lu_clinic/faculties/add_new.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; Faculties</a>
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
                        <h1 class="page-header">Students Records <small class="text-muted text-success pull-right"><?php  echo $successMSG; echo $errorMSG; ?></small></h1>
                    </div>
                </div>
                <!-- End of Page Heading -->
                
                <!-- Buttons -->
                <div class="row">
                  <div class="col-lg-12">
                    <!-- Start btn-toolbar -->
                    <div class="btn-toolbar">
                        <a href="add_student.php" class="btn btn-success">Add New</a>
                        <!-- Sort button -->
                        <div class="btn-group">
                            <button type="button" id="sort" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-sort"></span> Sort by <span class="caret"></span>
                            </button>
                            <?php 
                                $table_data='StudentID';
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
                                        elseif($_GET['table_data']=='StudentID')
                                            { 
                                                $table_data="StudentID"; 
                                                $sort="ASC";
                                            }
                                    }
                            ?>
                            <ul class="dropdown-menu">
                                <li><a href="tbl_rec.php?sorting='.$sort.'&table_data=last_name">Surname</a></li>
                                <li><a href="tbl_rec.php?sorting='.$sort.'&table_data=program">Program</a></li>
                                <li><a href="tbl_rec.php?sorting='.$sort.'&table_data=yearLevel">Year Level</a></li>
                            </ul>
                        </div>
                        <!-- End Sort button -->
                        <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-info active">
                            <input type="radio" name="status" value="all" checked="checked"> All
                        </label>
                        <label class="btn btn-success">
                            <input type="radio" name="status" value="active"> Active
                        </label>
                        <label class="btn btn-warning">
                            <input type="radio" name="status" value="inactive"> Inactive
                        </label>
                        <label class="btn btn-danger">
                            <input type="radio" name="status" value="expired"> Expired
                        </label>                            
                    </div>
                        <!-- Search Button -->
                        <form action="" method="get">
                        <div class="input-group pull-right" style="width: 300px;">
                            <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                            <span class="input-group-btn"><button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button></span>
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
                    require_once '../dbconnect.php';
                    include '../includes/pagination.php';

                    $DB_con = new mysqli("localhost", "root", "", "records");

                    $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
                    
                    if ($page <= 0) $page = 1;
                        $per_page = 5; // Set how many records do you want to display per page.
    
                        if (isset($_GET['search'])) {
                            $search = $_GET['search'];
                            $search = $DB_con->real_escape_string($search);
    
                            if (empty($search)) {
                                $output1 = "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close' id='close'><span aria-hidden='true'>&times;</span></button>Please enter a keyword.</div>";
                            }
                            else {
                                $output1 = '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" id="close"><span aria-hidden="true">&times;</span></button>Showing result for <strong>"'.$search.'."</strong></div>';
                            }
    
                            $startpoint = ($page * $per_page) - $per_page;
                            $statement = "`students_med` JOIN `students` ON `students`.`StudentID`=`students_med`.`StudentID` WHERE CONCAT(last_name,first_name,middle_name,ext,program,yearLevel,acadYear,med,dent,`students_info`.`studentNo`) LIKE '%".$search."%'";
                            $result = mysqli_query($DB_con,"SELECT * FROM {$statement} ORDER BY $table_data $sort LIMIT {$startpoint} , {$per_page}");
                        }
                        else {
                            $startpoint = ($page * $per_page) - $per_page;
                            $statement = "`students_med` WHERE StudentID = '1'";
                            $result = mysqli_query($DB_con,"SELECT * FROM $statement ORDER BY {$table_data} {$sort} LIMIT {$startpoint} , {$per_page}"); 
                            $count = $result->num_rows;
                        }
                ?>
                <br>
                <?php if (isset($_GET['search'])) {
                    echo $output1;
                }  ?>

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
                    <label class="pull-right">Total rows: <?php echo $count; ?></label>
                    <br>
                    <div class="table-responsive">
                    <table class="table  table-striped table-bordered" id="myTable">
                        <thead style="background-color:#eee;cursor: pointer;">
                            <tr>
                                <th></th>
                                <th>Medical</th>
                                <th>Dental</th>
                                <th onclick="sortTable(0)">Last Name</th>
                                <th onclick="sortTable(1)">First Name</th>
                                <th>Middle Name</th>
                                <th>Extension <br>(if any)</th>
                                <th>Student No.</th>
                                <th>Program</th>
                                <th>Year</th>
                                <th>Academic Year</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // displaying records.
                            while ($row = $result->fetch_assoc()){ ?>
                            <tr>
                                <td><input type="checkbox" name="chk[]" class="chk-box" value="<?php echo $row['StudentID']; ?>"  /></td>
                                <td><?php echo $row['sysRev']; ?></td>
                                <td><?php echo $row['medHis']; ?></td>
                                <td><?php echo $row['drinker']; ?></td>
                                <td><?php echo $row['smoker']; ?></td>
                                <td><?php echo $row['drug_user']; ?></td>
                                <td><?php echo $row['weight']; ?></td>
                                <td><?php echo $row['height']; ?></td>
                                <td><?php echo $row['studentNo']; ?></td>
                                <td><?php echo $row['program'];?></td>
                                <td><?php echo $row['yearLevel'];?></td>
                                <td><?php echo $row['acadYear'];?></td>
                                <td width="145px"><a href="view_record.php?StudentID=<?php echo $row['StudentID']; ?>" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"> <span class="glyphicon glyphicon-eye-open"></span></a> | <a href="edit_record.php?StudentID=<?php echo $row['StudentID']; ?>" class="btn btn-sm btn-primary" title="Edit" data-toggle="tooltip"> <span class="glyphicon glyphicon-edit"></span></a> | <a href="action.php?action_type=delete&StudentID=<?php echo $row['StudentID']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');" title="Delete" data-toggle="tooltip"> <span class="glyphicon glyphicon-trash"></span></a></td>
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
    <script src="jquery.js" type="text/javascript"></script>
    <script src="delete_mul.js" type="text/javascript"></script>

    <script>
    </script>
    
</body>
</html>
<?php ob_end_flush(); ?>