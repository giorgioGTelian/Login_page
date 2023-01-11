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

<?php
// Get the token from the headers
$headers = getallheaders();
$token = $headers["token"];

if ($token == "YOUR_TOKEN") {
  // Get the data
  $data1 = getData1();
  $data2 = getData2();

  // Return the data as a JSON object
  header('Content-Type: application/json');
  echo json_encode(array("data1" => $data1, "data2" => $data2));
} else {
  http_response_code(401);  // unauthorized
  echo "Invalid token";
} 

//Get data1 and data2 here
function getData1() {
  
  //cURL logic
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

  // return the response
  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return json_decode($response);
  }

}

}

function getData2() {
  
  //cURL logic
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

  // return the response
  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return json_decode($response);
  }

}
}


?>
