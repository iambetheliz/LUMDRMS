<?php  
//filter.php 
//Include database configuration file
include('includes/dbconnect.php');
include('includes/Class.NumbersToWords.php');

$DB_con = new mysqli("localhost", "root", "", "records");

$whereTotal = '';
$whereVisit = '';
$whereCert = '';
$wherePen = '';
  if(isset($_POST['year'])) { 
    $whereTotal = ' WHERE YEAR(date_registered) = YEAR(NOW()) ';
    $whereVisit = ' WHERE YEAR(date_checked) = YEAR(NOW()) ';
    $whereCert = ' WHERE YEAR(date_issued) = YEAR(NOW()) ';
    $wherePen = ' WHERE YEAR(date_registered) = YEAR(NOW()) AND med = "Pending" AND dent = "Pending" ';
  }
  if (isset($_POST['month'])) {
    $whereTotal = ' WHERE YEAR(date_registered) = YEAR(NOW()) AND MONTH(date_registered) = MONTH(NOW()) ';
    $whereVisit = ' WHERE YEAR(date_checked) = YEAR(NOW()) AND MONTH(date_checked) = MONTH(NOW()) ';
    $whereCert = ' WHERE YEAR(date_issued) = YEAR(NOW()) AND MONTH(date_issued) = MONTH(NOW()) ';
    $wherePen = ' WHERE YEAR(date_registered) = YEAR(NOW()) AND MONTH(date_registered) = MONTH(NOW()) AND med = "Pending" AND dent = "Pending" ';
  }
  if (isset($_POST['week'])) {
    $whereTotal = ' WHERE WEEKOFYEAR(date_registered) = WEEKOFYEAR(NOW()) ';
    $whereVisit = ' WHERE WEEKOFYEAR(date_checked) = WEEKOFYEAR(NOW()) ';
    $whereCert = ' WHERE WEEKOFYEAR(date_issued) = WEEKOFYEAR(NOW()) ';
    $wherePen = ' WHERE WEEKOFYEAR(date_registered) = WEEKOFYEAR(NOW()) AND med = "Pending" AND dent = "Pending" ';
  }
  if (isset($_POST['day'])) {
    $whereTotal = ' WHERE DAY(date_registered) = DAY(NOW()) ';
    $whereVisit = ' WHERE DAY(date_checked) = DAY(NOW()) ';
    $whereCert = ' WHERE DAY(date_issued) = DAY(NOW()) ';
    $wherePen = ' WHERE DAY(date_registered) = DAY(NOW()) AND med = "Pending" AND dent = "Pending" ';
  } 
?>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
  <div class="offer offer-success">
    <?php   
      $query = mysqli_query($DB_con,"SELECT (SELECT COUNT(*) FROM `students_stats` $whereTotal) AS total_students, (SELECT COUNT(*) FROM `faculty_stats` $whereTotal) AS total_faculties");
      $row = mysqli_fetch_array($query);
      $count = $row['total_students'] + $row['total_faculties'];
    ?>            
    <h1 class="stats"><strong><span class="count"><?php echo $count; ?></span></strong></h1>
    <div class="offer-content">
      <h4><i class="fa fa-users" aria-hidden="true"></i> Patients Registered</h4>  
      <?php 
        if ($count != 0) {?> 
          <small>You have added <strong><?php echo NumbersToWords::convert($count); ?></strong> records today.</small>
          <?php    }
        else {?>
          <small>You haven't added any record today.</small>
        <?php    }
      ?>
    </div>
  </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
  <div class="offer offer-info">
    <?php    
      $query = mysqli_query($DB_con,"SELECT (SELECT COUNT(*) FROM `students_soap` $whereVisit) AS total_students, (SELECT COUNT(*) FROM `faculty_soap` $whereVisit) AS total_faculties");
      $row = mysqli_fetch_array($query);
      $count = $row['total_students'] + $row['total_faculties'];
    ?>          
    <h1 class="stats"><strong><span class="count"><?php echo $count; ?></span></strong></h1>
    <div class="offer-content">
      <h4><i class="fa fa-home" aria-hidden="true"></i> Patient Visits</h4>
      <?php 
        if ($count != 0) {?> 
          <small>You have added <strong><?php echo NumbersToWords::convert($count); ?></strong> records this week.</small>
        <?php    }
        else {?>
          <small>You haven't added any record this week.</small>
        <?php    }
      ?>
    </div>
  </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
  <div class="offer offer-warning">
    <?php    
      $query = mysqli_query($DB_con,"SELECT (SELECT COUNT(*) FROM `students_cert` $whereCert) AS total_students, (SELECT COUNT(*) FROM `faculty_cert` $whereCert) AS total_faculties");
      $row = mysqli_fetch_array($query);
      $count = $row['total_students'] + $row['total_faculties'];
    ?>          
    <h1 class="stats"><strong><span class="count"><?php echo $count; ?></span></strong></h1> 
    <div class="offer-content">
      <h4><i class="fa fa-file" aria-hidden="true"></i> Certificates Issued</h4>
      <?php 
        if ($count != 0) {?> 
          <small>You have added <strong><?php echo NumbersToWords::convert($count); ?></strong> records this month.</small>
        <?php    }
        else {?>
          <small>You haven't added any records this month.</small>
        <?php    }
      ?>
    </div>
  </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
  <div class="offer offer-danger">
    <?php    
      $query = mysqli_query($DB_con,"SELECT (SELECT COUNT(*) FROM `students_stats` $wherePen) AS total_students, (SELECT COUNT(*) FROM `faculty_stats` $wherePen) AS total_faculties");
      $row = mysqli_fetch_array($query);
      $count = $row['total_students'] + $row['total_faculties'];
    ?>           
    <h1 class="stats"><strong><span class="count"><?php echo $count; ?></span></strong></h1>
    <div class="offer-content">
      <h4><i class="fa fa-calendar"></i> Pending Records</h4>
      <?php 
        if ($count != 0) {?> 
          <small>You have added <strong><?php echo NumbersToWords::convert($count); ?></strong> records this year.</small>
        <?php    }
        else {?>
          <small>You haven't added any records this year.</small>
        <?php    }
      ?>
    </div>
  </div>
</div>  
<script>
  $('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 3000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
  });
</script>