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

  $('ul[role="menu"]').on('show.bs.collapse', function (e) {
    $(e.target).prev('a[role="menuitem"]').addClass('active');
  })
  $('ul[role="menu"]').on('hide.bs.collapse', function (e) {
      $(e.target).prev('a[role="menuitem"]').removeClass('active');
  });

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

  $(function() {
  var Accordion = function(el, multiple) {
    this.el = el || {};
    this.multiple = multiple || false;

    // Variables privadas
    var links = this.el.find('a[role=submenuitem]');
    // Evento
    links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
  }

  Accordion.prototype.dropdown = function(e) {
    var $el = e.data.el;
      $this = $(this),
      $next = $this.next();

    $next.slideToggle();
    $this.parent().toggleClass('open');

    if (!e.data.multiple) {
      $el.find('.panel-collapse').not($next).slideUp().parent().removeClass('open');
    };
  } 

  var accordion = new Accordion($('#demo'), false);
});
  
});