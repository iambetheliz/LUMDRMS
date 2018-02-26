$(document).ready(function() {
  var date = new Date();
  var d = date.getDate();
  var m = date.getMonth();
  var y = date.getFullYear();

  $('#ModalAdd').on('hidden.bs.modal', function () {
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
    events: [
    <?php foreach($events as $event): 
    
      $start = explode(" ", $event['start']);
      $end = explode(" ", $event['end']);
      if($start[1] == '00:00:00'){
        $start = $start[0];
      }else{
        $start = $event['start'];
      }
      if($end[1] == '00:00:00'){
        $end = $end[0];
      }else{
        $end = $event['end'];
      }
    ?>
      {
        id: '<?php echo $event['id']; ?>',
        title: '<?php echo $event['title']; ?>',
        start: '<?php echo $start; ?>',
        end: '<?php echo $end; ?>',
        color: '<?php echo $event['color']; ?>',
      },
    <?php endforeach; ?>
    ],
    select: function(start, end, allDay, element) {
        endtime = $.fullCalendar.formatDate(end,'ddd, MMM DD, YYYY h(:mm) a');
        starttime = $.fullCalendar.formatDate(start,'ddd, MMM DD, YYYY h(:mm) a');
        var mywhen = starttime + ' - ' + endtime;
        start = moment(start).format();
        end = moment(end).format();
        $('#ModalAdd #startTime').val(start);
        $('#ModalAdd #endTime').val(end);
        $('#ModalAdd #when').text(mywhen);
        $('#ModalAdd').modal('show');
    },
    eventDrop: function(event, delta) {
      $.ajax({
        url: 'editEventTitle.php',
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
      $('#ModalEdit #id').val(event.id);
        $('#ModalEdit #title').val(event.title);
        $('#ModalEdit #color').val(event.color);
        $('#ModalEdit #startEdit').val(moment(event.start).format('YYYY-MM-DD HH:mm a'));
        $('#ModalEdit #endEdit').val(moment(event.end).format('YYYY-MM-DD HH:mm a'));
        $('#ModalEdit').modal('show');
    },
    eventResize: function(event) {
      $.ajax({
        url: 'editEventTitle.php',
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

  function doSubmit(event){
    $("#ModalAdd").modal('hide');
    var title = $('#title').val();
    var start = $('#startTime').val();
    var end = $('#endTime').val();

    $.ajax({
      url: 'addEvent.php',
      data: 'title='+event.title+'&start='+moment(event.start).format()+'&end='+moment(event.end).format()+'&id='+event.id,
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
    $("#ModalEdit").modal('hide');
    var eventID = $('#ModalEdit #id').val();
    $.ajax({
      url: "editEventTitle.php",
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