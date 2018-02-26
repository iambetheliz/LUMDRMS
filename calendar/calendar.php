<!-- Calendar -->
<script>
$(document).ready(function() {
	$.ajaxSetup({
		cache: false,
	});
	$('#ModalAdd').submit(function() {
		return false;
		$.ajaxSetup ({
	      cache: false
	  	});
	    $("#addEvent")[0].reset();
	    $("#ModalAdd #title").focus();
	    $('#submitButton').html("Add Event");  
	    $('#ModalAdd').modal('hide'); 
	});
	
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
			$("#ModalAdd #title").focus();
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
		]
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
		var category = $("#ModalAdd #public").is(':checked');
		if (category) {
		  $.ajax({
	      url: "add_events.php",
	      data: 'category=public&title='+title+'&start='+start+'&end='+end+'&color='+color,
	      type: "POST",
	      beforeSend:function() {  
            $("#submitButton").html("<span class='fa fa-floppy-o'></span> &nbsp; Saving Event");  
	      },
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
  			$("#addEvent")[0].reset();
	    	$("#ModalAdd").modal('hide');
	      }
    	});
		}
		else {
		  $.ajax({
	      url: "add_events.php",
	      data: 'title='+title+'&start='+start+'&end='+end+'&color='+color,
	      type: "POST",
	      beforeSend:function() { 
            $("#submitButton").html("<span class='fa fa-floppy-o'></span> &nbsp; Saving Event");  
          },
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
  			$("#addEvent")[0].reset();
	    	$("#ModalAdd").fadeOut(3000);
	    	$("#ModalAdd").modal('hide');
	      }
    	});
		}  
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
		var category = $("#ModalEdit #publicEdit").is(':checked');
		if (category) {
			$.ajax({
		      url: "update_events.php",
		      data: 'category=public&title='+title+'&start='+start+'&end='+end+'&color='+color+'&id='+id,
		      type: "POST",
		      beforeSend:function() {  
	          	$('#updateButton').val("Updating Event");  
	          },
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
		else {
	    	$.ajax({
		      url: "update_events.php",
		      data: 'title='+title+'&start='+start+'&end='+end+'&color='+color+'&id='+id,
		      type: "POST",
		      beforeSend:function() {  
	          	$('#updateButton').val("Updating Event");  
	          },
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
		 	url: 'update_events.php',
		 	type: "POST",
		 	data: {Event:Event},
		 	success: function(rep) {
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
	          	}
	          );
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
      url: "delete_event.php",
      data: "id="+id,
      type: "POST",
      cache: false,
      beforeSend:function(event) {  
        $('#deleteButton').val("Deleting Event"); 
      },
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
</script>