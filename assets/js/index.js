$(document).ready(function () {
  //called when key is pressed in textbox
  $("#studentNo").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 48 && inputValue <= 57) && !(inputValue == 32 && inputValue == 0) && inputValue != 13) { 
        $("#errmsg").html("Numbers Only").show().fadeOut("slow");
        return false;
      }
  });
  $("#age").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && inputValue != 13) {
        //display error message
        $("#errmsg").html("Numbers Only").show().fadeOut("slow");
          return false;
    }
  });
  $("#cphone").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Numbers Only").show().fadeOut("slow");
          return false;
    }
  });
  $("#tphone").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Numbers Only").show().fadeOut("slow");
          return false;
    }
  });
  $("#last_name").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
        //display error message
        $("#errmsg").html("Letters Only").show().fadeOut("slow");
            return false;
      }
  });
  $("#first_name").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
        //display error message
        $("#errmsg").html("Letters Only").show().fadeOut("slow");
            return false;
      }
  });
  $("#middle_name").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
        //display error message
        $("#errmsg").html("Letters Only").show().fadeOut("slow");
            return false;
      }
  });
  $("#ext").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
        //display error message
        $("#errmsg").html("Letters Only").show().fadeOut("slow");
            return false;
      }
  });
  $("#cperson").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
        //display error message
        $("#errmsg").html("Letters Only").show().fadeOut("slow");
            return false;
      }
  });

  // Validations
  $('#studentNo').keyup(function () {
    var cctlength = $(this).val().length; // get character length

    switch (cctlength) {
        case 3:
            var cctVal = $(this).val();
            var cctNewVal = cctVal + '-';
            $(this).val(cctNewVal);
            break;
        case 9:
            var cctVal = $(this).val();
            var cctNewVal = cctVal + '-';
            $(this).val(cctNewVal);
            break;
        default:
            break;
    }
  });
  $(function(){
    $('#current_year').change(function(){ // when one changes
      $('#next_year').val( $(this).val() ) // they all change
    })
  })
});

$(document).ready(function() {  
    /*Menu-toggle*/
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    $("#close").on("click", function () {
    	window.open("tbl_rec.php", "_self");
	});
});

// Menu Collapse
$(document).ready(function () {
  //Tooltip
  $('[data-toggle="tooltip"]').tooltip();
  //Menu Links
  $('ul[role="menu"]') 
    .on('show.bs.collapse', function (e) {
      $(e.target).prev('a[role="menuitem"]').addClass('active');
    })
    .on('hide.bs.collapse', function (e) {
      $(e.target).prev('a[role="menuitem"]').removeClass('active');
  });

  $('a[data-toggle="collapse"]').click(function (event) {
    event.stopPropagation();
    event.preventDefault();

    var drop = $(this).closest(".dropdown");
    $(drop).addClass("open");

    $('.collapse.in').collapse('hide');
    var col_id = $(this).attr("href");
    $(col_id).collapse('toggle');
  });
});
//Filter Table

//Disable inputs untill student number is filled up
(function() {
    $('form > input').keyup(function() {

        var empty = false;
        $('form > input').each(function() {
            if ($(this).val() == '') {
                empty = true;
            }
        });

        if (empty) {
            $('#register').attr('disabled', 'disabled');
        } else {
            $('#register').removeAttr('disabled');
        }
    });
})()