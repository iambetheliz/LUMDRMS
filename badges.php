<?php  
//filter.php 
//Include database configuration file
include('includes/dbconnect.php');
include('includes/Class.NumbersToWords.php');

$DB_con = new mysqli("localhost", "root", "", "records");

$whereSQL = '';
  if(isset($_POST['year'])) { 
    $whereSQL = ' WHERE YEAR(date_registered) = YEAR(NOW()) ';
  }
  if (isset($_POST['month'])) {
    $whereSQL = ' WHERE YEAR(date_registered) = YEAR(NOW()) AND MONTH(date_registered) = MONTH(NOW()) ';
  }
  if (isset($_POST['week'])) {
    $whereSQL = ' WHERE WEEKOFYEAR(date_registered) = WEEKOFYEAR(NOW()) ';
  }
  if (isset($_POST['day'])) {
    $whereSQL = ' WHERE DAY(date_registered) = DAY(NOW()) ';
  } 
?>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
  <div class="offer offer-success">
    <?php   
      $query = mysqli_query($DB_con,"SELECT (SELECT COUNT(*) FROM `students_stats` $whereSQL) AS total_students, (SELECT COUNT(*) FROM `faculty_stats` $whereSQL) AS total_faculties");
      $row = mysqli_fetch_array($query);
      $count = $row['total_students'] + $row['total_faculties'];
    ?>            
    <h1 class="stats"><strong><span class="count"><?php echo $count; ?></span></strong></h1>
    <div class="offer-content">
      <h4><i class="fa fa-calendar" aria-hidden="true"></i> Today</h4>  
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
      $query = mysqli_query($DB_con,"SELECT (SELECT COUNT(*) FROM `students_stats` $whereSQL) AS total_students, (SELECT COUNT(*) FROM `faculty_stats` $whereSQL) AS total_faculties");
      $row = mysqli_fetch_array($query);
      $count = $row['total_students'] + $row['total_faculties'];
    ?>          
    <h1 class="stats"><strong><span class="count"><?php echo $count; ?></span></strong></h1>
    <div class="offer-content">
      <h4><i class="fa fa-calendar" aria-hidden="true"></i> This Week</h4>
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
      $query = mysqli_query($DB_con,"SELECT (SELECT COUNT(*) FROM `students_stats` $whereSQL) AS total_students, (SELECT COUNT(*) FROM `faculty_stats` $whereSQL) AS total_faculties");
      $row = mysqli_fetch_array($query);
      $count = $row['total_students'] + $row['total_faculties'];
    ?>          
    <h1 class="stats"><strong><span class="count"><?php echo $count; ?></span></strong></h1> 
    <div class="offer-content">
      <h4><i class="fa fa-calendar" aria-hidden="true"></i> This Month</h4>
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
      $query = mysqli_query($DB_con,"SELECT (SELECT COUNT(*) FROM `students_stats` $whereSQL) AS total_students, (SELECT COUNT(*) FROM `faculty_stats` $whereSQL) AS total_faculties");
      $row = mysqli_fetch_array($query);
      $count = $row['total_students'] + $row['total_faculties'];
    ?>           
    <h1 class="stats"><strong><span class="count"><?php echo $count; ?></span></strong></h1>
    <div class="offer-content">
      <h4><i class="fa fa-calendar"></i> This Year</h4>
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