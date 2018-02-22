<?php  
//filter.php 
//Include database configuration file
include('includes/dbconnect.php');
include('includes/Class.NumbersToWords.php');

$DB_con = new mysqli("localhost", "root", "", "records");

$whereTotal = '';
$whereSOAP = '';
$whereDent = '';
$whereMed = '';
$whereDel = '';
  if(isset($_POST['year'])) { 
    $whereTotal = ' WHERE YEAR(date_registered) = YEAR(NOW()) ';
    $whereSOAP = ' WHERE YEAR(date_checked) = YEAR(NOW()) ';
    $whereDent = ' WHERE YEAR(date_checked) = YEAR(NOW()) ';
    $whereMed = ' WHERE YEAR(date_checked_up) = YEAR(NOW()) ';
    $whereDel = ' AND YEAR(date_deleted) = YEAR(NOW())';
  }
  if (isset($_POST['month'])) {
    $whereTotal = ' WHERE YEAR(date_registered) = YEAR(NOW()) AND MONTH(date_registered) = MONTH(NOW()) ';
    $whereSOAP = ' WHERE YEAR(date_checked) = YEAR(NOW()) AND MONTH(date_checked) = MONTH(NOW()) ';
    $whereDent = ' WHERE YEAR(date_checked) = YEAR(NOW()) AND MONTH(date_checked) = MONTH(NOW()) ';
    $whereMed = ' WHERE YEAR(date_checked_up) = YEAR(NOW()) AND MONTH(date_checked_up) = MONTH(NOW()) ';
    $whereDel = ' AND CONCAT(YEAR(date_deleted) = YEAR(NOW()) AND MONTH(date_deleted) = MONTH(NOW())) ';
  }
  if (isset($_POST['week'])) {
    $whereTotal = ' WHERE WEEKOFYEAR(date_registered) = WEEKOFYEAR(NOW()) ';
    $whereSOAP = ' WHERE WEEKOFYEAR(date_checked) = WEEKOFYEAR(NOW()) ';
    $whereDent = ' WHERE WEEKOFYEAR(date_checked) = WEEKOFYEAR(NOW()) ';
    $whereMed = ' WHERE WEEKOFYEAR(date_checked_up) = WEEKOFYEAR(NOW()) ';
    $whereDel = ' AND WEEKOFYEAR(date_deleted) = WEEKOFYEAR(NOW()) ';
  }
  if (isset($_POST['day'])) {
    $whereTotal = ' WHERE DAY(date_registered) = DAY(NOW()) ';
    $whereSOAP = ' WHERE DAY(date_checked) = DAY(NOW()) ';
    $whereDent = ' WHERE DAY(date_checked) = DAY(NOW()) ';
    $whereMed = ' WHERE DAY(date_checked_up) = DAY(NOW()) ';
    $whereDel = ' AND DAY(date_deleted) = DAY(NOW()) ';
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
      <h4><i class="fa fa-users"></i> Patients Registered</h4>  
      <?php 
        if ($count != 0) { ?> 
          <small>You have added <strong><i><?php echo NumbersToWords::convert($count); ?></i></strong> records.</small>
          <?php }
        else { ?>
          <small>You haven't added any record.</small>
        <?php }
      ?>
    </div>
  </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
  <div class="offer offer-warning">
    <?php    
      $query = mysqli_query($DB_con,"SELECT (SELECT COUNT(*) FROM `students_den` $whereDent) AS total_students, (SELECT COUNT(*) FROM `faculty_den` $whereDent) AS total_faculties");
      $row = mysqli_fetch_array($query);
      $count = $row['total_students'] + $row['total_faculties'];
    ?>          
    <h1 class="stats"><strong><span class="count"><?php echo $count; ?></span></strong></h1> 
    <div class="offer-content">
      <h4><i class="fa fa-file" aria-hidden="true"></i> Dental Records</h4>
      <?php 
        if ($count != 0) {?> 
          <small>You have added <strong><?php echo NumbersToWords::convert($count); ?></strong> records.</small>
        <?php    }
        else {?>
          <small>You haven't added any records.</small>
        <?php    }
      ?>
    </div>
  </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
  <div class="offer offer-danger">
    <?php    
      $query = mysqli_query($DB_con,"SELECT (SELECT COUNT(*) FROM `students_med` $whereMed) AS total_students, (SELECT COUNT(*) FROM `faculty_med` $whereMed) AS total_faculties");
      $row = mysqli_fetch_array($query);
      $count = $row['total_students'] + $row['total_faculties'];
    ?>           
    <h1 class="stats"><strong><span class="count"><?php echo $count; ?></span></strong></h1>
    <div class="offer-content">
      <h4><i class="fa fa-calendar"></i> Medical Records</h4>
      <?php 
        if ($count != 0) {?> 
          <small>You have added <strong><?php echo NumbersToWords::convert($count); ?></strong> records.</small>
        <?php    }
        else {?>
          <small>You haven't added any records.</small>
        <?php    }
      ?>
    </div>
  </div>
</div>  
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
  <div class="offer offer-info">
    <?php    
      $query = mysqli_query($DB_con,"SELECT (SELECT COUNT(*) FROM `students` WHERE status = 'deleted' $whereDel) AS total_students, (SELECT COUNT(*) FROM `faculties` WHERE status = 'deleted' $whereDel) AS total_faculties");
      $row = mysqli_fetch_array($query);
      $count = $row['total_students'] + $row['total_faculties'];
    ?>           
    <h1 class="stats"><strong><span class="count"><?php echo $count; ?></span></strong></h1>
    <div class="offer-content">
      <h4><i class="fa fa-calendar"></i> Deleted Records</h4>
      <?php 
        if ($count != 0) {?> 
          <small>You have deleted <strong><?php echo NumbersToWords::convert($count); ?></strong> records.</small>
        <?php    }
        else {?>
          <small>You haven't deleted any records.</small>
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