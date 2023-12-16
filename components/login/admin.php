<?php include "../../page/layouts/master.php"?>

<!DOCTYPE html>
<html>
<head>
<title>Registration Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../public/assets/css/admin.css">
<link rel="icon" href="../../public/src/images/logo.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
 <div class="loginBox">
  <img class="user" src="../../public/src/images/logo.png">
  <h2>Create Admin Account</h2>
  <div id="messageContainer" style="display: none;">
    <p class="switch-text">You choose <span id="selectedUserType"></span> account</p>
  </div>
  <form action="admin-process.php" method="post" enctype="multipart/form-data">
    <div class="input-container">
           <input type="text" name="fname" id="fname" placeholder="Firstname" required>
           <input type="text" name="lname" id="lname" placeholder="Lastname" required>
        </div>
    <input type="email" name="email" id="email" placeholder="Email Address" required>
    <input type="password" name="password" id="password" placeholder="Password" required>
    <select id="userTypeSelect" name="user_type">
        <option value="admin">Admin</option>
        <option value="user">User</option>
        <option value="breeder">Breeder</option>
    </select><br>
 <div class="file-container">
        <label for="profile_image"><i class="fa-solid fa-circle-user"></i> Choose</label>
        <input type="file" id="profile_image" class="file-image" name="profile_image" accept=".jpg, .jpeg, .png">  
    </div>
    <input type="submit" name="sign-up" value="Sign Up">  
    <span>
    <a href="index.php">Already have an account</a>
    </span>
  </form>
</div>

<?php if (isset($_GET['success'])) { ?>
      <p class="success"><?php echo $_GET['success']; ?></p>
  <?php } ?>

<script src="../../public/assets/js/switch-text.js"></script>

</body>
</html>
