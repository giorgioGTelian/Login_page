<?php

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

?>
