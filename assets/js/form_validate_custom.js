$(document).ready(function () {
  //Capitalize each word
  $("#first_name, #first_name_edit, #last_name, #last_name_edit, #middle_name, #middle_name_edit, #ext, #ext_edit, #address, #address_edit, #cperson, #cperson_edit, #med_form input[type='text']").keyup(function(e) {
    var arr = $(this).val().split(' ');
    var result = '';
    for (var x = 0; x < arr.length; x++)
    result += arr[x].substring(0, 1).toUpperCase() + arr[x].substring(1) + ' ';
    $(this).val(result.substring(0, result.length - 1));
  });

  //Medical Form 
  $("#otherSysRevCheck").click(function () {
    if ($(this).is(":checked")) {
      $("#otherSysRev").show().focus();
      $("#otherSysRev").prop("disabled", false);
    } else {
      $("#otherSysRev").hide();
      $("#otherSysRev").prop("disabled", true);
    }
  });
  $("#otherMedHisCheck").click(function () {
    if ($(this).is(":checked")) {
      $("#otherMedHis").show().focus();
    } else {
      $("#otherMedHis").hide();
    }
  });
  $("#dys").click(function () {
    if ($(this).is(":checked")) {
      $(".dys").prop("disabled", false);
    } else {
      $(".dys").prop("disabled", true);
    }
  });
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


  $('#facultyNo').keypress(function (e) {
      $("#errFN").hide();

    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      $("#errFN").html("Numbers Only!").show().fadeOut("slow");
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
});