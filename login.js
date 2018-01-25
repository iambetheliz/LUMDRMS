$('document').ready(function() { 
  /* validation */
  $("#login-form").validate({
    rules: {
      password: {
        required: true,
      },
      username: {
        required: true,
      },
    },
    messages: {
      password: {
        required: "Please enter your password"
      },
      username: "Please enter your userName",
    },
    submitHandler: submitForm 
  });  
  /* validation */

  /* login submit */
  function submitForm() {   
    var data = $("#login-form").serialize();

    $.ajax({
      type : 'POST',
      url  : 'login_process.php',
      data : data,
      success :  function(response) {           
        if(response=="ok"){
          $.bootstrapGrowl("<span class='fa fa-check'></span> Access granted!", // Messages
            { // options
              type: "success", // info, success, warning and danger
              ele: "body", // parent container
              offset: {
                from: "top",
                amount: 20
              },
              align: "right", // right, left or center
              width: 300,
              allow_dismiss: true, // add a close button to the message
              stackup_spacing: 10
          });
          $("#error").fadeOut();
          $("#btn-login").prop("disabled",true);
          $("#btn-login").html("<span class='fa fa-refresh fa-spin'></span> &nbsp; Signing in ...");
          setTimeout(function() {
            window.location.href = "dashboard.php";
          }, 2000);
        }
        else {
            $.bootstrapGrowl("<i class='fa fa-info'></i> "+response, { // Messages
              // options
              type: "danger", // info, success, warning and danger
              ele: "body", // parent container
              offset: {
                from: "top",
                amount: 20
              },
              align: "right", // right, left or center
              width: 300,
              allow_dismiss: true, // add a close button to the message
              stackup_spacing: 10
            });
            $("#btn-login").prop("disabled",false);
            $("#btn-login").val('Sign In');
        }
      }
    });
    
    return false;
  }
  /* login submit */
});