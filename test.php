<?php
session_start();
$email = "";
$password = "";
$response = "";
$chart_url = "";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']); 
    $password = htmlspecialchars($_POST['password']);
} 


$response = curl_exec($ch);
$token = $response;

$response_array = json_decode($response, true);
$_SESSION['token'] = $response_array['token'];
if(isset($response_array['chart_url'])){
    $chart_url = $response_array['chart_url'];
} else {
    echo 'Error: chart_url key not found in response array';
}
$chart_url = "https://cool/login/3?token=" . $response_array['token'];
if ($response_array['status'] === 0) {
    $_SESSION['token'] = $response_array['token'];
    
    //if the authentication was successful, include the HTML file that contains the chart
    require_once("graph_test.html");
    //pass the chart url to the iframe
    echo "<script>document.getElementById('chart-iframe').src = '$chart_url';</script>";
    echo "<script>var token = '$token';</script>";
} else {
    echo '<p>Incorrect email or password</p>';
}
curl_close($ch);
?>
