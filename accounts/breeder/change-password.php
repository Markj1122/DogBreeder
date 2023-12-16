<?php include "../../page/layouts/master.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings - Section</title>
  <link rel="icon" href="../../public/src/images/logo.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .border-box {
       border: 1px solid #ccc;
       padding: 20px;
       border-radius: 5px;
       margin-top: 70px;
    }
    h2 {
      text-align: center;
    }

  </style>
</head>
<body>
<?php include "../../page/layouts/breeder-header.php"?>
<div class="page" id="app">
 <div class="container">
  <div class="row justify-content-center">
     <div class="col-lg-6">

<?php 
  if(isset($_SESSION['success']) || isset($_SESSION['error'])) {
    $alertClass = isset($_SESSION['success']) ? 'alert-success' : 'alert-danger';
    $iconClass = isset($_SESSION['success']) ? 'fas fa-check-circle' : 'fas fa-times-circle';
    $message = isset($_SESSION['success']) ? $_SESSION['success'] : $_SESSION['error'];
    $color = isset($_SESSION['success']) ? 'green' : 'red';
    unset($_SESSION['success']);
    unset($_SESSION['error']);
?>
    <div class="alert <?php echo $alertClass; ?> alert-dismissible fade show" role="alert">
        <i class='<?php echo $iconClass; ?>' style='font-size:14px; color: <?php echo $color; ?>'></i>
        <?php echo $message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>

       <div class="border-box">
       <form action="password-process.php" method="post" enctype="multipart/form-data">
        <h2 style="color: orange;">Change Password</h2>
        <div class="form-group">
            <label for="op"><b>Old Password</b> :</label>
            <input type="password" class="form-control" name="op" id="op" placeholder="Input Old Password">
        </div>
        <div class="form-group">
            <label for="np"><b>New Password</b> :</label>
            <input type="password" class="form-control" name="np" id="np" placeholder="Input New Password">
        </div>
        <div class="form-group">
            <label for="c_np"><b>Confirm New Password</b> :</label>
            <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                   placeholder="Confirm New Password">
        </div>
        <center><button type="submit" class="btn btn-primary">Change</button>&nbsp;
        <a href="customers.php" class="btn btn-secondary">Cancel</a></center>
    </form>
       </div>
     </div>
   </div>
 </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
