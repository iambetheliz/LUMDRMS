//students
$(document).ready(function () {
  $("#tbl_students").load("../students/tbl_students.php"); 
  $('#add_stud').submit(function() {
    return false;
    $.ajaxSetup ({
      cache: false
    });
    $("#add_stud")[0].reset();
    $("#studentNo").focus();
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

  /* validate Adding */
  $("#add_stud").validate({
    rules: {
      studentNo: {
        required: true,
        minlength: 7,
      },
      first_name: {
        required: true,
        minlength: 3
      },
      last_name: {
        required: true,
        minlength: 3
      },
      ext: {
        minlength: 2,
        maxlength: 3
      },
      age: {
        minlength: 2,
        maxlength: 2
      },
      gender: {
        required: true,
      },
      dept: {
        required: true,
      },
      program: {
        required: true,
      },
      yearLevel: {
        required: true,
      },
      sem: {
        required: true,
      },
      acadYear: {
        required: true,
      },
    },
  submitHandler: addStudent 
  });
  /* validate Adding */
  $("#edit_stud").validate({
    rules: {
      studentNo: {
        required: true,
        minlength: 7,
      },
      first_name: {
        required: true,
        minlength: 3
      },
      last_name: {
        required: true,
        minlength: 3
      },
      gender: {
        required: true,
      },
      dept: {
        required: true,
      },
      program: {
        required: true,
      },
      yearLevel: {
        required: true,
      },
      sem: {
        required: true,
      },
      acadYear: {
        required: true,
      },
    },
  submitHandler: editStudent 
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
    
    if(studentNo.length > 2) {       
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
        $('tr#table-row-'+$StudentID+'').css('background-color', '#ddd');
        $('tr#table-row-'+$StudentID+'').css('border-color', 'black');
        $('tr#table-row-'+$StudentID+'').fadeOut(3000);
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
  //Restore Single
  $(document).on('click', '#restore', function(){
    $StudentID = $(this).val();
    $.ajax({
      type: "POST",
      url: "../students/restore_record.php",
      cache: false,
      data: {
        StudentID: $StudentID,
        restore: 1,
      },
      success: function(){
        $('tr#table-row-'+$StudentID+'').css('background-color', 'darkseagreen');
        $('tr#table-row-'+$StudentID+'').css('border-color', 'green');
        $('tr#table-row-'+$StudentID+'').fadeOut(3000);
        $("#tbl_students").load("../students/tbl_students.php");
        $.bootstrapGrowl("Restored successfully", // Messages
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
});

function addStudent() {
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
      $("#tbl_students").load("../students/tbl_students.php");
    }
  });
}

function editStudent() {
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
      $.bootstrapGrowl("Data updated successfully", // Messages
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

function searchFilter(page_num) {
  page_num = page_num?page_num:0;
  var keywords = $('#keywords').val();
  var sortBy = $('#sortBy').val();
  var program_id = $('#prog_list').val();
  var stats = $('#stats').val(); 
  var archive = $('#archive').val();
  var num_rows = $('#num_rows').val();
  $.ajax({
    type: 'POST',
    url: '../students/tbl_students.php',
    data: {
      page:page_num,
      num_rows:num_rows,
      keywords:keywords,
      sortBy:sortBy,
      program_id:program_id,
      stats:stats,
      archive:archive
    },
    beforeSend: function () {
      $('#overlay').show();
      $('.students').hide();
    },
    success: function (data) {
      $('#overlay').show();
      $('#overlay').hide().fadeOut("slow");
      $('#tbl_students').html(data);
    }
  });
}

$(document).ready(function () {
  // Inputt Fields
  $('#studentNo').keypress(function (e) {
      $("#errSN").hide();

    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      $("#errSN").html("Numbers Only!").show().fadeOut("slow");
      return false;
    } 

    var curchr = this.value.length;
    var curval = $(this).val();

    if (curchr == 3 && curval.indexOf("(") <= -1) {
      $(this).val(curval + "-");
    } else if (curchr == 4 && curval.indexOf("(") > -1) {
      $(this).val(curval + ")-");
    } else if (curchr == 7) {
      $(this).val(curval);
      $(this).attr('maxlength', '8'); 
      return true;
    } else if (curchr == 8) {
      $("#errSN").html("7 digits only!").show().fadeOut("slow");
        return false;
    } 
  });

  $("#age, #age_edit").keypress(function (e) {
    $("#errAge").hide();

    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      $("#errAge").html("Numbers Only").show().fadeOut("slow");
        return false;
    } 

    var agechr = this.value.length;
    var ageval = $(this).val(); 

    if (agechr == 2) {
      $(this).val(ageval);
      $(this).attr('maxlength', '2'); 
      $("#errAge").html("2 characters only!").show().fadeOut("slow");
      return true;
    } 
  });

  $("#cphone, #cphone_edit").keypress(function (e) {
    $("#errTel").hide();

    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      $("#errTel").html("Numbers Only").show().fadeOut("slow");
        return false;
    } 

    var phonechr = this.value.length;
    var phoneval = $(this).val(); 

    if (phonechr == 0) {
      if (e.which != 48) {
        $("#errTel").html("Start at 0").show().fadeOut("slow");
        return false;
      }      
    }
    else if (phonechr == 1) {
      if (e.which != 57) {
        $("#errTel").html("09-- format!").show().fadeOut("slow");
        return false;
      }      
    }
    else if (phonechr == 4 && phoneval.indexOf("(") <= -1) {
      $(this).val(phoneval + " ");
    } else if (phonechr == 8 && phoneval.indexOf("(") <= -1) {
      $(this).val(phoneval + " ");
    } else if (phonechr == 11) {
      $(this).val(phoneval);
      $(this).attr('maxlength', '13'); 
      return true;
    } else if (phonechr == 13) {
      $("#errTel").html("Max. of 11").show().fadeOut("slow");
        return false;
    } 
  });
  $("#phone, #phone_edit").keypress(function (e) {
    $("#errPhone").hide();

    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      $("#errPhone").html("Numbers Only").show().fadeOut("slow");
        return false;
    } 

    var phonechr = this.value.length;
    var phoneval = $(this).val(); 

    if (phonechr == 0) {
      if (e.which != 48) {
        $("#errPhone").html("Start at 0").show().fadeOut("slow");
        return false;
      }      
    }
    else if (phonechr == 1) {
      if (e.which != 57) {
        $("#errPhone").html("09-- format!").show().fadeOut("slow");
        return false;
      }      
    }
    else if (phonechr == 4 && phoneval.indexOf("(") <= -1) {
      $(this).val(phoneval + " ");
    } else if (phonechr == 8 && phoneval.indexOf("(") <= -1) {
      $(this).val(phoneval + " ");
    } else if (phonechr == 11) {
      $(this).val(phoneval);
      $(this).attr('maxlength', '13'); 
      return true;
    } else if (phonechr == 13) {
      $("#errPhone").html("Max. of 11").show().fadeOut("slow");
        return false;
    } 
  });

  $("#first_name, #first_name_edit").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 46 && inputValue != 0)) { 
        //display error message
        $("#errFirst").html("Letters Only").show().fadeOut("slow");
          return false;
      } 
  });
  $("#middle_name, #middle_name_edit").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
        //display error message
        $("#errMid").html("Letters Only").show().fadeOut("slow");
            return false;
      } 
  });
  $("#last_name, #last_name_edit").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
        //display error message
        $("#errLast").html("Letters Only").show().fadeOut("slow");
            return false;
      } 
  });
  $("#ext, #ext_edit").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
        //display error message
        $("#errExt").html("Letters only!").show().fadeOut("slow");
        $(".text-muted").hide();
            return false;
      }
  });
  $("#address, #address_edit").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 44 && inputValue != 46 && inputValue != 0) && !(inputValue >= 48 && inputValue <= 57)) { 
        //display error message
        $("#errAdd").html("Invalid character").show().fadeOut("slow");
            return false;
      } 
  });
  $("#cperson, #cperson_edit").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 46 && inputValue != 0)) { 
        //display error message
        $("#errPer").html("Letters Only").show().fadeOut("slow");
            return false;
      } 
  });
})