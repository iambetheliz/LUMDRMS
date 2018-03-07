<?php
  ob_start();
  require_once '../../includes/dbconnect.php';
  include '../../includes/Class.NumbersToWords.php';
  if(empty($_SESSION)) // if the session not yet started 
   session_start();
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: /LUMDRMS/index.php?attempt");
    exit;
  }

  // select loggedin users detail
  $res = "SELECT * FROM users WHERE userId=".$_SESSION['user'];
  $result = $DB_con->query($res);
  $userRow = $result->fetch_array(MYSQLI_BOTH);

  if (isset($_GET['loginSuccess'])) {
    $successMSG = "Hello, <strong>".ucwords($userRow['userName'])."!</strong> You have been signed in successfully!";
  }

?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">

    <div class="row">
      <!-- Brand and toggle get grouped for better mobile display -->
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
        <a href="/LUMDRMS" class="navbar-brand">
          <img src="../../images/logo.png" class="d-inline-block align-top" align="left" alt="">Laguna University - Clinic | Medical and Dental Records System
        </a>
      </div>

      <!-- Top Menu Items -->
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right top-menu">
          <li>
            <a href="/LUMDRMS/SMS/"><i class="col-1 fa fa-comment" aria-hidden="true"></i>SMS App</a>
          </li>
          <?php
            if(!empty($userRow)){?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="col-1 fa fa-user-circle" aria-hidden="true"></i><?php echo $userRow['userName']; ?><i class="col-1" aria-hidden="true"></i> <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                <ul class="dropdown-menu">
                  <li><a href="/LUMDRMS/users/user_profile.php"><i class="col-1 fa fa-edit" aria-hidden="true"></i>Edit Profile</a></li>
                  <li><a href="/LUMDRMS/users/changepswd.php"><i class="col-1 fa fa-lock" aria-hidden="true"></i>Change Password</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="/LUMDRMS/logout.php?logout"><i class="col-1 fa fa-power-off" aria-hidden="true"></i>Logout</a></li>
                </ul>
              </li>            
          <?php }?>
        </ul> 
      </div>
    </div>

  </div>
</nav>
<script src="../../assets/js/jquery.min.js"></script>

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