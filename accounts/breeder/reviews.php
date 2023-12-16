<?php include "../../page/layouts/master.php"?>
<title>Reviews - Homepage</title>
<link href="../../public/assets/css/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="icon" href="./public/src/images/logo.png">
<?php include "../../page/layouts/breeder-header.php"?>

<h2 style="text-align: center">Reviews Section</h2>

<div class="header-line">
    <hr>
</div>

<div class="container">
    <div class="col-lg-12">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dogbreeder_db";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check the connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM review INNER JOIN user on user_id = review_user_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0) {
            echo "<p style='font-size: 1.3rem; text-align: center; position: relative; top: 100px;'>Reviews will appear here</p>";
        } else {
            $counter = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                if ($counter % 2 == 0) {
                    // Start a new row after every two cards
                    echo '<div class="row">';
                }
                ?>
               <div class="col-md-6">
                    <div class="card post-card mb-4 border border-3"> 
                        <div class="card-header post-header">
                        <img src="<?php echo $row['user_profile_image'] ?>" alt="Profile Image" style="position: relative; right: 10px; bottom: 5px;" class="profile-image rounded-circle w-6 h-6">
                            <h3><?php echo $row['user_firstname'] ?></h3>
                            <p style="margin-left: 33%"><?php echo date("F j, Y", strtotime($row['review_date_rated'])); ?></p>
                        </div>
                        <div class="card-body">
                            <span>
    <?php
    $rating = intval($row['review_rate']); // Convert the rating to an integer
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            // Display a filled star if $i is less than or equal to the rating
            echo '<i class="fa-solid fa-star" style="color: gold"></i>';
        } else {
            // Display an empty star if $i is greater than the rating
            echo '<i class="fa-regular fa-star" style="color: gold"></i>';
        }
    }
    ?>
    
</span>
    <p style="margin-top: 10px"><?php echo $row['review_comment'] ?></p>
</div>

                    </div>
                </div>
                <?php
                if ($counter % 2 == 1) {
                    // Close the row after every two cards
                    echo '</div>';
                }
                $counter++;
            }
            // Close the row if the total number of cards is odd
            if ($counter % 2 == 1) {
                echo '</div>';
            }
        }
        ?>
    </div>
</div>


<?php include "../../page/layouts/footer.php"?>