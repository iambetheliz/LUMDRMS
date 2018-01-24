$(document).on('click', '#send', function(){
	$.ajax({
		type: "POST",
		url: "send_sms.php",
        cache: false,
		data: $('#sms').serialize(),  
        beforeSend:function() {  
          	$('#send').val("Sending");  
        },  
		success: function(response){
		  $("#sms")[0].reset();
		  $('#send').val("Send Message"); 
		  if(response=="ok"){
            $.bootstrapGrowl("<span class='fa fa-check'></span> Message sent!", // Messages
              { // options
                type: "success", // info, success, warning and danger
                ele: "body", // parent container
                offset: {
                  from: "top",
                  amount: 20
                },
                align: "right", // right, left or center
                width: 300,
                allow_dismiss: true, // add a close button to the message
                stackup_spacing: 10
              }
            );
          }
          else {
              $.bootstrapGrowl("<i class='fa fa-info'></i> "+response, { // Messages
                // options
                type: "danger", // info, success, warning and danger
                ele: "body", // parent container
                offset: {
                  from: "top",
                  amount: 20
                },
                align: "right", // right, left or center
                width: 300,
                allow_dismiss: true, // add a close button to the message
                stackup_spacing: 10
              });
          }
		}
	});
});