<?php 
  ob_start();
  require_once '../includes/dbconnect.php';
  include '../includes/Class.NumbersToWords.php';
  if(empty($_SESSION)) // if the session not yet started 
   session_start();
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: /lu_clinic/index.php?attempt");
    exit;
  }

  // select loggedin users detail
  $res = "SELECT * FROM users WHERE userId=".$_SESSION['user'];
  $result = $DB_con->query($res);
  $userRow = $result->fetch_array(MYSQLI_BOTH);

  if (isset($_GET['loginSuccess'])) {
    $successMSG = "Hello, <strong>".ucwords($userRow['userName'])."!</strong> You have been signed in successfully!";
  }
    
    //Render facebook profile data
    $output = '';
    if(!empty($userRow)){
        $account = '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle"></i>&nbsp;&nbsp;'. ucwords($userRow['userName']).'&nbsp;&nbsp;<b class="caret"></b></a>';
        $logout = '<a href="logout.php?logout"><i class="glyphicon glyphicon-off">'.'</i>&nbsp;&nbsp;Logout</a>';
    }else{
        $output .= '<h3 class="alert alert-danger">Your google account does not exists in our database!<br>Redirecting to login page ...</h3>';
        header("Refresh:3; logout.php?logout");
    }
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
      
    <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" id="menu-toggle" aria-expanded="false" aria-controls="navbar">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
      <a class="navbar-brand" style="color: white;" href="/lu_clinic">
        <img src="../images/logo.png" width="35" style="margin-top: -7px;" class="d-inline-block align-top" align="left" alt="">&nbsp;&nbsp;Laguna University - Clinic | Medical Records System
      </a>
    </div>

    <!-- Top Menu Items -->
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right top-menu">
        <li>
          <form class="navbar-form navbar-right navbar-form-search" role="search">
            <div class="form-inline">
              <div class="btn-group search-box">
                <span class="fa fa-search"></span>
                <input type="text" id="search-box" class="search form-control" placeholder="Quick Search">
                <span class="fa fa-spinner fa-pulse fa-fw" style="display: none;"></span>
                <span class="sr-only">Loading...</span>
                <div id="suggesstion-box"></div>
              </div>
            </div>
          </form>
        </li>
        <?php
          if(!empty($userRow)){?>
            <li class="dropdown"><?php echo $account; ?>
              <ul class="dropdown-menu">
                <li><a href="../change_pass.php"><i class="glyphicon glyphicon-lock"></i>&nbsp;&nbsp; Change Password</a></li>
                <li><?php echo $logout; ?></li>
              </ul>
            </li>            
        <?php }?>
      </ul> 
    </div> 
        
  </div>
</nav>

<script src="../assets/js/jquery.min.js"></script>

<script type="text/javascript">
  // AJAX call for autocomplete 
  $(document).ready(function(){
    $('#search-box').keyup(function(){
      $(".search").css("color","#FFF");
      var min_length = 2; // min caracters to display the autocomplete
      var keyword = $('#search-box').val();
      if (keyword.length >= min_length) {
        $.ajax({
          type: "POST",
          url: "backend-search.php",
          data:'keyword='+$(this).val(),
          beforeSend: function(){
            $(".fa-spinner").show();
          },
          success: function(data){
            $("#suggesstion-box").show();
            $("#suggesstion-box").html(data);
            $('.fa-spinner').fadeOut("slow");
          }
        });
      }
      else if (keyword.length >= 0) {
        $('#suggesstion-box').hide();
        $('.fa-spinner').fadeOut("slow");
      }
    });
  });
  $(document).click(function () {
    $('#suggesstion-box').hide();
    $('.fa-spinner').fadeOut("slow");
  })
  //To select country name
  function selectCountry(val) {
    $("#search-box").val(val);
    $('.fa-spinner').fadeOut("slow");
    $("#suggesstion-box").hide();
  }
</script>