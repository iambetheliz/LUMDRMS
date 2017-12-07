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
      <form class="navbar-form navbar-right navbar-form-search" role="search">
        <div class="form-inline">
          <div class="btn-group search-box">
            <span class="fa fa-search"></span>
            <input type="text" class="search form-control" placeholder="Quick Search">
            <div class="result"></div>
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
  $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {
              term: inputVal
            }).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
</script>