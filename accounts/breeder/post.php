<?php include "../../page/layouts/master.php"?>
<title>Post Feed - Section</title>
<link href="../../public/assets/css/post.css" rel="stylesheet">
<link href="../../public/assets/css/headers.css" rel="stylesheet">
<link href="../../public/assets/css/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="icon" href="../../public/src/images/logo.png">
<?php include "../../page/layouts/breeder-header.php"?>


<button class="open-modal" id="openModalBtn"><i class="fa-solid fa-pen-to-square"></i> Add Post</button>
 
<div class="search-container">
    <form action="search-post.php" method="GET">
        <input type="text" name="search" placeholder="Search...">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>
</div>


<div class="header-line">
    <hr>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close" id="closeModalBtn">&times;</span>
        <form action="post-process.php" method="post" enctype="multipart/form-data">
        <?php
if (isset($_SESSION['user_id'])) {
    $loggedInBreederId = $_SESSION['user_id'];

    include ('../../page/router/config.php');

    // Modify the SQL query to fetch data for the logged-in breeder
    $sql = "SELECT * FROM `user` WHERE user_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $loggedInBreederId);
    $stmt->execute(); 
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $name = $row['user_firstname'] . " " . $row["user_lastname"];
        $breeder_id = $row['user_id']; // Retrieve the breeder's ID

        echo "<h2>Create post</h2>";
        echo "<hr>";
        echo "<img src='" . $row['user_profile_image'] . "' class='profile'>";
        echo "<h3>" . $name . "</h3>";

        // Add the breeder_profile, breeder_name, and breeder_id fields within this if block
        echo '<input type="hidden" name="breeder_profile" value="' . $row['user_profile_image'] . '">';
        echo '<input type="hidden" name="breeder_name" style="display:none" value="' . $name . '">';
        echo '<input type="hidden" name="breeder_id" style="display:none" value="' . $breeder_id . '">';
    }

    $stmt->close(); 
}
?>
            <div class="privacy">
                <i class="fa-solid fa-earth-asia"></i>
                <span>Public</span>
            </div>

            <textarea name="content" placeholder="Write something or sell a pet..." rows="6" cols="49"></textarea>

            <div class="card-container">
                <div class="select-breeds">
                    <select name="breed_type">
                        <option value="">Breed Type</option>
                        <option value="Rottweiler">Rottweiler</option>
                        <option value="Shih Tzu">Shih Tzu</option>
                        <option value="Pomeranian">Pomeranian</option>
                        <option value="Golden Retriever">Golden Retriever</option>
                        <option value="Husky">Husky</option>
                        <option value="Labrador">Labrador</option>
                    </select>
                </div>
            </div>

            <div class="price">
                <input type="number" name="price" placeholder="Input price">
            </div>

            <div class="card-box">
                <div class="select-type">
                    <select name="dog_type">
                        <option value="">Dog Type</option>
                        <option value="Adult">Adult</option>
                        <option value="Puppy">Puppy</option>
                    </select>
                </div>
            </div>  

        <input type="hidden" name="status" value="Available">

        <div class="pet-upload-wrapper" data-text="Pet Image">
            <input name="pet_image" type="file" class="pet-upload-field" value="">
        </div>

        <div class="vaccine-upload-wrapper" data-text="Pet Vaccine">
            <input name="vaccine_image" type="file" class="vaccine-upload-field" value="">
        </div>

        <div class="birthdate">
            <input type="date" name="birthdate" title="Birthdate">
        </div>

        <div class="dam-upload-wrapper" data-text="Dam Image">
            <input name="dam_image" type="file" class="dam-upload-field" value="">
        </div>

        <div class="sire-upload-wrapper" data-text="Sire Vaccine">
            <input name="sire_image" type="file" class="sire-upload-field" value="">
        </div>

            <button class="button" type="submit" name="submit_post">Post</button>
 
        </form>
    </div>
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

<?php
        if (isset($_SESSION['breeder_id'])) {
          $loggedInBreederId = $_SESSION['breeder_id'];

          include('../../page/router/config.php');

          // Modify the SQL query to fetch data for the logged-in breeder
          $sql = "SELECT * FROM `breeders` WHERE breeder_id = ?";

          $stmt = $conn->prepare($sql);
          $stmt->bind_param("i", $loggedInBreederId);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($loggedInBreederData = $result->fetch_assoc()) {
            $breeder_id = $loggedInBreederData['breeder_id'];

          }

          $stmt->close();
        }
        ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-12">
        <?php

        $sql = "SELECT * FROM `post_feed` INNER JOIN `user` ON user_id = post_feed_breeder_id";
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
            <span class="mx-2"><p class="breed"><strong>Status:</strong> <?php echo $row['post_feed_status']; ?></p></span>
    <span class="mx-2"><p class="breed"><strong>Breed Type:</strong> <?php echo $row['post_feed_breed_type']; ?></p></span>
    <span class="mx-2"><p class="price"><strong>Price:</strong> ₱<?php echo number_format($row['post_feed_price'], 0, '.', ','); ?></p></span>
</div>
</div>
<div class="card-footer post-actions" style="display: flex; justify-content: space-between;">
    <a href="#" class="link-primary" style="text-decoration: none" id="seeeMore" data-bs-toggle="modal" data-bs-target="#seeMoreModal<?php echo $row['post_feed_id']; ?>"><i class="fa-solid fa-magnifying-glass"></i> See More</a>
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

<script>
    $("form").on("change", ".pet-upload-field", function(){ 
    $(this).parent(".pet-upload-wrapper").attr("data-text", $(this).val().replace(/.*(\/|\\)/, '') );
});

$("form").on("change", ".vaccine-upload-field", function(){ 
    $(this).parent(".vaccine-upload-wrapper").attr("data-text", $(this).val().replace(/.*(\/|\\)/, '') );
});

$("form").on("change", ".dam-upload-field", function(){ 
    $(this).parent(".dam-upload-wrapper").attr("data-text", $(this).val().replace(/.*(\/|\\)/, '') );
});

$("form").on("change", ".sire-upload-field", function(){ 
    $(this).parent(".sire-upload-wrapper").attr("data-text", $(this).val().replace(/.*(\/|\\)/, '') );
});
</script>


<script src="../../public/assets/js/post.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

