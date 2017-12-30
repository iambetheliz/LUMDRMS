$('document').ready(function() {   
  /* login submit */
  function submitForm() {
    var data = $("#login-form").serialize();
    $.ajax({
      type : 'POST',
      url : 'login_process.php',
      data : data,
      beforeSend: function(){
        $("#error").fadeOut();
        $("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span>   sending ...');
      },
      success : function(response){
        if(response=="Ok"){
          $("#btn-login").html('<img src="images/ajax-loader.gif" />   Signing In ...');
          setTimeout(' window.location.href = "dashboard.php"; ',4000);
        } else {
          $("#error").fadeIn(1000, function(){
            $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span>   '+response+' !</div>');
            $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span>   Sign In');
          });
        }
      }
    });
  return false;
  }
  /* login submit */
});