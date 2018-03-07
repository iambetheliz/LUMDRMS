<?php
include 'includes/dbconnect.php';

$id = $_POST['id'];
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];

$sql = "UPDATE events SET title=?, start=?, end=? WHERE id=?";
$q = $DB_con->prepare($sql);
$q->execute(array($title,$start,$end,$id));

?>