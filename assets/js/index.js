$("input[type=password]").keyup(function(){
    var ucase = new RegExp("[A-Z]+");
	var lcase = new RegExp("[a-z]+");
	var num = new RegExp("[0-9]+");
	
	if($("#userPass").val().length >= 8){
		$("#8char").removeClass("glyphicon-remove");
		$("#8char").addClass("glyphicon-ok");
		$("#8char").css("color","#00A41E");
	}else{
		$("#8char").removeClass("glyphicon-ok");
		$("#8char").addClass("glyphicon-remove");
		$("#8char").css("color","#FF0004");
	}
	
	if(ucase.test($("#userPass").val())){
		$("#ucase").removeClass("glyphicon-remove");
		$("#ucase").addClass("glyphicon-ok");
		$("#ucase").css("color","#00A41E");
	}else{
		$("#ucase").removeClass("glyphicon-ok");
		$("#ucase").addClass("glyphicon-remove");
		$("#ucase").css("color","#FF0004");
	}
	
	if(lcase.test($("#userPass").val())){
		$("#lcase").removeClass("glyphicon-remove");
		$("#lcase").addClass("glyphicon-ok");
		$("#lcase").css("color","#00A41E");
	}else{
		$("#lcase").removeClass("glyphicon-ok");
		$("#lcase").addClass("glyphicon-remove");
		$("#lcase").css("color","#FF0004");
	}
	
	if(num.test($("#userPass").val())){
		$("#num").removeClass("glyphicon-remove");
		$("#num").addClass("glyphicon-ok");
		$("#num").css("color","#00A41E");
	}else{
		$("#num").removeClass("glyphicon-ok");
		$("#num").addClass("glyphicon-remove");
		$("#num").css("color","#FF0004");
	}
	
	if($("#userPass").val() == $("#password2").val()){
		$("#pwmatch").removeClass("glyphicon-remove");
		$("#pwmatch").addClass("glyphicon-ok");
		$("#pwmatch").css("color","#00A41E");
	}else{
		$("#pwmatch").removeClass("glyphicon-ok");
		$("#pwmatch").addClass("glyphicon-remove");
		$("#pwmatch").css("color","#FF0004");
	}
});

$(document).ready(function() {
    $('.input-group input[class=form-control]').on('keyup change', function() {
    	var $form = $(this).closest('form'),
            $group = $(this).closest('.input-group'),
			$addon = $group.find('.input-group-addon'),
			$icon = $addon.find('span'),
			state = false;
            
    	if (!$group.data('validate')) {
			state = $(this).val() ? true : false;
		}else if ($group.data('validate') == "userName") {
			state = /^([a-zA-Z0-9]{5})/.test($(this).val())
		}else if ($group.data('validate') == "email") {
			state = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test($(this).val())
		}else if ($group.data('validate') == "userPass") {
			state = /^([a-zA-Z0-9]{8})/.test($(this).val())
		}

		if (state) {
				$addon.removeClass('danger');
				$addon.addClass('success');
				$icon.attr('class', 'glyphicon glyphicon-ok');
		}else{
				$addon.removeClass('success');
				$addon.addClass('danger');
				$icon.attr('class', 'glyphicon glyphicon-remove');
		}
        
	});    
    
});


$(document).ready(function () {
  //called when key is pressed in textbox
  $("#age").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
  $("#lettersOnly").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
        //display error message
        $("#errmsg").html("Letters Only").show().fadeOut("slow");
            return false;
      }
  });
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
  $("#studentNo").keypress(function(event){
      var inputValue = event.which;
      // allow letters and whitespaces only.
      if((inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
        return false;
      }
  });
  $(function(){
    $('#current_year').change(function(){ // when one changes
      $('#next_year').val( $(this).val() ) // they all change
    })
  })
  $('#otherCheckBox').change(function(){
    $("#otherTextBoxId").prop("disabled", !$(this).is(':checked'));
  });
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