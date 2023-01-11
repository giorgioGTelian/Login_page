// Get the iframe element
    var chartIframe = document.getElementById("chart-iframe");

    // Set the src attribute of the iframe to the chart URL
    chartIframe.src = "https://cool/login/?token=<?php echo urlencode($_SESSION['token']); ?>&graph=1";
    // Get the token from PHP
    var token = '<?php echo $token; ?>';
    document.getElementById('chart-iframe').src = '$chart_url';
        // Set the URL of the API endpoint
        var apiUrl = "https://cool/login/?token=" + token + "&graph=1";

        // Initialize the chart
        var chart = new Highcharts.Chart({
            chart: {
                renderTo: 'chart-container',
                type: 'bar'
            },
            title: {
                text: 'Chart Title'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Y-axis Label'
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Series Name',
                data: []  // Data will be populated here
            }]
        });
// Create an XMLHttpRequest object
var xhr = new XMLHttpRequest();

// Open the request and set the headers
xhr.open("GET", chartUrl);
xhr.setRequestHeader("Authorization", "Bearer " + token);

// Function to handle the response
xhr.onload = function() {
    if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        // Use the response data to update the chart
        chart.series[0].setData(response.data);
    } else {
        console.log("Error: " + xhr.status);
    }
};

// Send the request
xhr.send();
