<?php
$sql = "UPDATE `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` SET " . $_POST["column"] . " = '".$_POST["value"]."' WHERE id=".$_POST["StudentID"];
mysqli_query($DB_con, $sql) or die("database error:". mysqli_error($DB_con));
?>