<?php
// Include the database connection
include('../../page/router/config.php');

// Check if the form is submitted
if (isset($_POST['submit_post'])) {
    // Get form data and sanitize it (to prevent SQL injection)
    $breederImage = isset($_POST['breeder_profile']) ? trim($_POST['breeder_profile']) : '';
    $breederName = isset($_POST['breeder_name']) ? trim($_POST['breeder_name']) : '';
    $breederId = isset($_POST['breeder_id']) ? intval($_POST['breeder_id']) : 0; // Ensure breeder_id is an integer
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';
    $breedType = isset($_POST['breed_type']) ? trim($_POST['breed_type']) : '';
    $price = isset($_POST['price']) ? floatval($_POST['price']) : null; // Convert price to a floating-point number
    $dogType = isset($_POST['dog_type']) ? trim($_POST['dog_type']) : '';
    $status = "Available"; //set status "available" by default
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';

    // Directory to move the uploaded files
    $uploadDirectory = '../../public/src/uploads/';

    // Additional directories for dam, sire, pet, and vaccine images
    $damDirectory = '../../public/src/uploads/dam/';
    $sireDirectory = '../../public/src/uploads/sire/';
    $petDirectory = '../../public/src/uploads/pets/';
    $vaccineDirectory = '../../public/src/uploads/vaccine/';

    // Loop through the file inputs and move the uploaded files
    $uploadedFiles = array();
    foreach ($_FILES as $inputName => $file) {
        $targetFile = $uploadDirectory . basename($file['name']);

        // Check the input name to determine the destination directory
        if ($inputName === 'dam_image') {
            $targetFile = $damDirectory . basename($file['name']);
        } elseif ($inputName === 'sire_image') {
            $targetFile = $sireDirectory . basename($file['name']);
        } elseif ($inputName === 'pet_image') {
            $targetFile = $petDirectory . basename($file['name']);
        } elseif ($inputName === 'vaccine_image') {
            $targetFile = $vaccineDirectory . basename($file['name']);
        }

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            $uploadedFiles[$inputName] = $targetFile;
        } else {
            echo "Error uploading file: " . $file['name'];
        }
    }

    // Prepare the SQL statement for inserting a new post using prepared statements
    $sql = "INSERT INTO post_feed (	post_feed_breeder_id, 
                                    post_feed_content, 
                                    post_feed_breed_type, 
                                    post_feed_price, 
                                    post_feed_status, 
                                    post_feed_dog_bday,
                                    post_feed_pet_image, 
                                    post_feed_vaccine_image, 
                                    post_feed_dam_image, 
                                    post_feed_sire_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";

     
    $stmt = $conn->prepare($sql);

    // Update the bind_param call to match the number of placeholders

    $stmt->bind_param("ssssssssss", $breederId, 
                                    $content, 
                                    $breedType, 
                                    $price, 
                                    $status, 
                                    $birthdate, 
                                    $uploadedFiles['pet_image'], 
                                    $uploadedFiles['vaccine_image'], 
                                    $uploadedFiles['dam_image'], 
                                    $uploadedFiles['sire_image']);

    // Execute the query
    $success = $stmt->execute();

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();

    if ($success) {
        // Insertion was successful
        session_start();
        $_SESSION['success'] = "Post has been uploaded!";
        header("Location: post.php");
        exit;
    } else {
        echo "Error inserting post: " . $stmt->error;
    }
}
?>
