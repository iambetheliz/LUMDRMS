<?php
require_once("../includes/dbcontroller.php");
$db_handle = new DBController();
$sql = "UPDATE `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` SET " . $_POST["med"] . " = '".$_POST["editval"]."', " . $_POST["dent"] . " = '".$_POST["editval"]."', " . $_POST["last_name"] . " = '".$_POST["editval"]."' WHERE  StatsID=".$_POST["StatsID"];
$result = $db_handle->executeUpdate($sql);
?>
