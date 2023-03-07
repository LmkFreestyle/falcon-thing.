// Replace the webhook URL with your own Discord webhook URL
var discordWebhookURL = "https://discord.com/api/webhooks/1082795870057152602/rxODNle0UhU31oGepMNCDW4CVeG-QtaTLDVu3u0M_aFGToF8jibgiWOiCaYvqhMecviP";

// Generate a new password every two hours
setInterval(function() {
  var password = generatePassword();
  // Display the new password
  document.getElementById("password").value = password;
  // Send the password to the Discord webhook
  sendWebhook(password);
}, 7200000);

function generatePassword() {
  // Generate a random string of characters for the password
  var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
  var password = "";
  for (var i = 0; i < 8; i++) {
    password += chars.charAt(Math.floor(Math.random() * chars.length));
  }
  return password;
}

function sendWebhook(password) {
  // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();
  // Set the webhook URL and request method
  xhr.open("POST", discordWebhookURL);
  // Set the request header
  xhr.setRequestHeader("Content-type", "application/json");
  // Create the JSON payload
  var payload = {
    "content": "New password generated: " + password
  };
  // Send the payload to the Discord webhook
  xhr.send(JSON.stringify(payload));
}

// Validate the login form
document.querySelector("form").addEventListener("submit", function(event) {
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  if (username === "" || password === "") {
    event.preventDefault();
    alert("Please enter a username and password.");
  }
});
