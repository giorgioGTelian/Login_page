<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


ession_start();

$email = "";
$password = "";
$response = "";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']); 
    $password = htmlspecialchars($_POST['password']);
} 
 
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'email' => $email,
        'password' => $password
    ]));


curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_URL, 'https://cloud.fatturapro.click/junior2023/');

$response = curl_exec($ch);
$token = $response;

$response = json_decode($response, true);
if (is_array($response)) {
    $response = json_encode($response);
    echo $response;
} else {
    echo 'Error: $response is not an array';
}

curl_close($ch);
exit($response);
if (session_start()) {
    $_SESSION['token'] = $response_array['token'];
    header('Location: /index.html');
    exit;
} else {
    echo '<p>Error starting the session</p>';
}
       
 
$response_array = json_decode($response, true);
if ($response_array['status'] === 0) {
    $_SESSION['token'] = $response_array['token'];
    header('Location: /index.html');
    exit;
}
    
if ($response !== false) {
    $data = json_decode($response, true);
    if (isset($data['token'])) {
        $_SESSION['token'] = $data['token'];
    } else {
        echo '<p>Incorrect email or password</p>';
    }
} else {
    echo '<p>Error connecting to the server</p>';
}

if (isset($_GET['token'])) {
  $token = htmlspecialchars($_GET['token']);
  // Save the token in a session variable or a database
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, 'https://cloud.fatturapro.click/junior2023/');

$response = curl_exec($ch);

echo "<script>var token = '$token';</script>";

$response_array = json_decode($response, true);

// Check if the response is an array and if the "status" key exists in the array
if (is_array($response_array) && array_key_exists('status', $response_array)) {
  // Save the data from the "dataset" key in a new array
  $data_array = $response_array['dataset'];
}

$data_json = json_encode($data_array);
echo "<script>var data = '$data_json';</script>";

$response_array = [
    'status' => 0,
    'dataset' => [
        ['email' => 'test1@test.it', 'data' => 10],
        ['email' => 'test2@test.it', 'data' => 20]
    ]
];

echo "<script>var data = " . json_encode($response_array) . ";</script>";

$response_array = json_decode($response, true);
$response_json = json_encode($response_array);

echo "<iframe id='chart-iframe' src='fetch-data.php?response=$response_json'></iframe>";

?>
