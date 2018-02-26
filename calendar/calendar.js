$(document).ready(function() {
	
	var calendar = $('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay,listMonth'
		},
		editable: true,
		navLinks: true,
		eventLimit: true, // allow "more" link when too many events
		selectable: true,
		selectHelper: true,
		select: function(start, end) {	
			$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm a'));
			$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm a'));
    		$('#ModalAdd').modal('show');    		
		},
		eventRender: function(event, element) {
			element.bind('dblclick', function() {
				$('#ModalEdit #id').val(event.id);
				$('#ModalEdit #title').val(event.title);
				$('#ModalEdit #color').val(event.color);
				$('#ModalEdit #startEdit').val(moment(event.start).format('YYYY-MM-DD HH:mm a'));
				$('#ModalEdit #endEdit').val(moment(event.end).format('YYYY-MM-DD HH:mm a'));
				$('#ModalEdit').modal('show');
			});
		},
		eventDrop: function(event, delta, revertFunc) { // by changing position
			edit(event);
		},
		eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // by changing length
			edit(event);
		},
		events: "calendar.php",
	});

	$('#submitButton').on('click', function(e){
	    // We don't want this to act as a link so cancel the link action
	    e.preventDefault();
	    doSubmit();
  	});

  	function doSubmit(event){	
  		var id = $('#ModalAdd #id').val();
  		var title = $('#ModalAdd #title').val();
		var color = $('#ModalAdd #color').val();
		var start = $('#ModalAdd #start').val();
		var end = $('#ModalAdd #end').val();
		$.ajax({
	      url: "calendar/add_events.php",
	      data: 'title='+title+'&start='+start+'&end='+end+'&color='+color,
	      type: "POST",
	      success: function(json) {
	      	$("#calendar").fullCalendar('addEvent', id);

	        $.bootstrapGrowl("New Event added!", // Messages
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
	    	$("#ModalAdd").modal('hide');
	      }
    	});  
	}

	$('#updateButton').on('click', function(e){
	    // We don't want this to act as a link so cancel the link action
	    e.preventDefault();
	    doUpdate();
  	});

  	function doUpdate(event){	
  		console.log(id);
  		var id = $('#ModalEdit #id').val();
  		var title = $('#ModalEdit #title').val();
		var color = $('#ModalEdit #color').val();
		var start = $('#ModalEdit #startEdit').val();
		var end = $('#ModalEdit #endEdit').val();
		$.ajax({
	      url: "calendar/update_events.php",
	      data: 'title='+title+'&start='+start+'&end='+end+'&color='+color+'&id='+id,
	      type: "POST",
	      success: function(json) {
       		$('#calendar').fullCalendar('updateEvent',id);
	        $.bootstrapGrowl("Event updated!", // Messages
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
	    	$("#ModalEdit").modal('hide');
	      }
    	});  
	}
	
	function edit(event){
		start = event.start.format('YYYY-MM-DD HH:mm a');
		if(event.end){
			end = event.end.format('YYYY-MM-DD HH:mm a');
		}else{
			end = start;
		}
		
		id =  event.id;
		
		Event = [];
		Event[0] = id;
		Event[1] = start;
		Event[2] = end;
		
		$.ajax({
		 	url: 'calendar/update_events.php',
		 	type: "POST",
		 	data: {Event:Event},
		 	success: function(rep) {
				if(rep == 'OK'){
					$.bootstrapGrowl("Event updated!", // Messages
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
				else {
					$.bootstrapGrowl("Event cannot be saved!", // Messages
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
			}
		});
	}

	$('#deleteButton').on('click', function(e){
    // We don't want this to act as a link so cancel the link action
    e.preventDefault();
    doDelete(event);
  });

  function doDelete(event){
    var id = $('#ModalEdit #id').val();
    $.ajax({
      url: "calendar/delete_event.php",
      data: "id="+id,
      type: "POST",
      success: function(json) {
        $('#calendar').fullCalendar( 'removeEvent', event.id );  
        $.bootstrapGrowl("Event deleted!", // Messages
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
    	$("#ModalEdit").modal('hide');
      }
    });  
  }
});
$('#start, #startEdit').datetimepicker({
  format: 'YYYY-MM-DD HH:mm a',
  keepOpen: true,
  icons: {
    time: "fa fa-clock-o",
    date: "fa fa-calendar",
    up: "fa fa-arrow-up",
    down: "fa fa-arrow-down"
  }
});
$('#end, #endEdit').datetimepicker({
  format: 'YYYY-MM-DD HH:mm a',
  keepOpen: true,
  icons: {
    time: "fa fa-clock-o",
    date: "fa fa-calendar",
    up: "fa fa-arrow-up",
    down: "fa fa-arrow-down"
  }
});
$("#start").on("dp.change", function (e) {
    $('#end').data("DateTimePicker").minDate(e.date);
});
$("#end").on("dp.change", function (e) {
    $('#start').data("DateTimePicker").maxDate(e.date);
});
$("#startEdit").on("dp.change", function (e) {
    $('#endEdit').data("DateTimePicker").minDate(e.date);
});
$("#endEdit").on("dp.change", function (e) {
    $('#startEdit').data("DateTimePicker").maxDate(e.date);
});