<?php include "../layouts/master.php"?>
<title>Post Feed - Section</title>
<link href="../../public/assets/css/post.css" rel="stylesheet">
<link href="../../public/assets/css/headers.css" rel="stylesheet">
<link href="../../public/assets/css/purchase.css" rel="stylesheet">
<link href="../../public/assets/css/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="icon" href="../../public/src/images/logo.png">
<?php include "../layouts/admin-header.php"?>


<h2 class="text-header">Marketplace for Dog Breeds</h2>

<div class="header-line">
    <hr>
</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-12">
        <?php
        $sql = "SELECT * FROM `post_feed`";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0) {
            echo "<p style='font-size: 1.3rem; text-align: center; position: relative; top: 100px;'>Post feed will appear here</p>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="card post-card mb-4 border border-3"> 
                <div class="card-header post-header">
            <div class="media">
              <img src="<?php echo $row['breeder_profile']; ?>" alt="Profile Image" class="profile-image rounded-circle w-6 h-6">
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
        $petImage = explode(',', $row['pet_image']);
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
    <span class="mx-2"><p class="breed"><strong>Dog Type:</strong> <?php echo $row['dog_type']; ?></p></span>
    <span class="mx-2"><p class="breed"><strong>Breed Type:</strong> <?php echo $row['breed_type']; ?></p></span>
    <span class="mx-2"><p class="price"><strong>Price:</strong> ₱<?php echo number_format($row['price'], 0, '.', ','); ?></p></span>
</div>
</div>
<div class="card-footer post-actions" style="display: flex; justify-content: space-between;">
    <a href="#" class="link-primary" style="text-decoration: none" id="seeeMore" data-bs-toggle="modal" data-bs-target="#seeMoreModal<?php echo $row['id']; ?>"><i class="fa-solid fa-magnifying-glass"></i> See More</a>
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
                   <div class="vaccine-image" style="position: relative; left: 8%;">
                   <label>Vaccine</label>
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


<script src="../../public/assets/js/post.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
