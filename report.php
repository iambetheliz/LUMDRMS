<?php
  require_once 'includes/dbconnect.php';
  include("includes/charts/fusioncharts.php");

 // Establish a connection to the database
 $DB_con = new mysqli("localhost", "root", "", "records");

 // Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect
 if ($DB_con->connect_error) {
  exit("There was an error with your connection: ".$DB_con->connect_error);
 }

  // Form the SQL query that returns the top 10 most populous countries
  $strQuery = "SELECT sysRev FROM students_med WHERE sysRev LIKE '%Fever%' ORDER BY MedID DESC LIMIT 10";

  // Execute the query, or else return the error message.
  $result = $DB_con->query($strQuery) or exit("Error code ({$DB_con->errno}): {$DB_con->error}");

  // If the query returns a valid response, prepare the JSON string
  if ($result) {
    // The `$arrData` array holds the chart attributes and data
    $arrData = array(
      "chart" => array(
          "caption" => "Top 10 Most Populous Countries",
          "paletteColors" => "#0075c2",
          "bgColor" => "#ffffff",
          "borderAlpha"=> "20",
          "canvasBorderAlpha"=> "0",
          "usePlotGradientColor"=> "0",
          "plotBorderAlpha"=> "10",
          "showXAxisLine"=> "1",
          "xAxisLineColor" => "#999999",
          "showValues" => "0",
          "divlineColor" => "#999999",
          "divLineIsDashed" => "1",
          "showAlternateHGridColor" => "0"
        )
    );

    $arrData["data"] = array();

    // Push the data into the array
    while($row = mysqli_fetch_array($result)) {
      array_push($arrData["data"], array(
          "label" => $row["Name"],
          "value" => $row["Population"]
          )
      );
    }

    /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

    $jsonEncodedData = json_encode($arrData);

    /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

    $columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chart-1", "json", $jsonEncodedData);

    // Render the chart
    $columnChart->render();

    // Close the database connection
    $DB_con->close();
  }

?>