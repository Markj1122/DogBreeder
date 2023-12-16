<?php include "../../page/layouts/master.php"?>

<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="../../public/assets/css/index.css">
<link rel="icon" href="../../public/src/images/logo.png">
</head>
<body>
<span id="countdown" class="count-down" style="display: none;"></span>
 <div class="loginBox">
  <img class="user" src="../../public/src/images/logo.png">
  <h2>Sign In </h2>
  <?php 
if(isset($_SESSION['success'])) 
{
?>
    <div class="success" role="alert">
        <?php echo $_SESSION['success']; ?>
    </div>  
<?php
    unset($_SESSION['success']);
}

if(isset($_SESSION['error'])) 
{
?>
    <div class="error" role="alert">
        <?php echo $_SESSION['error']; ?>
    </div>  
<?php
    unset($_SESSION['error']);
}
?>

  <form action="login.php" method="post">
  <div class="input-group">
    <i class="fas fa-envelope"></i>
    <input type="text" name="username_or_email" placeholder="Email">
  </div>
  <div class="input-group">
    <i class="fas fa-lock"></i>
    <input type="password" id="passwordField" name="password" placeholder="Password">
  </div>
  <div class="eye-toggle">
  <i class="fas fa-eye" id="showPassword"></i>
  <i class="fas fa-eye-slash" id="hidePassword" style="display: none;"></i>
</div>
  <div class="remember-forgot">
    <label>
        <input type="checkbox">
        <span>Remember me</span>
    </label>
    <a href="#" id="forgotPasswordLink">Forgot password?</a>
</div>
  <input type="submit" name="sign-in" id="signinButton" onclick="attemptLogin()" value="Sign In">

<div class="register-link">
  <p>Don't have an account? <a href="user-create.php">Register</a>
</p>
</div>
</form>

<!-- Modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3 class="modal-title">Reset Password</h3>
    <p>Enter admin account's verified email address, and we will send you a reset password.</p>
    <form action="send-email.php" method="post">
      <label for="user_email">Email Address:</label>
      <input type="email" name="email" id="email" required><br> <!-- Fixed typo: placeho to id -->
      <button type="submit" name="send">Submit</button>
    </form>
  </div>
</div>

<script>
// Get the eye icons and password field by their IDs
const showPasswordIcon = document.getElementById('showPassword');
const hidePasswordIcon = document.getElementById('hidePassword');
const passwordField = document.getElementById('passwordField');

// Add an input event listener to the password field
passwordField.addEventListener('input', () => {
  // Toggle the visibility of the eye toggle based on input presence
  if (passwordField.value.trim() === '') {
    showPasswordIcon.style.display = 'none';
    hidePasswordIcon.style.display = 'none';
  } else {
    showPasswordIcon.style.display = 'inline-block';
    hidePasswordIcon.style.display = 'none';
  }
});

// Add a click event listener to the show password icon
showPasswordIcon.addEventListener('click', () => {
  // Toggle the visibility of the password field
  passwordField.type = 'text';
  // Toggle the display of the show/hide icons
  showPasswordIcon.style.display = 'none';
  hidePasswordIcon.style.display = 'inline-block';
});

// Add a click event listener to the hide password icon
hidePasswordIcon.addEventListener('click', () => {
  // Toggle the visibility of the password field
  passwordField.type = 'password';
  // Toggle the display of the show/hide icons
  showPasswordIcon.style.display = 'inline-block';
  hidePasswordIcon.style.display = 'none';
});

// Function to start the countdown timer and disable the Sign In button
function startCountdown(seconds) {
  var countdownElement = document.getElementById("countdown");
  var signInButton = document.getElementById("signinButton");

  countdownElement.style.display = "inline";
  signInButton.disabled = true; // Disable the Sign In button

  var timer = seconds;
  var countdownInterval = setInterval(function () {
    countdownElement.innerHTML =
      "Too many attempts, please try again in " + timer + " seconds";
    timer--;

    if (timer < 0) {
      clearInterval(countdownInterval);
      countdownElement.style.display = "none";
      // Re-enable the Sign In button when the countdown is finished
      signInButton.disabled = false;
    }
  }, 1000);
}

// Function to handle login attempts
function attemptLogin() {
  // You can add your login logic here
  // Check if the countdown timer is active
  var countdownElement = document.getElementById("countdown");
  if (countdownElement.style.display !== "none") {
    // Prevent login attempts while the countdown is active
    alert("Too many login attempts. Please wait for the countdown to finish.");
    return;
  }
    
}

// PHP code to conditionally start the countdown timer
<?php
  if ($_SESSION['login_attempts'] >= 3 && (time() - $_SESSION['last_login_attempt']) < 120) {
    echo "startCountdown(" . (120 - (time() - $_SESSION['last_login_attempt'])) . ");";
  }
?>

 // JavaScript code for displaying and hiding the modal
 document.addEventListener("DOMContentLoaded", function() {
  var modal = document.getElementById("myModal");
  var link = document.getElementById("forgotPasswordLink");
  var closeBtn = document.getElementsByClassName("close")[0];

  link.onclick = function() {
    modal.style.display = "block";
  }

  closeBtn.onclick = function() {
    modal.style.display = "none";
  }

  // Close the modal if the user clicks outside of it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
});
</script>
  
</body>
</html>
