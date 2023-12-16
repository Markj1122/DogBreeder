<?php 
    include "../layouts/master.php";
?>

    <title>View Request - Section</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="../../public/assets/css/view-request.css">
    <link rel="icon" href="../../public/src/images/logo.png">

    <?php 
    include "../layouts/admin-header.php";

    // Your database connection code here, e.g., $conn = mysqli_connect(...);

    $sql = "SELECT * FROM `pending_approval`";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
    ?>

    <div class="page" id="app">

<div class="modal-container">
<!-- Modal for Profile Image -->
<div id="profileModal" class="modal">
  <i class="fas fa-xmark-circle" onclick="closeModal('profileModal')"></i>
  <img src="<?php echo $row['profile_image'] ?>" class="modal-content" id="profileImageModal">
</div>

<!-- Modal for ID Image -->
<div id="idModal" class="modal">
  <i class="fas fa-xmark-circle" onclick="closeModal('idModal')"></i>
  <img src="<?php echo $row['id_image'] ?>" class="modal-content" id="idImageModal">
</div>

<!-- Modal for Receipt Image -->
<div id="receiptModal" class="modal">
  <i class="fas fa-xmark-circle" onclick="closeModal('receiptModal')"></i>
  <img src="<?php echo $row['receipt'] ?>" class="modal-content" id="receiptImageModal">
</div>
</div>


    <div class="border-box-container">
        <div class="mb-3 image-container">
            <img src="<?php echo $row['profile_image']; ?>" alt="Profile Image" class="profile-image">
            <button class="profile-btn" onclick="openModal('profileModal', '<?php echo $row['profile_image']; ?>')">Preview Profile</button>
            <img src="<?php echo $row['id_image']; ?>" class="id-image" alt="Valid ID">
            <button class="id-btn" onclick="openModal('idModal', '<?php echo $row['id_image']; ?>')">Preview ID</button>
            <img src="<?php echo $row['receipt']; ?>" class="receipt-image" alt="Receipt">
            <button class="receipt-btn" onclick="openModal('receiptModal', '<?php echo $row['receipt']; ?>')">Preview Receipt</button>
        </div>
         <hr>
        <div class="name-email">
            <label class="name-label"><b>Fullname:</b></label>
            <span class="name-text"><?php echo $row['fname'] . ' ' . $row['lname']; ?></span>
            <label class="email-label"><b>Email:</b></label>
            <span class="email-text"><?php echo $row['email']; ?></span>
        </div>
        <div class="date-payment">
            <label class="payment-label"><b>Payment:</b></label>
            <span class="payment-text"><?php echo $row['payment']; ?></span>
            <label class="date-label"><b>Date Request:</b></label>
            <span class="date-text"><?php echo $row['date_requested']; ?></span>
        </div>
        <a class="btn-text" href="approval-request.php"><i class="fa-solid fa-arrow-left"> Back</i></a>
    </div>


    </div>

    <?php
    } // End of the while loop
    // Close your database connection here, e.g., mysqli_close($conn);
    ?>

    <?php
    include "../layouts/footer.php";
    ?>

<script>
  function openModal(modalId, imagePath) {
    var modal = document.getElementById(modalId);
    var modalImage = document.getElementById(modalId + "ImageModal");
    modal.style.display = "block";
    modalImage.src = imagePath;
  }

  function closeModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = "none";
  }
</script>