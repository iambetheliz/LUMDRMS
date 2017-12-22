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
      $('#program').html('<option value="">Select departmentt first</option>');
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
				data: $('#add_stud').serialize(),  
        beforeSend:function() {  
          $('#addnew').val("Inserting");  
        },  
				success: function(){
          $('#userModal').modal('hide'); 
          $("#add_stud")[0].reset();
          $('#addnew').val("Add New"); 
					$("#tbl_students").load("../students/tbl_students.php");
          $.notify("Data added successfully", "success");
				}
			});
		}
	});
	//Delete
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
      data: $('#edit_stud').serialize(), 
      beforeSend:function() {  
        $('#update').val("Updating");  
      },  
      success: function(){
        $('#view-modal').modal('hide'); 
        $("#edit_stud")[0].reset();
        $('#update').val("Update Record"); 
        $("#tbl_students").load("../students/tbl_students.php");
        $.notify("Data updated successfully", "success");
      }
    });
  });
});

//Faculties
$(document).ready(function(){
    $('#overlay').show();
    $("#tbl_faculties").load("tbl_faculties.php");
    $('#overlay').fadeOut('fast');  
    $('#add_fac').submit(function() {
      return false;
      $.ajaxSetup ({
        cache: false
      });
      $("#add_fac")[0].reset();
      $('#addnew').val();
      $('#userModal').modal('hide'); 
    });
    $('#edit_fac').submit(function() {
      return false;
      $.ajaxSetup ({
        cache: false
      });
        $("#edit_fac")[0].reset();
        $('#addnew').val();
        $('#view-modal').modal('hide'); 
    });
    //Select department            
    $('#dept').on('change',function(){
      var deptID = $(this).val();
      if(deptID){
        $.ajax({
          type:'POST',
          url:'../courses.php',
          data:'dept_id='+deptID,
          success:function(html){
            $('#program').html(html); 
          }
        }); 
      } 
    });
    //Add New
    $(document).on('click', '#addnew', function(){
      if($('.required').val() == "")  {  
        $("#msg").html("* Required Fields!").show();
        $(".required").addClass('error');
        $("#facultyNo").focus();
        return false; 
      } 
      else if($('#dept').val() == "")  {  
        $("#msg").html("* Required!").show();
        $("#dept").addClass('error');
        $("#dept").focus();
        return false; 
      }  
      else {
        $.ajax({
          type: "POST",
          url: "../faculties/addnew.php",
          data: $('#add_fac').serialize(),  
          cache: false,
          beforeSend:function() {  
            $('#addnew').val("Inserting");  
          },  
          success: function(){  
            $('#userModal').modal('hide'); 
            $("#add_fac")[0].reset();
            $('#addnew').val("Add New"); 
            $("#tbl_faculties").load("tbl_faculties.php");
            $.notify("Data added successfully", "success");
          }
        });
      }
    });
    //Delete
    $(document).on('click', '.delete', function(){
      $FacultyID=$(this).val();
        $.ajax({
          type: "POST",
          url: "../faculties/delete.php",
          data: {
            FacultyID: $FacultyID,
            del: 1,
          },
          success: function(){
            $("#tbl_faculties").load("tbl_faculties.php");
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
        url: '../faculties/edit_data.php',
        type: 'POST',
        data: 'FacultyID='+uid,
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
        url: "../faculties/update.php",
        cache: false,
        data: $('#edit_fac').serialize(), 
        beforeSend:function() {  
          $('#update').val("Updating");  
        },  
        success: function(){
          $('#view-modal').modal('hide'); 
          $("#edit_fac")[0].reset();
          $('#update').val("Update Record"); 
          $("#tbl_faculties").load("tbl_faculties.php");
          $.notify("Data updated successfully", "success");
        }
      });
    });
  });