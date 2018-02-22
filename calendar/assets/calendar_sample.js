$(document).ready(function() {
  var date = new Date();
  var d = date.getDate();
  var m = date.getMonth();
  var y = date.getFullYear();

  $('#createEventModal').on('hidden.bs.modal', function () {
    $(this).find('input').val('');
  });

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
          $.bootstrapGrowl("Event moved!", // Messages
            { // options
              type: "info", // info, success, warning and danger
              ele: "body", // parent container
              offset: {
                from: "top",
                amount: 20
              },
              align: "right", // right, left or center
              width: 300,
              delay: 4000,
              allow_dismiss: true, // add a close button to the message
              stackup_spacing: 10
          });
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
          $.bootstrapGrowl("Event updated!", // Messages
            { // options
              type: "info", // info, success, warning and danger
              ele: "body", // parent container
              offset: {
                from: "top",
                amount: 20
              },
              align: "right", // right, left or center
              width: 300,
              delay: 4000,
              allow_dismiss: true, // add a close button to the message
              stackup_spacing: 10
          });
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
    $("#createEventModal").modal('hide').fadeOut('slow');
    var title = $('#title').val();
    var start = $('#startTime').val();
    var end = $('#endTime').val();

    $.ajax({
      url: 'addEvent.php',
      data: {title:title,start:start,end:end},
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
        $('#calendar').fullCalendar( 'refetchEvents' );
        $.bootstrapGrowl("New event added!", // Messages
          { // options
            type: "success", // info, success, warning and danger
            ele: "body", // parent container
            offset: {
              from: "top",
              amount: 20
            },
            align: "right", // right, left or center
            width: 300,
            delay: 4000,
            allow_dismiss: true, // add a close button to the message
            stackup_spacing: 10
        });
      }
    });
  }

  $('#deleteButton').on('click', function(e){
    // We don't want this to act as a link so cancel the link action
    e.preventDefault();
    doDelete();
  });

  function doDelete(){
    $("#calendarModal").modal('hide').fadeOut('slow');
    var eventID = $('#eventID').val();
    $.ajax({
      url: "delete_event.php",
      data: "&id=" + eventID,
      type: "POST",
      success: function(json) {
        $('#calendar').fullCalendar( 'removeEvent', eventID );
        $('#calendar').fullCalendar( 'refetchEvents' );    
        $.bootstrapGrowl("Event deleted!", // Messages
          { // options
            type: "danger", // info, success, warning and danger
            ele: "body", // parent container
            offset: {
              from: "top",
              amount: 20
            },
            align: "right", // right, left or center
            width: 300,
            delay: 4000,
            allow_dismiss: true, // add a close button to the message
            stackup_spacing: 10
        });    
      }
    });
  }
});