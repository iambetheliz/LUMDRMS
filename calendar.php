<?php
  ob_start();
  require_once 'includes/dbconnect.php';
  if(empty($_SESSION)) // if the session not yet started 
   session_start();
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: index.php?attempt");
    exit;
  }

  $DB_con = new mysqli("localhost", "root", "", "records");

    if ($DB_con->connect_errno) {
      echo "Connect failed: ", $DB_con->connect_error;
    exit();
    }

  // select loggedin users detail
  $res = "SELECT * FROM users WHERE userId=".$_SESSION['user'];
  $result = $DB_con->query($res);
  $userRow = $result->fetch_array(MYSQLI_BOTH);
    
    //Render facebook profile data
    $output = '';
    if(!empty($userRow)){
        $account = '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;'. ucwords($userRow['userName']).'&nbsp;&nbsp;<b class="caret"></b></a>';
        $logout = '<a href="logout.php?logout"><i class="glyphicon glyphicon-off">'.'</i>&nbsp;&nbsp;Logout</a>';
    }else{
        $output .= '<h3 class="alert alert-danger">Your google account does not exists in our database!<br>Redirecting to login page ...</h3>';
        header("Refresh:3; logout.php?logout");
    }
  
  if(isset($_POST['action']) or isset($_GET['view'])) { //show all events

    if(isset($_GET['view'])) {

        header('Content-Type: application/json');
        $start = mysqli_real_escape_string($DB_con,$_GET["start"]);
        $end = mysqli_real_escape_string($DB_con,$_GET["end"]);

        $result = mysqli_query($DB_con,"SELECT id, start ,end ,title FROM  events where (date(start) >= '$start' AND date(start) <= '$end')");
        while($row = mysqli_fetch_assoc($result)) {
            $events[] = $row; 
        }

        echo json_encode($events); 
        exit;
    }
    elseif($_POST['action'] == "add") { // add new event  
        mysqli_query($DB_con,"INSERT INTO events (title,start,end) VALUES('".mysqli_real_escape_string($DB_con,$_POST["title"])."','".mysqli_real_escape_string($DB_con,date('Y-m-d H:i:s',strtotime($_POST["start"])))."','".mysqli_real_escape_string($DB_con,date('Y-m-d H:i:s',strtotime($_POST["end"])))."')");

        header('Content-Type: application/json');
        echo '{"id":"'.mysqli_insert_id($DB_con).'"}';
        exit;
    }
    elseif($_POST['action'] == "update")  { // update event
        mysqli_query($DB_con,"UPDATE events set start = '".mysqli_real_escape_string($DB_con,date('Y-m-d H:i:s',strtotime($_POST["start"])))."', end = '".mysqli_real_escape_string($DB_con,date('Y-m-d H:i:s',strtotime($_POST["end"])))."' WHERE id = '".mysqli_real_escape_string($DB_con,$_POST["id"])."'");
        exit;
    }

    elseif($_POST['action'] == "delete") { // remove event
        mysqli_query($DB_con,"DELETE from events where id = '".mysqli_real_escape_string($DB_con,$_POST["id"])."'");

        if (mysqli_affected_rows($DB_con) > 0) {
            echo "1";
        }
        exit;
    }

}

?>

<?php ob_end_flush(); ?>