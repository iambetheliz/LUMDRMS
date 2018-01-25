$(document).ready(function () {

    $.getJSON("report_diseases.php", function (result) {

        var chart = new CanvasJS.Chart("chartContainer", {
            zoomEnabled:true,
            panEnabled:true,
            animationEnabled: true,
            exportEnabled: true,
            title: {
                text: "Laguna University Health Cases"
            },
            axisX: {
                title: "Diseases"
            },
            axisY:{                
                title: "No. of Patients",
                minimum: 0,
                maximum: 50
            },
            legend: {
                cursor: "pointer",
                itemmouseover: function(e) {
                    e.dataSeries.lineThickness = e.chart.data[e.dataSeriesIndex].lineThickness * 2;
                    e.dataSeries.markerSize = e.chart.data[e.dataSeriesIndex].markerSize + 2;
                    e.chart.render();
                },
                itemmouseout: function(e) {
                    e.dataSeries.lineThickness = e.chart.data[e.dataSeriesIndex].lineThickness / 2;
                    e.dataSeries.markerSize = e.chart.data[e.dataSeriesIndex].markerSize - 2;
                    e.chart.render();
                },
                itemclick: function (e) {
                    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                        e.dataSeries.visible = false;
                    } else {
                        e.dataSeries.visible = true;
                    }
                    e.chart.render();
                }
            },
            toolTip: {
                shared: true
            },
            data: [{
                type: "line",
                name: "Health Cases",
                connectNullData: true,
                nullDataLineDashType: "solid",
                yValueFormatString: "### Patients",
                dataPoints: result
            }]
        });

        chart.render();
    });
});