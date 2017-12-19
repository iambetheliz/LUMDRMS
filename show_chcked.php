<?php

require_once 'includes/dbconnect.php';
$DB_con = new mysqli("localhost", "root", "", "records");

$result = mysqli_query($DB_con,"SELECT * FROM students_med WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(sysRev, ',', 3), ',', -1)='Abdominal Pain'");
$count = $result->num_rows;
$row = $result->fetch_array(MYSQLI_BOTH);
           
if(!empty($row)){
	$msg = 'Checked value : ' . $row['sysRev'] . '<br />';
	$issues = print_r($row['sysRev']);
}
?>

<p><?php echo $msg; ?></p>
<p><?php echo $issues; ?></p>