<?php
require_once("includes/dbconnect.php");
if(empty($_SESSION)) // if the session not yet started 
    session_start();

// if session is not set this will redirect to login page
if( !isset($_SESSION['user']) ) {
    header("Location: /LUMDRMS/403-error.php");
exit;
}

if(!empty($_POST["keyword"])) {
    $query ="SELECT * FROM students WHERE studentNo LIKE '%" . $_POST["keyword"] . "%' OR first_name LIKE '%" . $_POST["keyword"] . "%' OR middle_name LIKE '%" . $_POST["keyword"] . "%' OR last_name LIKE '%" . $_POST["keyword"] . "%' ORDER BY first_name LIMIT 0,6";
    $result = $DB_con->query($query);
?>
        <ul id="country-list">
        <?php 
        if($result->num_rows > 0) {
            foreach($result as $row) { ?>
                <li onClick="selectStudents('<?php echo $row["first_name"]." ".$row['middle_name']." ".$row['last_name']; ?>');"><a href="profile.php?StudentID=<?php echo $row['StudentID'];?>"><?php echo $row["first_name"]." ".$row['middle_name']." ".$row['last_name']; ?></a>
                </li>
                <?php 
            }
        } else {
            echo "<li>No result</li>";
        }
        ?>
        </ul>
<?php } 
?>