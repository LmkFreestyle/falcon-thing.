<?php
// Set the correct password
$correct_password = 'FalconTest123';

// Get the user's IP address
$ip = $_SERVER['REMOTE_ADDR'];

// Check if the user has entered the correct password
if ($_POST['password'] == $correct_password) {
  // Log the successful login attempt
  $log_message = $ip . ' - SUCCESS';
  
  // Redirect the user to the private page
  header('Location: private_page.php');
} else {
  // Log the failed login attempt
  $log_message = $ip . ' - FAILURE';
  
  // Redirect the user back to the login page with an error message
  header('Location: login.php?error=1');
}

// Write the log message to a file
$file = fopen('log.txt', 'a');
fwrite($file, $log_message . "\n");
fclose($file);
?>
