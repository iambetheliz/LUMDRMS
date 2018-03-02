<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'records');
 
/* Attempt to connect to MySQL database */
$DB_con = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($DB_con === false){
    die("ERROR: Could not connect. " . $DB_con->connect_error);
}
?>