//students
$(document).ready(function(){
  $('#overlay').show();
	$("#userTable").load("tbl_medical.php");
  $('#overlay').fadeOut('fast');	
	$('#user_form').submit(function() {
		return false;
		$.ajaxSetup ({
      cache: false
  	});
      $("#user_form")[0].reset();
      $('#addnew').val();
      $('#userModal').modal('hide'); 
	});
  $('#user_form2').submit(function() {
    return false;
    $.ajaxSetup ({
      cache: false
    });
      $("#user_form2")[0].reset();
      $('#addnew').val();
      $('#view-modal').modal('hide'); 
  });
	//Select courses on Add Function            
  $('#dept').on('change',function(){
    var deptID = $(this).val();
    if(deptID){
      $.ajax({
        type:'POST',
        url:'../students/courses.php',
        data:'dept_id='+deptID,
        success:function(html){
          $('#program').html(html); 
        }
      }); 
    } else {
      $('#program').html('<option value="">Select department first</option>');
    }
  });
	//Add New
	$(document).on('click', '#addnew', function(){
		if($('.required').val() == "")  {  
      $("#msg").html("* Required Fields!").show();
      $(".required").addClass('error');
      $("#studentNo").focus();
        return false; 
    }
    else if($('#first_name').val() == "")  {  
      $("#msg").html("Please enter your first name!").show();
      $("#first_name").addClass('error');
      $("#first_name").focus();
        return false; 
    }
    else if($('#last_name').val() == "")  {  
      $("#msg").html("Please enter your last name!").show();
      $("#last_name").addClass('error');
      $("#last_name").focus();
        return false; 
    }  
    else if($('#sex').val() == "")  {  
      $("#msg").html("Please select your gender!").show();
      $("#sex").addClass('error');
      $("#sex").focus();
        return false; 
    }
    else if($('#dept').val() == "")  {  
      $("#msg").html("Please select department!").show();
      $("#dept").addClass('error');
      $("#dept").focus();
        return false; 
    }
    else if($('#program').val() == "")  {  
      $("#msg").html("Please select program!").show();
      $("#program").addClass('error');
      $("#program").focus();
        return false; 
    }
    else if($('#yearLevel').val() == "")  {  
      $("#msg").html("Please select your year level!").show();
      $("#yearLevel").addClass('error');
      $("#yearLevel").focus();
        return false; 
    }
    else if($('#sem').val() == "")  {  
      $("#msg").html("Please select semester!").show();
      $("#sem").addClass('error');
      $("#sem").focus();
        return false; 
    }
    else if($('#acadYear').val() == "")  {  
      $("#msg").html("Please select academic year!").show();
      $("#acadYear").addClass('error');
      $("#acadYear").focus();
        return false; 
    }
    else if($('#cperson').val() == "")  {  
      $("#msg").html("Please enter your guardian's name!").show();
      $("#cperson").addClass('error');
      $("#cperson").focus();
        return false; 
    }
    else if($('#cphone').val() == "")  {  
      $("#msg").html("Please enter your contact number!").show();
      $("#cphone").addClass('error');
      $("#cphone").focus();
        return false; 
    }
		else {
			$.ajax({
				type: "POST",
				url: "../students/addnew.php",
        cache: false,
				data: $('#user_form').serialize(),  
        beforeSend:function() {  
          $('#addnew').val("Inserting");  
        },  
				success: function(){
          $('#userModal').modal('hide'); 
          $("#user_form")[0].reset();
          $('#addnew').val("Add New"); 
					$("#userTable").load("tbl_medical.php");
          $.notify("Data added successfully", "success");
				}
			});
		}
	});
	//Delete
	$(document).on('click', '.delete', function(){
		$MedID = $(this).val();
		$.ajax({
			type: "POST",
			url: "delete_med.php",
      cache: false,
			data: {
				MedID: $MedID,
				del: 1,
			},
			success: function(){
				$("#userTable").load("tbl_medical.php");
        $.notify("Data successfully deleted.", "success");
			}
		});
		return false;
	});
  //View
  $(document).on('click', '#getUser', function(e){  
    e.preventDefault();
    var uid = $(this).data('id'); // get id of clicked row
    $('#dynamic-content').html(''); // leave this div blank
    $('#modal-loader').show();      // load ajax loader on button click
    $.ajax({
      url: '../students/edit_data.php',
      type: 'POST',
      data: 'StudentID='+uid,
      dataType: 'html'
    })
    .done(function(data){
      console.log(data); 
      $('#dynamic-content').html(''); // blank before load.
      $('#dynamic-content').html(data); // load here
      $('#modal-loader').fadeOut('fast');; // hide loader  
    })
    .fail(function(){
      $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
      $('#modal-loader').fadeOut('fast');;
    });
  });
  //Update
  $(document).on('click', '#update', function(){
    $.ajax({
      type: "POST",
      url: "../students/update.php",
      cache: false,
      data: $('#user_form2').serialize(), 
      beforeSend:function() {  
        $('#update').val("Updating");  
      },  
      success: function(){
        $('#view-modal').modal('hide'); 
        $("#user_form2")[0].reset();
        $('#update').val("Update Record"); 
        $("#userTable").load("tbl_medical.php");
        $.notify("Data updated successfully", "success");
      }
    });
  });
});
// AJAX call for autocomplete 
  $(document).ready(function(){
    $('#search-info').keyup(function(){
      var min_length = 2; // min caracters to display the autocomplete
      var keyword = $('#search-info').val();
      if (keyword.length >= min_length) {
        $.ajax({
          type: "POST",
          url: "backend-search.php",
          data:'keyword='+$(this).val(),
          beforeSend: function(){
            $(".fa-spinner").show();
          },
          success: function(data){
            $("#suggestion-info").show();
            $("#suggestion-info").html(data);
            $('.fa-spinner').fadeOut("slow");
          }
        });
      }
      else if (keyword.length >= 0) {
        $('#suggestion-info').hide();
        $('.fa-spinner').fadeOut("slow");
      }
    });
  });
  $(document).click(function () {
    $('#suggestion-info').hide();
    $('.fa-spinner').fadeOut("slow");
  })
  //To select country name
  function selectCountry(val) {
    $("#search-info").val(val);
    $('.fa-spinner').fadeOut("slow");
    $("#suggestion-info").hide();
  }