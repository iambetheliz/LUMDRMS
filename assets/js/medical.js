//Medical Form
$(document).ready(function(){
  //this calculates BP values automatically
  $("#upper, #lower").on("keydown keyup",function(){
    var upper = $("#upper").val();
    var lower = $("#lower").val();

    if ((upper >= 60 && upper <= 90) && (lower >= 40 && lower <= 60)) {
      $("#bp_reading").val('Low Blood Pressure');
    }
    else if ((upper >= 90 && upper <= 120) && (lower >= 60 && lower <= 80)) {
      $("#bp_reading").val('Normal Blood Pressure');
    }
    else if ((upper >= 120 && upper <= 130) && (lower >= 60 && lower <= 80)) {
      $("#bp_reading").val('Elevated Blood Pressure');
    }
    else if ((upper >= 130 && upper <= 139) && (lower >= 80 && lower <= 89)) {
      $("#bp_reading").val('Stage 1 Hypertension');
    }
    else if ((upper >= 140 && upper <= 180) && (lower >= 90 && lower <= 120)) {
      $("#bp_reading").val('Stage 2 Hypertension');
    }
    else if ((upper >= 180) && (lower >= 120)) {
      $("#bp_reading").val('Hypertensive Crisis');
    }  
  });

  $("#input_abnormal_gen").click(function () {
    $("#abnormal_gen").attr("checked", "checked");
  });
  $("#input_abnormal_skin").click(function () {
    $("#abnormal_skin").attr("checked", "checked");
  });
  $("#input_abnormal_heent").click(function () {
    $("#abnormal_heent").attr("checked", "checked");
  });
  $("#input_abnormal_lungs").click(function () {
    $("#abnormal_lungs").attr("checked", "checked");
  });
  $("#input_abnormal_heart").click(function () {
    $("#abnormal_heart").attr("checked", "checked");
  });
  $("#input_abnormal_abdomen").click(function () {
    $("#abnormal_abdomen").attr("checked", "checked");
  });
  $("#input_abnormal_extreme").click(function () {
    $("#abnormal_extreme").attr("checked", "checked");
  });

  $("input[type=radio]").click(function () {
    if ($("#normal_gen").is(":checked")) {
      $("#input_abnormal_gen").prop("disabled", true);
    } 
    else if ($("#abnormal_gen").is(":checked")) {
      $("#input_abnormal_gen").prop("disabled", false);
    } 

    if ($("#normal_skin").is(":checked")) {
      $("#input_abnormal_skin").prop("disabled", true);
    } else if ($("#abnormal_skin").is(":checked")) {
      $("#input_abnormal_skin").prop("disabled", false);
    }
    if ($("#normal_heent").is(":checked")) {
      $("#input_abnormal_heent").prop("disabled", true);
    } else if ($("#abnormal_heent").is(":checked")) {
      $("#input_abnormal_heent").prop("disabled", false);
    }
    if ($("#normal_heart").is(":checked")) {
      $("#input_abnormal_heart").prop("disabled", true);
    } else if ($("#abnormal_heart").is(":checked")) {
      $("#input_abnormal_heart").prop("disabled", false);
    } 
    if ($("#normal_lungs").is(":checked")) {
      $("#input_abnormal_lungs").prop("disabled", true);
    } else if ($("#abnormal_lungs").is(":checked")) {
      $("#input_abnormal_lungs").prop("disabled", false);
    }
    if ($("#normal_abdomen").is(":checked")) {
      $("#input_abnormal_abdomen").prop("disabled", true);
    } else if ($("#abnormal_abdomen").is(":checked")) {
      $("#input_abnormal_abdomen").prop("disabled", false);
    }
    if ($("#normal_extreme").is(":checked")) {
      $("#input_abnormal_extreme").prop("disabled", true);
    } else if ($("#abnormal_extreme").is(":checked")) {
      $("#input_abnormal_extreme").prop("disabled", false);
    }
  });
  //this calculates values automatically 
  bmi(); 
  $("#height, #weight").on("keydown keyup", function() {
    bmi();
    var min_length = 2; // min caracters to display the autocomplete
    var height = $('#height').val();
    var weight = $('#weight').val();
    if ((height.length >= min_length || weight.length >= min_length) && $("#bmi").val().length >= min_length) {
      if ($("#bmi").val() <= 18.5) {
        $("#category").val('Underweight');
      }
      else if (($("#bmi").val() >= 18.5) && ($("#bmi").val() <= 24.9)) {
        $("#category").val('Normal weight');
      }
      else if (($("#bmi").val() >= 25) && ($("#bmi").val() <= 29.9)) {
        $("#category").val('Overweight');
      }
      else if ($("#bmi").val() >= 30) {
        $("#category").val('Obese');
      }
    }
  });
});

function bmi() {
  var height = document.getElementById('height').value;
  var weight = document.getElementById('weight').value;
  var result = (parseFloat(weight) / parseFloat(height) / parseFloat(height)) * 10000;

  if (!isNaN(result)) {
    document.getElementById('bmi').value = result.toFixed(2);
  }
}
