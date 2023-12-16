<?php include "../../page/layouts/master.php"; ?>
<title>Post Feed - Section</title>
<link href="../../public/assets/css/headers.css" rel="stylesheet">
<link href="../../public/assets/css/purchase.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="icon" href="../../public/src/images/logo.png">
<?php include "../../page/layouts/breeder-header.php"; ?>

    <div class="header-line">
        <hr>
    </div>

<?php
echo '<div class="container">';
include ('../../page/router/config.php');

// Check if the breed parameter is set in the GET request
if (isset($_GET['breed'])) {
    // Get and sanitize the breed query
    $selectedBreed = trim($_GET['breed']);

    // Prepare the SQL statement to search for records based on breed_type
    $sql = "SELECT * FROM post_feed  INNER JOIN user ON user_id = post_feed_breeder_id WHERE post_feed_breed_type = ?";
    
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    if (!$stmt->bind_param("s", $selectedBreed)) {
        die("Bind failed: " . $stmt->error);
    }

    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "<p style='font-size:1.2rem; position:relative; bottom:10px; left:5px;'>See post for <strong style='width:object:fit; height:5vh; background:#ccc; padding:4px;'>$selectedBreed</strong></p>";

        while ($row = $result->fetch_assoc()) {
            $breederProfile = $row['user_profile_image'];
            $breederName = $row['user_firstname'] . $row['user_lastname'];
            $content = $row['post_feed_content'];
            $breedType = $row['post_feed_breed_type'];
            $petPrice = $row['post_feed_price'];
            $datePosted = $row['post_date_posted'];
            $formattedDate = date("F j, Y - g:i A", strtotime($datePosted));
            $petImages = $row['post_feed_pet_image'];
    ?>
    <div class="card post-card mb-4 border border-3"> 
        <div class="card-header post-header">
            <div class="media">
            <img src="<?php echo $breederProfile ?>" alt="Profile Image" class="profile-image rounded-circle w-6 h-6">
              <div class="ml-3">
                <h5 class="breeder-name card-title mr-2"><?php echo $breederName ?></h5>
                <p class="posted-date d-flex card-subtitle mb-2 text-muted"><strong>Posted&nbsp;•&nbsp;</strong><?php echo $formattedDate; ?></p>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <?php
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
        $petImage = explode(',', $petImages);
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

    <span class="mx-2"><p class="breed"><strong>Breed Type:</strong> <?php echo $breedType ?></p></span>
    <span class="mx-2"><p class="price"><strong>Price:</strong> ₱<?php echo number_format($petPrice, 0, '.', ','); ?></p></span>
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
      <div class="modal-header">
        <h5 class="modal-title" id="purchasemodalLabel" style="color: blue;">Customer Purchase Form</h5>
      </div>
    <form action="purchase-process.php" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <input type="hidden" name="breeder_name" value="<?php echo $row['breeder_name']; ?>">
        <input type="hidden" name="pet_image" value="<?php echo $row['pet_image']; ?>">
        <input type="hidden" name="breed_type" value="<?php echo $row['breed_type']; ?>">
        <input type="hidden" name="dog_type" value="<?php echo $row['dog_type']; ?>">
        <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
      </div>
      <input type="hidden" name="status" value="PENDING">

      <div class="name-container">
  <input type="text" name="fname" placeholder="First Name">
  <input type="text" name="lname" placeholder="Last Name">
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
                    <option value="">Mood of Payment</option>
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

<div class="modal fade" id="seeMoreModal<?php echo $row['post_feed_id']; ?>" tabindex="-1" aria-labelledby="seeMoreModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-cards">
                  <div class="modal-header">
                    <h5 class="modal-title" id="updateodalLabel" style="color:green;">Pet Information
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                   <div class="vaccine-image">
                    <img src="<?php echo $row["post_feed_vaccine_image"] ?>" alt="Pet Vaccine">
                   </div>
                   <div class="dob">
                       <label>Birthdate:</label>
                       <p><?php echo date('F j, Y', strtotime($row["post_feed_dog_bday"])) ?></p>
                    </div>
                    <div class="sire-image">
                        <label>Sire (Male)</label>
                        <img src="<?php echo $row["post_feed_sire_image"] ?>" alt="Sire Image">
                    </div>
                    <div class="dam-image">
                        <label>Dam (Female)</label>
                        <img src="<?php echo $row["post_feed_dam_image"] ?>" alt="Dam Image">
                    </div>
                  </div>
                </div>
              </div>
            </div>
    <?php
        }
    } else {
        echo "<h2 style='text-align:center; position:relative; top:160px; font-weight:400;'>No record found for this Breed.</h2>";
    }

    $stmt->close();
}

$conn->close();
echo '</div>';

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
