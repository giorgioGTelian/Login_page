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
