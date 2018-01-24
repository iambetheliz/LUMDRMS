//students
$(document).ready(function(){
  $('#overlay').show();
	$("#tbl_students").load("../students/tbl_students.php");
  $('#overlay').fadeOut('fast');	
	$('#add_stud').submit(function() {
		return false;
		$.ajaxSetup ({
      cache: false
  	});
    $("#add_stud")[0].reset();
    $('#addnew').val();
    $('#userModal').modal('hide'); 
	});
  $('#edit_stud').submit(function() {
    return false;
    $.ajaxSetup ({
      cache: false
    });
    $("#edit_stud")[0].reset();
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
  //Check availability
  $("#studentNo").keyup(function() {  
    var studentNo = $(this).val(); 
    
    if(studentNo.length > 3) {  
      $("#result").html('Checking ... <i class="fa fa-circle-o-notch fa-spin"></i>');
     
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
	//Add New
	$(document).on('click', '#addnew', function(){
		if($('.required').val() == "")  {  
      $("#msg").html("<div class='alert alert-danger'>Required fields!</div>").show();
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
		else {
			$.ajax({
				type: "POST",
				url: "../students/addnew.php",
        cache: false,
				data: $('#add_stud').serialize(),  
        beforeSend:function() {  
          $('#addnew').val("Inserting");  
        },  
				success: function(){
          $('#userModal').modal('hide'); 
          $("#add_stud")[0].reset();
          $('#addnew').val("Add New"); 
					$("#tbl_students").load("../students/tbl_students.php");
          $.bootstrapGrowl("Student added successfully!", // Messages
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
            }
          );
				}
			});
		}
	});
	//Delete Single
	$(document).on('click', '.delete', function(){
		$StudentID = $(this).val();
		$.ajax({
			type: "POST",
			url: "../students/delete.php",
      cache: false,
			data: {
				StudentID: $StudentID,
				del: 1,
			},
			success: function(){
				$("#tbl_students").load("../students/tbl_students.php");
        $.bootstrapGrowl("Deleted successfully", // Messages
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
      $('#modal-loader').fadeOut('fast');
    });
  });
  //Update
  $(document).on('click', '#update', function(){
    $.ajax({
      type: "POST",
      url: "update.php",
      cache: false,
      data: $('#edit_stud').serialize(), 
      beforeSend:function() {  
        $('#update').val("Updating");  
      },  
      success: function(){
        $('#view-modal').modal('hide'); 
        $("#edit_stud")[0].reset();
        $('#update').val("Update Record"); 
        $("#tbl_students").load("tbl_students.php");
        $.notify("Data updated successfully", "success")
      }
    });
  });
});

function searchFilter(page_num) {
  page_num = page_num?page_num:0;
  var keywords = $('#keywords').val();
  var sortBy = $('#sortBy').val();
  var program_id = $('#prog_list').val(); 
  $.ajax({
    type: 'POST',
    url: '../students/tbl_students.php',
    data:{page:page_num,keywords:keywords,sortBy:sortBy,program_id:program_id},
    beforeSend: function () {
      $('#overlay').show();
    },
    success: function (data) {
      $('#tbl_students').html(data);
      $('#overlay').fadeOut("fast");
    }
  });
}