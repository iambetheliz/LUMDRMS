//Faculties
$(document).ready(function(){
    $('#overlay').show();
    $("#tbl_faculties").load("../faculties/tbl_faculties.php");
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
            $("#tbl_faculties").load("../faculties/tbl_faculties.php");
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
            $("#tbl_faculties").load("../faculties/tbl_faculties.php");
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
          $("#tbl_faculties").load("../faculties/tbl_faculties.php");
          $.notify("Data updated successfully", "success");
        }
      });
    });
  });