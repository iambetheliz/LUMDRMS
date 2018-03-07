<?php
//Include database configuration file
include('../includes/dbconnect.php');

if(isset($_POST["dept_id"]) && !empty($_POST["dept_id"])){
    //Get all state data
    $query = $DB_con->query("SELECT * FROM program WHERE dept_id = ".$_POST['dept_id']." AND status = 1 ORDER BY program_name ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display program list
    if($rowCount > 0){
        echo '<option value="">Select program</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['program_id'].'">'.$row['program_name'].'</option>';
        }
    }else{
        echo '<option value="">Program not available</option>';
    }
}
?>