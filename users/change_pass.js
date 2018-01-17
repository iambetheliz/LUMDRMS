$('document').ready(function() { 
  /* validation */
  $("#change_pass_form").validate({
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
    var data = $("#change_pass_form").serialize();

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
        url  : 'change.php',
        data : data,
        success :  function(response) {           
          if(response=="ok"){
            $.bootstrapGrowl("<span class='fa fa-check'></span> Password changed successfully!", // Messages
              { // options
                type: "success", // info, success, warning and danger
                ele: "body", // parent container
                offset: {
                  from: "top",
                  amount: 20
                },
                align: "right", // right, left or center
                width: 300,
                delay: 2000,
                allow_dismiss: true, // add a close button to the message
                stackup_spacing: 10
            });
            $("#error").fadeOut();
            $("#change").prop("disabled",true);
            $("#change").html("<span class='fa fa-refresh fa-spin'></span> &nbsp; Updating");
            setTimeout(function() {
              $("#change_pass_form").hide().fadeOut("slow");
              $("#msg").show();
            }, 3000);
            setTimeout(function() {
              window.location.href = "/lu_clinic";
            }, 6000);
          }
          else {
            $("#change").val('Checking passwords');
            $("#change").prop("disabled",false);
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
            }, 2000);
          }
        }
      });
    }
    return false;
  }
  /* login submit */
});