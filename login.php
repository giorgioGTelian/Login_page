
<?php

session_start();

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
echo "<script>var token = '$token';</script>";
$response_array = json_decode($response, true);

//$_SESSION['token'] = $response_array['token'];
$chart_url = $response_array['token'];

echo "<script>document.getElementById('chart-iframe').src = '$chart_url';</script>";


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

?>