<?php
require_once("../includes/dbcontroller.php");
$db_handle = new DBController();
$sql = "UPDATE `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` SET " . $_POST["med"] . " = '".$_POST["editval"]."', " . $_POST["dent"] . " = '".$_POST["editval"]."', " . $_POST["last_name"] . " = '".$_POST["editval"]."' WHERE  StatsID=".$_POST["StatsID"];
$result = $db_handle->executeUpdate($sql);
?>
