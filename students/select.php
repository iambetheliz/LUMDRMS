<?php  
//Include database configuration file
include('../includes/dbconnect.php');

 if(isset($_POST["StudentID"]))  
 {  
      $DB_con = new mysqli("localhost", "root", "", "records");  
      $query = "SELECT * FROM students WHERE StudentID = '".$_POST["StudentID"]."'";  
      $result = mysqli_query($DB_con, $query);?>
      <div class="table-responsive">  
           <table class="table table-bordered">
           <?php  
      while($row = mysqli_fetch_array($result))  
      {  
           ?>
                <tr>  
                     <td width="30%"><label>Name</label></td>  
                     <td width="70%"><?php echo $row["first_name"];?></td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Address</label></td>  
                     <td width="70%"><?php echo $row["address"];?></td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Gender</label></td>  
                     <td width="70%"><?php echo $row["sex"];?></td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Designation</label></td>  
                     <td width="70%"><?php echo $row["last_name"];?></td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Age</label></td>  
                     <td width="70%"><?php echo $row["age"];?></td>  
                </tr>  
      <?php }  ?>
      </table></div>
 <?php }  
 ?>
