$(document).ready(function () {

    $.getJSON("reports.php", function (result) {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
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