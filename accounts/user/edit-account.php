<?php include "../../page/layouts/master.php"?>
<title>Edit Account - Section</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="../../public/assets/css/accounts.css">
<link rel="icon" href="../../public/src/images/logo.png">
<?php include "../../page/layouts/user-header.php"?>
<div class="page" id="app">
    <?php
     if (isset($_SESSION['user_id'])) {
        $loggedInUserId = $_SESSION['user_id'];

    // Your database connection code here, e.g., $conn = mysqli_connect(...);
    $sql = "SELECT * FROM `user` WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $loggedInUserId);
    $stmt->execute();

    // Move the mysqli_query line here
    $result = $stmt->get_result();

    while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            <h2 class="page-title"></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="row row-cards">
                            <div class="col">

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

                                <form class="card" method="post" action="update-account.php" enctype="multipart/form-data">
                                    <div class="card-header center">
                                        <h3 class="card-title text-green">Manage Account</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col">
                                                   <div class="upload">
                                                      <div class="image-wrapper">
                                                         <img id="preview" src="<?php echo $row['user_profile_image']; ?>" width="100" height="100" alt="Profile Image">
                                                         <div class="round">
                                                           <input type="file" name="profile_image" id="imageUpload" accept="jpg. jpeg. png." onchange="previewImage(this)">
                                                           <label for="imageUpload"><i class="fa fa-camera" style="color:#fff;"></i></label>
                                                        </div>
                                                    </div>
                                                 </div>                                                 
                                                    <div class="mb-3">
                                                        <label class="form-label"><b>Firstname</b></label>
                                                        <input class="form-control" name="fname" id="fname" value="<?php echo $row['user_firstname']; ?>" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"><b>Lastname</b></label>
                                                        <input class="form-control" name="lname" id="lname" value="<?php echo $row['user_lastname']; ?>" readonly>
                                                    </div>

                                                    <div class="mb-3 input-with-icon">
                                                        <label class="form-label"><b>Email Address</b></label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="email" name="new_email" id="new_email" value="<?php echo $row['user_email']; ?>">
                                                            <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>&nbsp;&nbsp;
                                        <a href="home.php" class="btn btn-secondary d-sm-inline-block">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php
    } // End of the while loop
    // Close your database connection here, e.g., mysqli_close($conn);
    $stmt->close();
    }
?>

    <?php include "../../page/layouts/footer.php"?>

<script>
    function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    // Display the selected image in the "preview" element
                    document.getElementById('preview').src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

</div>
</body>
</html>
