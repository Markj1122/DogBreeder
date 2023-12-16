<?php include "./page/layouts/master.php"?>
<title>Post Feed - Section</title>
<link href="./public/assets/css/homepage-post.css" rel="stylesheet">
<link href="./public/assets/css/headers.css" rel="stylesheet">
<link href="./public/assets/css/purchase.css" rel="stylesheet">
<link href="./public/assets/css/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="icon" href="./public/src/images/logo.png">
<?php include "./page/layouts/homepage-header.php"?>

<div class="header-line">
    <hr>
</div>

<div class="container">
<?php
// Include the database connection
include ('./page/router/config.php');

// Check if the search parameter is set in the GET request
if (isset($_GET['search'])) {
    // Get and sanitize the search query
    $searchQuery = trim($_GET['search']);

    // Prepare the SQL statement to search for records based on breeder_name and breed_type
    $sql = "SELECT * FROM post_feed WHERE breeder_name LIKE ? OR breed_type LIKE ?";
    
    $stmt = $conn->prepare($sql);

    // Check for errors in preparing the SQL statement
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

     // Bind the search query to the SQL statement
     $searchParam = "%" . $searchQuery . "%"; // Add wildcards for partial matching
     if (!$stmt->bind_param("ss", $searchParam, $searchParam)) {
         die("Bind failed: " . $stmt->error);
     }
     
     // Execute the query
     if (!$stmt->execute()) {
         die("Execute failed: " . $stmt->error);
     }
     
     // Get the result set
     $result = $stmt->get_result();
     
     // Check if there are any matching records
     if ($result->num_rows > 0) {

        echo "<p style='font-size:1.2rem; position:relative; bottom:10px; left:20px;'>Search for <strong style='width:object:fit; height:5vh; background:#ccc; padding:4px;'>$searchQuery</strong></p>";

         while ($row = $result->fetch_assoc()) {
             // Display the search results as needed
             $breederProfile = $row['breeder_profile'];
             $breederName = $row['breeder_name'];
             $content = $row['content'];
             $breedType = $row['breed_type'];
             $petPrice = $row['price'];
             $datePosted = $row['date_posted'];
             $formattedDate = date("F j, Y - g:i A", strtotime($datePosted));
             $petImages = $row['pet_image'];

             ?>
    <div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-12">
        <?php
        $sql = "SELECT * FROM `post_feed`";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="card post-card mb-4 border border-3"> 
          <div class="card-header post-header">
            <div class="media">
              <img src="./public/src/images/user-icon.png" alt="Profile Image" class="profile-image rounded-circle w-6 h-6">
              <div class="ml-3">
                <h5 class="breeder-name card-title mr-2"><?php echo $row['breeder_name']; ?></h5>
                <p class="posted-date d-flex card-subtitle mb-2 text-muted"><strong>Posted&nbsp;•&nbsp;</strong><?php echo date("F j, Y - g:i A", strtotime($row['date_posted'])); ?></p>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <?php
                  $content = $row['content'];
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
                    if (mysqli_num_rows($result) == 1) {
                        // Display one random image for a single post
                        $randomImageNumber = rand(1, 3); // Adjust the range based on the number of images you have
                        $imageSrc = "./public/src/images/dogbreed_background($randomImageNumber)." . (rand(0, 1) ? "jpeg" : "png");
                        ?>
                        <img src="<?php echo $imageSrc; ?>" alt="&nbsp;Hide Photo" class="img-fluid" style="object-fit: cover; height: 55vh; width: 700px;">
                    <?php } else {
                        // Display one random image for each post
                        $randomImageNumber = rand(1, 3); // Adjust the range based on the number of images you have
                        $imageSrc = "./public/src/images/dogbreed_background($randomImageNumber)." . (rand(0, 1) ? "jpeg" : "png");
                        ?>
                        <img src="<?php echo $imageSrc; ?>" alt="&nbsp;Hide Photo" class="img-fluid" style="object-fit: cover; height: 55vh; width: 700px;">
                    <?php } ?>
                </div>
               </div>
              </div>
            </div>
            <div class="post-details" style="display: flex; justify-content: center; align-items: center; font-size: 1rem; gap: 10px;">
    <span class="mx-2"><p class="breed"><strong>Dog Type:</strong> <?php echo $row['dog_type']; ?></p></span>
    <span class="mx-2"><p class="breed"><strong>Breed Type:</strong> <?php echo $row['breed_type']; ?></p></span>
    <span class="mx-2"><p class="price"><strong>Price:</strong> ₱<?php echo number_format($row['price'], 0, '.', ','); ?></p></span>
</div>
</div>
<div class="card-footer post-actions" style="display: flex; justify-content: space-between;">
<a href="#" class="link-primary" style="text-decoration: none" data-bs-toggle="modal" data-bs-target="#seeMoreModal<?php echo $row['id']; ?>"><i class="fa-solid fa-magnifying-glass"></i> View More</a>
    <a href="#" class="link-primary" style="text-decoration: none" onclick="openModal()"><i class="fas fa-shopping-cart"></i> Buy Me</a>
</div>
</div>

<div id="signInModal" class="modal-container" style="display: none;">
  <div class="modal-content">
    <span id="countdown" class="count-down" style="display: none;"></span>
    <div class="loginBox">
      <img class="user" src="./public/src/images/logo.png">
      <h2>Sign-In to Continue</h2>
      <form action="./components/login/login-homepage.php" method="post">
        <div class="input-group">
          <i class="fas fa-envelope"></i>
          <input type="text" name="username_or_email" placeholder="Email" required>
        </div>
        <div class="input-group">
          <i class="fas fa-lock "></i>
          <input type="password" id="passwordField" name="password" placeholder="Password" required>
        </div>
        <div class="eye-toggle">
          <i class="fas fa-eye" id="showPassword"></i>
          <i class="fas fa-eye-slash" id="hidePassword" style="display: none;"></i>
        </div>
        <select id="userTypeSelect" name="role">
          <option value="">Select Role</option>
          <option value="admin">Admin</option>
          <option value="user">User</option>
          <option value="breeder">Breeder</option>
        </select>
        <div class="remember-forgot">
          <label>
            <input type="checkbox">
            <span>Remember me</span>
          </label>
          <a href="#" id="forgotPasswordLink">Forgot password?</a>
        </div>
        <input type="submit" name="sign-in" id="signinButton" value="Sign In">
        <span class="close-btn" id="closeSignInModalBtn">Close</span>
        <div class="register-link">
          <p>Don't have an account? <a href="./components/login/user.php">Register</a></p>
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
                    <img src="./public/src/images/dogbreed_background(4).jpg" alt="Pet Vaccine">
                   </div>
                   <div class="dob">
                       <label>Birthdate:</label>
                       <p><?php echo date('F j, Y', strtotime($row["birthdate"])) ?></p>
                    </div>
                    <div class="sire-image">
                        <label>Sire (Male)</label>
                        <img src="./public/src/images/dogbreed_background(2).jpeg" alt="Sire Image">
                    </div>
                    <div class="dam-image">
                        <label>Dam (Female)</label>
                        <img src="./public/src/images/dogbreed_background(3).jpeg" alt="Dam Image">
                    </div>
                  </div>
                </div>
              </div>
            </div>
        <?php
        }
        ?>
    </div>
  </div>
</div>


<?php
        }
    } else {
        echo "<h2 style='text-align:center; position:relative; font-weight:400; top:100px;'>No results found.</h2>";
    }
    
    // Close the statement
    $stmt->close();
}

// Close the database connection (consider closing it outside the if block if needed)
$conn->close();
?>
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

  function openModal() {
    var modal = document.getElementById("signInModal");
    modal.style.display = "block";
  }

  function closeModal() {
    var modal = document.getElementById("signInModal");
    modal.style.display = "none";
  }

  // Close the modal when the close button is clicked
  var closeBtn = document.getElementById("closeSignInModalBtn");
  if (closeBtn) {
    closeBtn.addEventListener("click", function (event) {
      event.preventDefault(); // Prevent the default behavior of the anchor link
      closeModal();
    });
  }
</script>

<script src="../../public/assets/js/post.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Include Bootstrap JavaScript and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>