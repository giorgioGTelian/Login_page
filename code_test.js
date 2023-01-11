var token = '$token';

const token = sessionStorage.getItem('token');

// Get the iframe element
var iframe = document.getElementById('chart-iframe');

// Set the src attribute of the iframe to include the token as a query parameter
iframe.src = 'your-url-here?token=' + encodeURIComponent(token);

var data = '$data_json';

const queryParams = new URLSearchParams(window.location.search);
const responseJson = queryParams.get('response');
const response = JSON.parse(responseJson);

<html>
  <head>
  
   
    <script>
      var data = <?php echo json_encode(getData1()); ?>;
      // Create the two Chart.js charts
      var ctx1 = document.getElementById('chart1').getContext('2d');
      var chart1 = new Chart(ctx1, {
        type: 'bar',
        data: {},
        options: {}
      });

      var ctx2 = document.getElementById('chart2').getContext('2d');
      var chart2 = new Chart(ctx2, {
        type: 'line',
        data: {},
        options: {}
      });

      // Fetch data and update the charts at regular intervals
      var intervalId;
      function fetchDataAndUpdateCharts() {
        // Fetch data from your server
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "https://cloud.fatturapro.click/junior2023/", true);
        xhr.setRequestHeader("token", "YOUR_TOKEN");
        xhr.responseType = "json";
        xhr.onload = function () {
          if (xhr.status === 200) {
            var data1 = xhr.response.data1;
            var data2 = xhr.response.data2;
  
            // Update the first chart with the new data
            chart1.data = data1;
            chart1.update();

            // Update the second chart with the new data
            chart2.data = data2;
            chart2.update();
          } else {
            console.error("Failed to fetch data");
          }
        };
        xhr.send();
      }

      // Start fetching data and updating the charts
      intervalId = setInterval(fetchDataAndUpdateCharts, 5000);  // interval 5000 ms = 5 sec

      // Stop fetching data and updating the charts when the page is closed
      window.onbeforeunload = function () {
        clearInterval(intervalId);
      }
    </script>
  </head>
  <body>
    <canvas id="chart1"></canvas>
    <canvas id="chart2"></canvas>
  </body>
</html>

