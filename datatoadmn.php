<?php
  // Start a timer
  $start_time = microtime(true);

  // Get form data from login.html
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Connect to the database and check login credentials
  $conn = mysqli_connect("localhost", "db_user", "db_password", "database_name");
  $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

  // Check if login was successful
  if(mysqli_num_rows($result) > 0) {
    // Stop the timer
    $end_time = microtime(true);

    // Calculate the total time taken to complete the login
    $total_time = $end_time - $start_time;

    // Display the total time taken to the administrator
    echo "Total time taken to complete login: " . $total_time . " seconds";
  } else {
    // Login failed
    echo "Invalid username or password";
  }
?>
