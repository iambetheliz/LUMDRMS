<?php

 $json = array();

 $requete = "SELECT * FROM events ORDER BY id";

 try {
 	require "includes/dbconnect.php";
 } catch(Exception $e) {
    exit('Unable to connect to database.');
 }

 $resultat = $DB_con->query($requete) or die(print_r($DB_con->errorInfo()));

 echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));

?>