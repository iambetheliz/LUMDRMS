<?php
  ob_start();
  require_once '../includes/dbconnect.php';
  include '../includes/date_time_diff.php';
  if(empty($_SESSION)) // if the session not yet started 
  session_start();
?>
<div class="panel panel-success panel-table">
  <div class="panel-heading">
    <div class="panel-title"><strong>USERS TABLE</strong></div>
  </div>
  <div class="panel-body">
  <table id="userTable" class="table table-bordered" cellpadding="10" cellspacing="1">
    <thead>
      <tr>
        <th>User ID</th>
        <th>Username</th>
        <th>Name</th>
        <th>Position</th>
        <th>Role</th>
      </tr>
    </thead>
    <tbody id="ajax-response">
    <?php
    $query = $DB_con->query("SELECT * FROM users");
    while($userRow = $query->fetch_assoc()){ ?>
      <tr>
        <td><?php echo $userRow["userId"]; ?></td>
        <td><?php echo $userRow["userName"]; ?></td>
        <td><?php echo $userRow["first_name"]." ".$userRow['last_name']; ?></td>
        <td><?php echo $userRow['position'];?></td>
        <td><?php echo $userRow["role"]; ?></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  </div>
</div>     