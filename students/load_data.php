<?php  
 //load_data.php  
 //Include database configuration file
 include('../includes/dbconnect.php');
 $DB_con = new mysqli("localhost", "root", "", "records");
 
 $prog_out = '';  
 if(isset($_POST["program_id"]))  
 {  
      if($_POST["program_id"] != '')  
      {  
           $sql = "SELECT * FROM `students` JOIN `program` ON `students`.`program`=`program`.`program_id` WHERE program_id = '".$_POST["program_id"]."'";  
      }  
      else  
      {  
           $sql = "SELECT * FROM `students` JOIN `program` ON `students`.`program`=`program`.`program_id`";  
      }  
      $result = mysqli_query($DB_con, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $prog_out .= '<div class="col-md-3"><div style="border:1px solid #ccc; padding:20px; margin-bottom:20px;">'.$row["studentNo"]. '<br><br>' .$row["program_name"]. '</div></div>';  
      }  
      echo $prog_out;  
 }  
 ?> 