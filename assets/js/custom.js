$(document).ready(function () {

  $(function(){
    $('#current_year').change(function(){ // when one changes
      $('#next_year').val( $(this).val() ) // they all change
    })
  });

  /*Menu-toggle*/
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });

  // Menu Collapse
  $("[data-toggle=tooltip]").tooltip();
  
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