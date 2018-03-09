//Faculties
$(document).ready(function () {
  $("#tbl_faculties").load("../faculties/tbl_faculties.php");
  $('#add_fac').submit(function() {
    return false;
    $.ajaxSetup ({
      cache: false
    });
    $("#add_fac")[0].reset();
    $("#facultyNo").focus();
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

  /* validate Adding */
  $("#add_fac").validate({
    rules: {
      facultyNo: {
        required: true
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
      sem: {
        required: true,
      },
      acadYear: {
        required: true,
      },
    },
  submitHandler: addFaculty 
  });
  /* validate Adding */
  $("#edit_fac").validate({
    rules: {
      facultyNo: {
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
      sem: {
        required: true,
      },
      acadYear: {
        required: true,
      },
    },
  submitHandler: editFaculty 
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
  //Delete Single
  $(document).on('click', '.delete', function(){
    $FacultyID = $("#confirm-delete #delID").val();
      $.ajax({
        type: "POST",
        url: "../faculties/delete.php",
        cache: false,
        data: {
          FacultyID: $FacultyID,
          del: 1,
        },
        success: function(){
          $("#tbl_faculties").load("../faculties/tbl_faculties.php");
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
          $("#confirm-delete").modal('hide');
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
  //Restore Single
  $(document).on('click', '#restore', function(){
    $FacultyID = $(this).val();
    $.ajax({
      type: "POST",
      url: "../faculties/restore_record.php",
      cache: false,
      data: {
        FacultyID: $FacultyID,
        restore: 1,
      },
      success: function(){
        $("#tbl_faculties").load("../faculties/tbl_faculties.php");
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

function addFaculty() {
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
      $.bootstrapGrowl("Faculty added successfully!", // Messages
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
      $("#tbl_faculties").load("../faculties/tbl_faculties.php");
    }
  });
}

function editFaculty() {
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
      $("#tbl_faculties").load("../faculties/tbl_faculties.php");
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
  var dept_id = $('#dept_list').val(); 
  var stats = $('#stats').val(); 
  var archive = $('#archive').val();
  var num_rows = $('#num_rows').val();
  $.ajax({
    type: 'POST',
    url: '../faculties/tbl_faculties.php',
    data:{
      page:page_num,
      num_rows:num_rows,
      keywords:keywords,
      sortBy:sortBy,
      dept_id:dept_id,
      stats:stats,
      archive:archive
    },
    beforeSend: function () {
      $('#overlay').show();
      $('.faculties').hide();
    },
    success: function (data) {
      $('#overlay').show();
      $('#overlay').hide().fadeOut("slow");
      $('#tbl_faculties').html(data);
    }
  });
}