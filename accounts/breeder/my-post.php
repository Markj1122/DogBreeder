<?php include "../../page/layouts/master.php"?>
<title>My Post - Section</title>
<!-- <link href="../../public/assets/css/my-post.css" rel="stylesheet"> -->
<link href="../../public/assets/css/headers.css" rel="stylesheet">
<link href="../../public/assets/css/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="icon" href="../../public/src/images/logo.png">
<?php include "../../page/layouts/breeder-header.php"?>


<div class="header-line">
    <hr>
</div> 

<?php 
if(isset($_SESSION['success'])) {
    $alert_class = 'alert-success';
    $icon_class = 'fas fa-check-circle';
    $message = $_SESSION['success'];
    unset($_SESSION['success']);
}
?>

<?php if(isset($alert_class)): ?>
<div class="alert <?php echo $alert_class; ?> alert-dismissible fade show" role="alert">
    <i class="<?php echo $icon_class; ?>" style="font-size:14px; color:green;"></i>
    <?php echo $message; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-12">
        <?php

        $sql = "SELECT * FROM `post_feed` INNER JOIN `user` ON user_id = post_feed_breeder_id where post_feed_breeder_id = ". $_SESSION['user_id']."";
       
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0) {
            echo "<p style='font-size: 1.3rem; text-align: center; position: relative; top: 100px;'>You have no post yet</p>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="card post-card mb-4 border border-3"> 
                <div class="card-header post-header"> 
                <a href="#" class="update-status" id="updateStatus" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $row['user_id']; ?>"><i class="fas fa-pen-square"></i></a>
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
            <span class="mx-2"><p class="breed"><strong>Status:</strong> <?php echo $row['post_feed_status']; ?></p></span>
    <span class="mx-2"><p class="breed"><strong>Breed Type:</strong> <?php echo $row['post_feed_breed_type']; ?></p></span>
    <span class="mx-2"><p class="price"><strong>Price:</strong> ₱<?php echo number_format($row['post_feed_price'], 0, '.', ','); ?></p></span>
</div>
</div>
</div>
</div>

            <div class="modal fade" id="updateModal<?php echo $row['user_id']; ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="max-width:340px; height:25vh;">
                  <div class="modal-header">
                    <h5 class="modal-title" id="updateodalLabel" style="color:orangered;">Update Status
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                  <form action="update-post.php" method="POST">
    <div class="status">
        <input type="hidden" name="postfeedid" value="<?php echo $row['post_feed_id']; ?>">
       <select for="updateStatus" name="status" >

       <option value="Available" <?php echo $row['post_feed_status'] == "Available"? 'selected':'';?> >Available</option>
       <option value="Sold" <?php echo $row['post_feed_status'] == "Sold"? 'selected':'';?> >Sold</option>
       <option value="Not Available" <?php echo $row['post_feed_status'] == "Not Available"? 'selected':'';?>>Not Available</option>
      </select>
    </div>
    <button type="submit" name="submit" class="btn-update">Update</button>
</form>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>



