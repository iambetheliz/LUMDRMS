$(document).ready(function () {
  $(function(){
    $('#current_year').change(function(){ // when one changes
      $('#next_year').val( $(this).val() ) // they all change
    })
  });

  /*Sidebar Menu-toggle*/
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });

  $('ul[role="menu"]') 
    .on('show.bs.collapse', function (e) {
      $(e.target).prev('a[role="menuitem"]').addClass('active');
    })
    .on('hide.bs.collapse', function (e) {
      $(e.target).prev('a[role="menuitem"]').removeClass('active');
  });

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
  
});