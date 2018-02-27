//Faculties
$(document).ready(function () {

  $('#height').keypress(function (e) {
    $("#errHeight").hide();

    if ((e.which < 0 || e.which > 32) && (e.which < 48 || e.which > 57)) {
      $("#errHeight").html("numbers only!").show().fadeOut("slow");
      return false;
    } 

    var keyChr = this.value.length;
    var heightval = $(this).val();

    if (keyChr == 3) {
      $("input[decimaldigits]").decimalDigitify();
    }
    else if (keyChr == 5) {
      $(this).val(heightval);
      $(this).attr('maxlength', '5'); 
      $("#errHeight").html("5 digits only!").show().fadeOut("slow");
        return false;
    } 
  });
  $('#weight').keypress(function (e) {
    $("#errWeight").hide();

    if ((e.which < 0 || e.which > 32) && (e.which < 48 || e.which > 57)) {
      $("#errWeight").html("numbers only!").show().fadeOut("slow");
      return false;
    } 

    var keyChr = this.value.length;
    var heightval = $(this).val();

    if (keyChr == 3) {
      $("input[decimaldigits]").decimalDigitify();
    }
    else if (keyChr == 6) {
      $(this).val(heightval);
      $(this).attr('maxlength', '6'); 
      $("#errWeight").html("5 digits only!").show().fadeOut("slow");
        return false;
    } 
  });

  // Inputt Fields
  $('#facultyNo').keypress(function (e) {
      $("#errFN").hide();

    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      $("#errFN").html("Numbers Only!").show().fadeOut("slow");
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
      $("#errFN").html("7 digits only!").show().fadeOut("slow");
        return false;
    } else if($("#facultyNo").val().length >= 0){
        $("#facultyNo").removeClass("error");
    } 
  });

  $("#age").keypress(function (e) {
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
    } else if($("#age").val().length >= 0){
        $("#age").removeClass("error");
    } 
  });

  $("#cphone").keypress(function (e) {
    $("#errTel").hide();

    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      $("#errTel").html("Numbers Only").show().fadeOut("slow");
        return false;
    } else {
      $("#cphone").removeClass('error');
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
    } else if($("#cphone").val().length >= 0){
        $("#cphone").removeClass("error");
    } 
  });
  $("#phone").keypress(function (e) {
    $("#errPhone").hide();

    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      $("#errPhone").html("Numbers Only").show().fadeOut("slow");
        return false;
    } else {
      $("#phone").removeClass('error');
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
    } else if($("#phone").val().length >= 0){
        $("#phone").removeClass("error");
    } 
  });

  //Capitalize each word
  $("#add_fac input, #add_fac textarea").keyup(function(e) {
    var arr = $(this).val().split(' ');
    var result = '';
    for (var x = 0; x < arr.length; x++)
    result += arr[x].substring(0, 1).toUpperCase() + arr[x].substring(1) + ' ';
    $(this).val(result.substring(0, result.length - 1));
  });

  $("#first_name").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 46 && inputValue != 0)) { 
        //display error message
        $("#errFirst").html("Letters Only").show().fadeOut("slow");
          return false;
      } 
      else if($(this).val().length >= 0){
        $(this).removeClass("error");
      } 
  });
  $("#middle_name").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
        //display error message
        $("#errMid").html("Letters Only").show().fadeOut("slow");
            return false;
      } else if($("#middle_name").val().length >= 0){
        $("#middle_name").removeClass("error");
    } 
  });
  $("#last_name").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
        //display error message
        $("#errLast").html("Letters Only").show().fadeOut("slow");
            return false;
      } else if($("#last_name").val().length >= 0){
        $("#last_name").removeClass("error");
    } 
  });
  $("#ext").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
        //display error message
        $("#errExt").html("Letters only!").show().fadeOut("slow");
        $(".text-muted").hide();
            return false;
      }
  });
  $("#sex").change(function(){
    if($("#sex").val().length != 0){
        $("#sex").removeClass("error");
    } 
  });
  $("#dept").change(function(){
    if($("#dept").val().length != 0){
        $("#dept").removeClass("error");
    } 
  });
  $("#sem").change(function(){
    if($("#sem").val().length != 0){
        $("#sem").removeClass("error");
    } 
  });
  $("#acadYear").change(function(){
    if($("#acadYear").val().length != 0){
        $("#acadYear").removeClass("error");
    } 
  });
  $("#address").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 44 && inputValue != 46 && inputValue != 0) && !(inputValue >= 48 && inputValue <= 57)) { 
        //display error message
        $("#errAdd").html("Invalid character").show().fadeOut("slow");
            return false;
      } else if($("#address").val().length >= 0){
        $("#address").removeClass("error");
    } 
  });
  $("#cperson").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 46 && inputValue != 0)) { 
        //display error message
        $("#errPer").html("Letters Only").show().fadeOut("slow");
            return false;
      } else if($("#cperson").val().length >= 0){
        $("#cperson").removeClass("error");
    } 
  });
});

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
      $("#msg").html("<div class='alert alert-danger'>Required fields!</div>").show();
      $(".required").addClass('error');
      $("#facultyNo").focus();
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