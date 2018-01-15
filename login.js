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

    var username = $("#username").val();  
    var password = $("#password").val();
    if(username == '' || password == '' ){ 
      $.bootstrapGrowl("<i class='fa fa-info'></i> Please input username or password!", // Messages
        { // options
          type: "danger", // info, success, warning and danger
          ele: "body", // parent container
          offset: {
            from: "top",
            amount: 20
          },
          align: "right", // right, left or center
          width: "auto",
          delay: 4000,
          allow_dismiss: true, // add a close button to the message
          stackup_spacing: 10
      });
    }
    else {
      $.ajax({
        type : 'POST',
        url  : 'login_process.php',
        data : data,
        beforeSend: function() {  
          $("#error").fadeOut();
          $("#btn-login").html("<span class='fa fa-spinner fa-spin'></span> &nbsp; Signing in ...");
        },
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
                delay: 4000,
                allow_dismiss: true, // add a close button to the message
                stackup_spacing: 10
            });
            setTimeout(' window.location.href = "dashboard.php"; ',3000);
          }
          else {
            setTimeout(function() {
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
              $("#btn-login").html('<i class="fa fa-sign-in"></i> Sign In');
            }, 2000);
          }
        }
      });
    }
    return false;
  }
  /* login submit */
});