$(document).ready(function() {
  var date = new Date();
  var d = date.getDate();
  var m = date.getMonth();
  var y = date.getFullYear();

  var calendar = $('#calendar').fullCalendar({
   editable: true,
   header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,agendaWeek,agendaDay'
   },

   events: "events.php",

   eventRender: function(event, element, view) {
    if (event.allDay === 'true') {
     event.allDay = true;
    } else {
     event.allDay = false;
    }
   },
   navLinks: true, // can click day/week names to navigate views
   selectable: true,
   selectHelper: true,
   select: function(start, end, allDay) {
   var title = prompt('Event Title:');

   if (title) {
   var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
   var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
   $.ajax({
     url: 'add_events.php',
     data: 'title='+ title+'&start='+ start +'&end='+ end,
     type: "POST",
     success: function(json) {
     alert('Added Successfully');
     }
   });
   calendar.fullCalendar('renderEvent',
   {
     title: title,
     start: start,
     end: end,
     allDay: allDay
   },
   true
   );
   }
   calendar.fullCalendar('unselect');
   },

   editable: true,
   eventDrop: function(event, delta) {
   var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
   var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
   $.ajax({
     url: 'update_events.php',
     data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
     type: "POST",
     success: function(json) {
      alert("Updated Successfully");
     }
   });
   },
   eventClick: function(event) {
  var decision = confirm("Do you really want to do that?"); 
  if (decision) {
  $.ajax({
    type: "POST",
    url: "delete_event.php",
    data: "&id=" + event.id,
     success: function(json) {
       $('#calendar').fullCalendar('removeEvents', event.id);
        alert("Deleted Successfully");}
  });
  }
    },
   eventResize: function(event) {
     var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
     $.ajax({
      url: 'update_events.php',
      data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
      type: "POST",
      success: function(json) {
       alert("Updated Successfully");
      }
     });
  }
   
  });
  
 });
