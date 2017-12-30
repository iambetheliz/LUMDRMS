$('document').ready(function() {   
  /* login submit */
  $('#btn-login').click(function () {  
    var data = $("#login-form").serialize();
    
    $.ajax({
    
      type : 'POST',
      url  : '/lu_clinic/login_process.php',
      data : data,
      beforeSend: function() { 
        $("#error").fadeOut();
        $("#btn-login").html('<span class="fa fa-transfer"></span> &nbsp; Signing in ...');
      },
      success: function(response) {      
        if (response == "Ok"){         
          $("#btn-login").html('<img src="../images/ajax-loader.gif" /> &nbsp; Signing In ...');
          setTimeout(' window.location.href = "dashboard.php"; ',4000);
        }
        else {         
          $("#error").fadeIn(1000, function(){      
            $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
            $("#btn-login").html('Sign In');
          });
        }
      }
    });
    return false;
  });
  /* login submit */
});