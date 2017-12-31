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
      right: 'month,agendaWeek,agendaDay,listMonth'
    },
    navLinks: true, // can click day/week names to navigate views
    eventLimit: true,
    selectable: true,
    allDaySlot: true,
    events: "events.php",
      select: function(start, end, allDay, element) {
          endtime = $.fullCalendar.formatDate(end,'ddd, MMM DD, YYYY h(:mm) a');
          starttime = $.fullCalendar.formatDate(start,'ddd, MMM DD, YYYY h(:mm) a');
          var mywhen = starttime + ' - ' + endtime;
          start = moment(start).format();
          end = moment(end).format();
          $('#createEventModal #startTime').val(start);
          $('#createEventModal #endTime').val(end);
          $('#createEventModal #when').text(mywhen);
          $('#createEventModal').modal('show');
      },
      eventDrop: function(event, delta) {
        $.ajax({
          url: 'update_events.php',
          data: 'title='+event.title+'&start='+moment(event.start).format()+'&end='+moment(event.end).format()+'&id='+event.id ,
          type: "POST",
          success: function(json) {
           //alert(json);
          }
        });
      },
      eventClick: function(event) {
        endtime = $.fullCalendar.moment(event.end).format('ddd, MMM DD, YYYY h(:mm) a');
        starttime = $.fullCalendar.moment(event.start).format('ddd, MMM DD, YYYY h(:mm) a');
        var mywhen = starttime + ' - ' + endtime;
        $('#modalTitle').html(event.title);
        $('#modalWhen').text(mywhen);
        $('#eventID').val(event.id);
        $('#calendarModal').modal();
      },
      eventResize: function(event) {
        $.ajax({
          url: 'update_events.php',
          data: 'title='+event.title+'&start='+moment(event.start).format()+'&end='+moment(event.end).format()+'&id='+event.id,
          type: "POST",
          success: function(json) {
            //alert(json);
          }
       });
      }
    });

  $('#submitButton').on('click', function(e){
    // We don't want this to act as a link so cancel the link action
    e.preventDefault();

    doSubmit();
  });

  function doSubmit(){
    $("#createEventModal").modal('hide');
    var title = $('#title').val();
    var start = $('#startTime').val();
    var end = $('#endTime').val();

    $.ajax({
      url: 'add_events.php',
      data: 'title='+ title+'&start='+ start +'&end='+ end,
      type: "POST",
      success: function(json) {
        $("#calendar").fullCalendar('renderEvent',
        {
          id: json.id,
          title: title,
          start: startTime,
          end: endTime,
        },
        true);
      }
    });
  }

  $('#deleteButton').on('click', function(e){
    // We don't want this to act as a link so cancel the link action
    e.preventDefault();
    doDelete();
  });

  function doDelete(){
    $("#calendarModal").modal('hide');
    var eventID = $('#eventID').val();
    $.ajax({
      url: "delete_event.php",
      data: "&id=" + eventID,
      type: "POST",
      success: function(json) {
        if(json == 1)
          $("#calendar").fullCalendar('removeEvents',eventID);
        else
          return false;
      }
    });
  }
});