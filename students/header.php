<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

  <div class="container-fluid">
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
      <a style="color: white;" href="/lu_clinic" class="navbar-brand">
        <img src="../images/logo.png" width="35" style="margin-top: -7px;" class="d-inline-block align-top" align="left" alt="">&nbsp;&nbsp;Laguna University - Clinic | Medical Records System
      </a>
    </div>

    <!-- Top Menu Items -->
    <div id="navbar" class="navbar-collapse collapse">
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
      <ul class="nav navbar-nav navbar-right top-menu">
        <?php
          if(!empty($userRow)){?>
            <li class="dropdown"><?php echo $account; ?>
              <ul class="dropdown-menu">
                <li><a href=""><i class="glyphicon glyphicon-cog"></i>&nbsp;&nbsp;Edit Profile</a></li>
                <li><a href=""><i class="glyphicon glyphicon-lock"></i>&nbsp;&nbsp; Change Password</a></li>
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