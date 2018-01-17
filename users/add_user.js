$(document).ready(function () {
    $('#chkShow').change(function() {
      var isChecked = $(this).prop('checked');
      if (isChecked) {
          $('#password').prop('type', 'text');
      }
      else {
          $('#password').prop('type', 'password');
      }
    });
    /* validation */
    $("#add_user").validate({
      rules: {
        username: {
          required: true,
          minlength: 5
        },
        first_name: {
          required: true,
        },
        last_name: {
          required: true,
        },
        password: {
          required: true,
          minlength: 6
        },
      },
    submitHandler: submitForm 
    });  
    /* validation */
    $("#list-users").load("tbl_users.php");
    $('#add_user').submit(function() {
      return false;
      $.ajaxSetup ({
        cache: false
      });
      $("#add_user")[0].reset();
      $('#register').val();
    });
  });
  function submitForm(){
    $.ajax({
      type: "POST",
      url: "add_user.php",
      cache: false,
      data: $('#add_user').serialize(),  
      beforeSend:function() {  
        $('#register').val("Inserting");  
      },  
      success: function(){
        $("#add_user")[0].reset();
        $('#register').val("Add New"); 
        $("#list-users").load("tbl_users.php");
        $.bootstrapGrowl("User added successfully!", // Messages
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
      }
    });
  }