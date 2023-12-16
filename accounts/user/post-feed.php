<?php include "../../page/layouts/master.php"?>
<title>Post Feed - Section</title>
<link href="../../public/assets/css/purchase.css" rel="stylesheet">
<link href="../../public/assets/css/headers.css" rel="stylesheet">
<link href="../../public/assets/css/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="icon" href="../../public/src/images/logo.png">
<?php include "../../page/layouts/user-header.php"?>

<h2 style="text-align:center; position:relative; top:0;">Marketplace for Dog Breeds</h2>

<div class="header-line">
    <hr>
</div>


<div class="container">  
<?php 
if(isset($_SESSION['success'])) {
    $alert_class = 'alert-success';
    $icon_class = 'fas fa-check-circle';
    $message = $_SESSION['success'];
    unset($_SESSION['success']);
} elseif(isset($_SESSION['status'])) {
    $alert_class = 'alert-danger';
    $icon_class = 'fas fa-trash';
    $message = $_SESSION['status'];
    unset($_SESSION['status']);
}
?>

<?php if(isset($alert_class)): ?>
<div class="alert <?php echo $alert_class; ?> alert-dismissible fade show" role="alert">
    <i class="<?php echo $icon_class; ?>" style="font-size:14px; color:<?php echo ($alert_class === 'alert-success') ? 'green' : 'red'; ?>"></i>
    <?php echo $message; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-12">
        <?php
        $sql = "SELECT * FROM `post_feed` INNER JOIN user ON user_id = post_feed_breeder_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0) {
            echo "<p style='font-size: 1.3rem; text-align: center; position: relative; top: 100px;'>Post feed will appear here</p>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="card post-card mb-4 border border-3"> 
                <div class="card-header post-header">
            <div class="media">
              <img src="<?php echo $row['user_profile_image']; ?>" alt="Profile Image" class="profile-image rounded-circle w-6 h-6">
              <div class="ml-3">
                <h5 class="breeder-name card-title mr-2"><?php echo $row['user_firstname']; ?></h5>
                <!-- <p class="posted-date d-flex card-subtitle mb-2 text-muted"><strong>Posted&nbsp;•&nbsp;</strong><?php echo date("F j, Y - g:i A", strtotime($row['date_posted'])); ?></p> -->
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <?php
                  $content = $row['post_feed_content'];
                  $words = explode(" ", $content);

                  $wordCount = count($words);
                  $wordLimit = 20; // Define your word limit per line

                  for ($i = 0; $i < $wordCount; $i++) {
                    echo "<span class='text-break'>" . $words[$i] . "</span> ";

                    // Check if we've reached the word limit, and if there are more words remaining
                    if (($i + 1) % $wordLimit === 0 && $i < $wordCount - 1) {
                      echo "<br>"; // Start a new line
                    }
                  }
                  ?>
                </div>
                <div class="col-md-12">
    <hr> 
    <div class="post-images text-center">
        <?php
        $petImage = explode(',', $row['post_feed_pet_image']);
        foreach ($petImage as $image) {
        ?>
        <img src="<?php echo $image; ?>" alt="Pet Image" class="img-fluid" style="object-fit: cover; height: 55vh; width: 700px;">
        <?php
        }
        ?>
    </div>
</div>
              </div>
            </div>
            <div class="post-details" style="display: flex; justify-content: center; align-items: center; font-size: 1rem; gap: 10px;">
    <span class="mx-2"><p class="breed"><strong>Breed Type:</strong> <?php echo $row['post_feed_breed_type']; ?></p></span>
    <span class="mx-2"><p class="price"><strong>Price:</strong> ₱<?php echo number_format($row['post_feed_price'], 0, '.', ','); ?></p></span>
</div>
</div>
<div class="card-footer post-actions" style="display: flex; justify-content: space-between;">
    <a href="#" class="link-primary" style="text-decoration: none" id="seeeMore" data-bs-toggle="modal" data-bs-target="#seeMoreModal<?php echo $row['post_feed_id']; ?>"><i class="fa-solid fa-magnifying-glass"></i> See More</a>
    <a href="#" class="link-primary" style="text-decoration: none" data-bs-toggle="modal" data-bs-target="#purchaseModal<?php echo $row['post_feed_id']; ?>"><i class="fas fa-shopping-cart"></i> Buy Me</a>
</div>
</div>


<!-- Purchase Modal -->
<div class="modal fade" id="purchaseModal<?php echo $row['post_feed_id']; ?>" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
<?php
        if (isset($_SESSION['user_id'])) {
          $loggedInUSerId = $_SESSION['user_id'];

          include('../../page/router/config.php');

          // Modify the SQL query to fetch data for the logged-in breeder
          $sql = "SELECT * FROM `user` WHERE user_id = ?";

          $stmt = $conn->prepare($sql);
          $stmt->bind_param("i", $loggedInUserId);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($loggedInUserData = $result->fetch_assoc()) {
            $user_id = $loggedInUserData['user_id'];

          }

          $stmt->close();
        }
        ?>

      <div class="modal-header">
        <h5 class="modal-title" id="purchasemodalLabel" style="color: blue;">Customer Purchase Form</h5>
      </div>
      <form action="purchase-process.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="breeder_id" value="<?php echo $row['user_id']; ?>">
          <input type="hidden" name="post_feed_id" value="<?php echo $row['post_feed_id']; ?>">
          <input type="hidden" name="customer_id" value="<?php echo $_SESSION['user_id']; ?>">
          <input type="hidden" name="breed_type" value="<?php echo $row['post_feed_breed_type']; ?>">
          <input type="hidden" name="price" value="<?php echo $row['post_feed_price']; ?>">
          <input type="hidden" name="status" value="Pending">
          <input type="hidden" name="purchase_id" value="<?php echo $row['user_id']; ?>">
        </div>

        <div class="name-container">
          <input type="text" name="fname" placeholder="First Name" value=<?php echo $_SESSION['user_firstname'];?>>
          <!-- <input type="text" name="lname" placeholder="Last Name"  value=<?php echo $_SESSION['user_lastname'];?>> -->
        </div>

        <div class="address">
          <textarea name="address" rows="3" cols="42" placeholder="For delivery, please input the exact address including the landmark..."></textarea>
        </div>
        <div class="contact">
          <input type="number" name="contact" class="contact" placeholder="Contact Number" required>
        </div>
        <div class="group-select">
          <select id="delivery" name="delivery" required>
            <option value="">Purchase Type</option>
            <option value="Pick-up">Pick-up</option>
            <option value="Delivery">Delivery</option>
          </select>
          <select id="payment" name="payment">
            <option value="">Mode of Payment</option>
            <option value="Cash">Cash</option>
            <option value="Installment">Installment</option>
          </select>
        </div>
        <div class="buttons">
          <button type="submit" class="submit-btn" name="submit">Submit</button>
          <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="seeMoreModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="seeMoreModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-cards">
                  <div class="modal-header">
                    <h5 class="modal-title" id="updateodalLabel" style="color:green;">Pet Information
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                   <div class="vaccine-image">
                    <img src="<?php echo $row["vaccine_image"] ?>" alt="Pet Vaccine">
                   </div>
                   <div class="dob">
                       <label>Birthdate:</label>
                       <p><?php echo date('F j, Y', strtotime($row["birthdate"])) ?></p>
                    </div>
                    <div class="sire-image">
                        <label>Sire (Male)</label>
                        <img src="<?php echo $row["sire_image"] ?>" alt="Sire Image">
                    </div>
                    <div class="dam-image">
                        <label>Dam (Female)</label>
                        <img src="<?php echo $row["dam_image"] ?>" alt="Dam Image">
                    </div>
                  </div>
                </div>
              </div>
            </div>
<?php
}
}
?>
</div>
    </div>
  </div>
</div>


<script>

  document.getElementById('upload-field').addEventListener('change', function () {
    var fileInput = this;
    var imagePreview = document.getElementById('image-preview');
    var fileNameText = document.getElementById('file-name');

    if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();
        var fileName = fileInput.files[0].name;
        var fileExtension = fileName.split('.').pop();
        var displayFileName = fileName.substring(0, 5);

        if (fileName.length > 5) {
            displayFileName += '...' + fileExtension;
        } else {
            displayFileName += '.' + fileExtension;
          }

reader.onload = function (e) {
    imagePreview.src = e.target.result;
    imagePreview.style.display = 'block';
    fileNameText.textContent = displayFileName;
};

reader.readAsDataURL(fileInput.files[0]);
} else {
imagePreview.style.display = 'none';
fileNameText.textContent = "No file chosen";
}
});

</script>

<script src="../../public/assets/js/post.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

