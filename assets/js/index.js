$(document).ready(function () {

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
  
  //Settings Menu
  $("[data-toggle='toggle']").click(function() {
    var selector = $(this).data("target");
    $(selector).toggleClass('in');
  });

});
//Filter Table

//Disable inputs untill student number is filled up

//Form Validation
$(document).ready(function () {
  
  // Inputt Fields
  $('#studentNo').keypress(function (e) {
      $("#errSN").hide();

    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      $("#errSN").html("Numbers Only!").show().fadeOut("slow");
      return false;
    } else {
      $("#studentNo").removeClass('error');
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
      $("#errSN").html("8 characters only!").show().fadeOut("slow");
        return false;
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
    } 
  });

    $("#cphone").keypress(function (e) {
    $("#errTel").hide();

    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      $("#errTel").html("Numbers Only").show().fadeOut("slow");
        return false;
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
    } 
  });

  $("#first_name").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 0 && inputValue != 45 && inputValue != 46)) { 
        //display error message
        $("#errFirst").html("Invalid key input!").show().fadeOut("slow");
            return false;
      }
  });
  document.getElementById("first_name").addEventListener("input", forceLower);
  function forceLower(evt) {
    var words = evt.target.value.split(/\s+/g);
    var newWords = words.map(function(element){
      element = element.toLowerCase();
      return element !== "" ?  element[0].toUpperCase() + element.substr(1, element.length) : "";
    });
  
    evt.target.value = newWords.join(" "); 
  }
  $("#middle_name").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
        //display error message
        $("#errMid").html("Invalid key input!").show().fadeOut("slow");
            return false;
      }
  });
  document.getElementById("middle_name").addEventListener("input", forceLower);
  function forceLower(evt) {
    var words = evt.target.value.split(/\s+/g);
    var newWords = words.map(function(element){
      element = element.toLowerCase();
      return element !== "" ?  element[0].toUpperCase() + element.substr(1, element.length) : "";
    });
  
    evt.target.value = newWords.join(" "); 
  }
  $("#last_name").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
        //display error message
        $("#errLast").html("Letters Only").show().fadeOut("slow");
            return false;
      }
  });
  document.getElementById("last_name").addEventListener("input", forceLower);
  function forceLower(evt) {
    var words = evt.target.value.split(/\s+/g);
    var newWords = words.map(function(element){
      element = element.toLowerCase();
      return element !== "" ?  element[0].toUpperCase() + element.substr(1, element.length) : "";
    });
  
    evt.target.value = newWords.join(" "); 
  }
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
  document.getElementById("ext").addEventListener("input", forceLower);
  function forceLower(evt) {
    var words = evt.target.value.split(/\s+/g);
    var newWords = words.map(function(element){
      element = element.toLowerCase();
      return element !== "" ?  element[0].toUpperCase() + element.substr(1, element.length) : "";
    });
  
    evt.target.value = newWords.join(" "); 
  }
  $("#address").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 44 && inputValue != 46 && inputValue != 0) && !(inputValue >= 48 && inputValue <= 57)) { 
        //display error message
        $("#errAdd").html("Invalid character").show().fadeOut("slow");
            return false;
      }
  });
  document.getElementById("address").addEventListener("input", forceLower);
  function forceLower(evt) {
    var words = evt.target.value.split(/\s+/g);
    var newWords = words.map(function(element){
      element = element.toLowerCase();
      return element !== "" ?  element[0].toUpperCase() + element.substr(1, element.length) : "";
    });
  
    evt.target.value = newWords.join(" "); 
  }
  $("#cperson").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 90 || inputValue >=97 && inputValue <= 122) && (inputValue != 32 && inputValue != 46 && inputValue != 0)) { 
        //display error message
        $("#errPer").html("Letters Only").show().fadeOut("slow");
            return false;
      }
  });
  document.getElementById("cperson").addEventListener("input", forceLower);
  function forceLower(evt) {
    var words = evt.target.value.split(/\s+/g);
    var newWords = words.map(function(element){
      element = element.toLowerCase();
      return element !== "" ?  element[0].toUpperCase() + element.substr(1, element.length) : "";
    });
  
    evt.target.value = newWords.join(" "); 
  }

  $(function() {

    $('#add').click(function() {
      $('#errSN').hide();

      if ($('.form-control').val() == '') {
        $("#errmsg").html("* Required Fields!").show();
        $(".form-control").addClass('error');
        $("#studentNo").focus();
          return false;
      } else if($("#studentNo").val().length >= 8){
        $("#studentNo").removeClass("error");
      } else{
        $("#studentNo").addClass("error");
        $("#errSN").html("Required!").show();
        $("#studentNo").focus();
          return false;
      } 

    });

  });
});