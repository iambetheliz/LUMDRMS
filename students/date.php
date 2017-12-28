<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Add Datepicker to Input Field using jQuery UI by CodexWorld</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="../assets/js/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(function(){
    $("#datepicker1").datepicker();
});
$(function(){
    $("#datepicker2").datepicker({
        dateFormat: "yy-mm-dd"
    });
});
$(function(){
    $("#datepicker3").datepicker({
		dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});
$(function(){
    $("#datepicker4").datepicker({
		dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        minDate: 0,
        maxDate: "+1M +5D"
    });
});

$( function() {
  var from = $( "#fromDate" )
	  .datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
	  })
	  .on( "change", function() {
		to.datepicker( "option", "minDate", getDate( this ) );
	  }),
	to = $( "#toDate" ).datepicker({
	  dateFormat: "yy-mm-dd",
	  changeMonth: true
	})
	.on( "change", function() {
	  from.datepicker( "option", "maxDate", getDate( this ) );
	});

  function getDate( element ) {
	var date;
	var dateFormat = "yy-mm-dd";
	try {
	  date = $.datepicker.parseDate( dateFormat, element.value );
	} catch( error ) {
	  date = null;
	}

	return date;
  }
});
</script>
</head>
<body>
<h2>Basic Datepicker</h2>
<p><input type="text" id="datepicker1"/></p>
    
<h2>Change Date Format</h2>
<p><input type="text" id="datepicker2"/></p>

<h2>Month & Year Select Option</h2>
<p><input type="text" id="datepicker3"/></p>

<h2>Restrict Date Range</h2>
<p><input type="text" id="datepicker4"/></p>

<h2>Date Range (From Date & To Date)</h2>
<p>FROM <input type="text" id="fromDate"> TO <input type="text" id="toDate"></p>
</body>
</html>