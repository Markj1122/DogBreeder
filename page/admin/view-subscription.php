<?php 
    include "../layouts/master.php";
?>

<html>
<head>
    <title>View Subcription - Section</title>
    <link rel="stylesheet" href="../../public/assets/css/view-subscription.css">
    <link rel="icon" href="../../public/src/images/logo.png">
</head>
<body>
    <?php 
    include "../layouts/admin-header.php";

    // Your database connection code here, e.g., $conn = mysqli_connect(...);

    $sql = "SELECT * FROM `subscribers`";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
    ?>

    <div class="page" id="app">

    <div class="border-box-container">
        <div class="mb-3 image-container">
            <label class="form-label-1"><i>Profile Image:</i></label>
            <img src="<?php echo $row['profile_image']; ?>" alt="Profile Image" class="image-1">
            <button class="preview-button-1">Preview</button>
            <label class="form-label-2"><i>ID Picture:</i></label>
            <img src="<?php echo $row['id_image']; ?>" class="image-2" alt="Valid ID">
            <button class="preview-button-2">Preview</button>
        </div>
        <hr>
        <div class="mb-3">
            <label class="form-label-3"><i>Full Name:</i></label>
            <span class="text-label-1"><?php echo $row['fname'] . ' ' . $row['lname']; ?></span>
        </div>
        <div class="mb-3">
            <label class="form-label-4"><i>Email Address:</i></label>
            <span class="text-label-2"><?php echo $row['email']; ?></span>
        </div>
        <div class="mb-3">
            <label class="form-label-5"><i>Payment:</i></label>
            <span class="text-label-3"><?php echo $row['payment']; ?></span>
            <label class="form-label-6"><i>Receipt:</i></label>
            <img src="<?php echo $row['receipt']; ?>" class="image-3" alt="Receipt">
            <button class="preview-button-3">Preview</button>
        </div>
        <a class="btn-txt" href="subscriptions.php"><i class="fa-solid fa-arrow-left"> Back</i></a>
    </div>

    </div>

    <?php
    } // End of the while loop
    // Close your database connection here, e.g., mysqli_close($conn);
    ?>

    <?php
    include "../layouts/footer.php";
    ?>
</body>
</html>
