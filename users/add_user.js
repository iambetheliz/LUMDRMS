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
        minlength: 3
      },
      last_name: {
        required: true,
        minlength: 3
      },
      password: {
        required: true,
        minlength: 6
      },
      position: {
        required: true
      }
    },
  submitHandler: submitForm 
  });  
  /* validation */
  $("#list-users").load("tbl_users.php");
  $("#first_name").focus();
  $('#add_user').submit(function() {
    return false;
    $.ajaxSetup ({
      cache: false
    });
    $("#add_user")[0].reset();
    $('#register').val();
    $("#modal-add").modal('hide');
  });
  //Check availability
  $("#username").keyup(function() {  
    var username = $(this).val(); 
    
    if(username.length > 2) {       
      $.ajax({      
        type : 'POST',
        url  : 'availability_check.php',
        data : $(this).serialize(),
        success : function(data)
          {
            $("#result").html(data);
          }
        });
      return false;
    }
    else {
      $("#result").html('');
    }
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
    success: function(response){
      if (response=="ok") {
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
      }  
      $("#add_user")[0].reset();
      $('#register').val("Add New"); 
      $("#modal-add").modal('hide');
      $("#list-users").load("tbl_users.php");
    }
  });
}