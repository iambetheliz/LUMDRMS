$(document).ready(function () {

    $.getJSON("reports.php", function (result) {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: "Student Medical Records - 2017"
            },
            axisX: {
                title: "Diagnostics"
            },
            data: [
                {
                    dataPoints: result
                }
            ]
        });

        chart.render();
    });
});