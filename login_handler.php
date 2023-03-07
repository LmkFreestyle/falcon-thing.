<?php
// Check if the user has entered the correct password
if ($_POST['password'] == 'your_password_here') {
  // Log the IP address of the user
  $ip = $_SERVER['REMOTE_ADDR'];
  $file = fopen('log.txt', 'a');
  fwrite($file, $ip . "\n");
  fclose($file);
  // Redirect the user to the private page
  header('Location: private_page.php');
} else {
  // Redirect the user to the login page with an error message
  header('Location: login.php?error=1');
}
?>
