$(document).ready(function () {

    $.getJSON("reports.php", function (result) {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: "Medical Diagnosis for year 2017"
            },
            axisX: {
                title: "Diseases"
            },
            axisY:{
                includeZero: false,
                minimum: 0,
                maximum: 5
            },
            data: [{
                type: "line",
                dataPoints: result
            }]
        });

        chart.render();
    });
});