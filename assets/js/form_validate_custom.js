//Form Validation
$(document).ready(function () {
  
  // Inputt Fields
  $('#facultyNo').keypress(function (e) {
    $("#errFN").hide();

    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      $("#errFN").html("Numbers Only!").show().fadeOut("slow");
      return false;
    } 

    var curchr = this.value.length;
    var curval = $(this).val();

    if (curchr == 4 && curval.indexOf("(") <= -1) {
      $(this).val(curval + "-");
    } else if (curchr == 4 && curval.indexOf("(") > -1) {
      $(this).val(curval + ")-");
    } else if (curchr == 8) {
      $(this).val(curval);
      $(this).attr('maxlength', '9'); 
      return true;
    } else if (curchr == 9) {
      $("#errFN").html("8 digits only!").show().fadeOut("slow");
        return false;
    } else if($("#facultyNo").val().length >= 0){
        $("#facultyNo").removeClass("error");
    } 
  });

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
    } else if($("#studentNo").val().length >= 0){
        $("#studentNo").removeClass("error");
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

    if (phonechr == 4 && phoneval.indexOf("(") <= -1) {
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

  //Capitalize each word
  $("#user_form input, #user_form textarea").keyup(function(e) {
    var arr = $(this).val().split(' ');
    var result = '';
    for (var x = 0; x < arr.length; x++)
    result += arr[x].substring(0, 1).toUpperCase() + arr[x].substring(1) + ' ';
    $(this).val(result.substring(0, result.length - 1));
  });

  $("#first_name").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
        //display error message
        $("#errFirst").html("Letters Only").show().fadeOut("slow");
            return false;
      } else if($("#first_name").val().length >= 0){
        $("#first_name").removeClass("error");
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
  $("#program").change(function(){
    if($("#program").val().length != 0){
        $("#program").removeClass("error");
    } 
  });
  $("#yearLevel").change(function(){
    if($("#yearLevel").val().length != 0){
        $("#yearLevel").removeClass("error");
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