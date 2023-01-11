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


//get the thingy 
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://cloud.fatturapro.click/junior2023/?graphic=",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Accept: application/json",
    "Content-Type: application/x-www-form-urlencoded",
    "token: YOUR_TOKEN"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

?>
