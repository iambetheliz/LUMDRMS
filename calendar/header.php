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
      <a style="color: white;" href="/lu_clinic" class="navbar-brand">
        <img src="../images/logo.png" width="35" style="margin-top: -7px;" class="d-inline-block align-top" align="left" alt="">&nbsp;&nbsp;Laguna University - Clinic | Medical Records System
      </a>
    </div>

    <!-- Top Menu Items -->
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <?php
          if(!empty($userRow)){
        ?>
            <li class="dropdown"><?php echo $account; ?>
              <ul class="dropdown-menu">
                <li><a href=""><i class="glyphicon glyphicon-cog"></i>&nbsp;&nbsp;Edit Profile</a></li>
                <li><a href="/lu_clinic/change_pass.php"><i class="glyphicon glyphicon-lock"></i>&nbsp;&nbsp; Change Password</a></li>
                <li><?php echo $logout; ?></li>
              </ul>
            </li>
        <?php 
          }
        ?>
      </ul> 
    </div>
        
  </div>
</nav>