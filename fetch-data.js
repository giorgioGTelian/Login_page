const token = sessionStorage.getItem('token');
// Function to fetch the data and plot the chart
function fetchAndPlotData() {
  $.ajax({
    url: 'https://cloud.fatturapro.click/junior2023',
    dataType: 'json',
    headers: {
      'Authorization': 'Bearer ' + sessionStorage.getItem('token')
    },
    success: function(response) {
      // Check if the request was successful
      if (response.status === 0) {
        // Extract the data from the response
        var data = response.dataset.map(function(d) {
          return {
            x: d.email,
            y: d.data
          };
        });
  
        // Plot the data using Highcharts
        Highcharts.chart('chart-container', {
          chart: {
            type: 'bar'
          },
          title: {
            text: 'Chart Title'
          },
          xAxis: {
            type: 'category'
          },
          yAxis: {
            title: {
              text: 'Y-axis Label'
            }
          },
          series: [{
            name: 'Series Name',
            data: data
          }]
        });
      } else {
        // Show an error message
        alert('Error fetching data');
      }
    }
  });
}

// Schedule the data fetching function to run at regular intervals
setInterval(fetchAndPlotData, 5000);


function fetchData() {
  $.ajax({
    url: 'https://cloud.fatturapro.click/junior2023/',
    dataType: 'json',
    headers: {
      'Authorization': 'Bearer ' + token
    },
    success: function(data) {
      // Use the data to update the page
    }
  });
}


function plotData(data) {
    // Select the container element where the data will be plotted
    var container = d3.select('#container');
  
    // Append a new SVG element to the container
    var svg = container.append('svg');
  
    // Set the dimensions of the SVG element
    svg.attr('width', 500)
       .attr('height', 300);
  
    // Select all circles in the SVG element and bind the data to them
    var circles = svg.selectAll('circle')
                     .data(data);
  
    // Enter the data and append a new circle element for each data point
    circles.enter().append('circle')
      // Set the attributes of the circle elements
      .attr('cx', function(d) { return d.x; })
      .attr('cy', function(d) { return d.y; })
      .attr('r', 5);
  }
  
  
  $(document).ready(function() {
    // Set the interval at which to fetch the data (in milliseconds)
    var interval = 5000;
  
    // Function to fetch the data for the first graph
    function fetchData1() {
      $.ajax({
        url: 'https://cloud.fatturapro.click/junior2023',
        dataType: 'json',
        headers: {
          'Authorization': 'Bearer ' + sessionStorage.getItem('token')
        },
        success: function(data) {
          // Plot the data on the first graph using a JavaScript library like D3.js or Highcharts
          plotData1(data);
        }
      });
    }
  
    // Function to fetch the data for the second graph
    function fetchData2() {
      $.ajax({
        url: 'https://cloud.fatturapro.click/junior2023',
        dataType: 'json',
        headers: {
          'Authorization': 'Bearer ' + sessionStorage.getItem('token')
        },
        success: function(data) {
          // Plot the data on the second graph using a JavaScript library like D3.js or Highcharts
          plotData2(data);
        }
      });
    }
  
    // Schedule the data fetching functions to run at the specified interval
    setInterval(fetchData1, interval);
    setInterval(fetchData2, interval);
  });