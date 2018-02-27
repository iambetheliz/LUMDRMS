//Form Validation
$(function () {
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
});