<?php
 
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'records';
$item_per_page = 5;

// Create connection
$DB_con = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
 
// Check connection
if ($DB_con->connect_error) {
    header('Location: /lu_clinic/no_connection_error.php');
}