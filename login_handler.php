<?php
// Define the webhook URL
$webhook_url = 'https://discord.com/api/webhooks/1082795870057152602/rxODNle0UhU31oGepMNCDW4CVeG-QtaTLDVu3u0M_aFGToF8jibgiWOiCaYvqhMecviP';

// Set the correct password
$correct_password = 'FalconTest123';

// Check if the user has entered the correct password
if ($_POST['password'] == $correct_password) {
  // Log the IP address of the user
  $ip = $_SERVER['REMOTE_ADDR'];
  $file = fopen('log.txt', 'a');
  fwrite($file, $ip . "\n");
  fclose($file);

  // Generate a new password and send it to the webhook
  $new_password = bin2hex(random_bytes(4));
  $data = array('content' => 'New password: ' . $new_password);
  $options = array(
    'http' => array(
      'header'  => "Content-type: application/json\r\n",
      'method'  => 'POST',
      'content' => json_encode($data)
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($webhook_url, false, $context);

  // Redirect the user to the private page
  header('Location: private_page.php');
} else {
  // Redirect the user back to the login page with an error message
  header('Location: login.php?error=1');
}
?>
