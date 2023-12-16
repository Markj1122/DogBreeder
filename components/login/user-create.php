<?php include "../../page/layouts/master.php"?>

<!DOCTYPE html>
<html>
<head>
<title>Registration Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../public/assets/css/user.css">
<link rel="icon" href="../../public/src/images/logo.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
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
?>
 <div class="loginBox">
  <img class="user" src="../../public/src/images/logo.png">
  <h2>Create User Account</h2>
  <form action="user-process.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()"> 
        <div class="input-container">
           <input type="text" class ="input-name-fields" name="fname" id="fname" placeholder="Firstname">
           <input type="text" class ="input-name-fields" name="lname" id="lname" placeholder="Lastname">
        </div>
        <input type="email" name="email" id="email" placeholder="Email Address">
        <input type="password" name="password" id="password" placeholder="Password">
        <select name="user_type" id="user_type">
          <option value="User">Select Role Type</option>
          <option value="Customer">Customer</option>
          <option value="Breeder">Breeder</option>
        </select>
        <br/>
        <input type="text" name="contact" id="contact" placeholder="Contact Number"><br>
        <input type="text" name="address" id="address" placeholder="Address"><br>
       

        <label for="fileUpload" class="file-label-image"><i class="fas fa-user-circle"></i> Profile</label>
  <input type="file" class="file-image" name="profile_image" id="fileImageProfile" accept=".jpg, .jpeg, .png" />
      <input type="submit" name="sign-up" value="Sign Up">
    <span>
            <a href="index.php">Already have an account</a>
        </span>
    </form>
</div>

<?php 
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
<script src="../../public/assets/js/switch-text.js"></script>

</body>
</html>
