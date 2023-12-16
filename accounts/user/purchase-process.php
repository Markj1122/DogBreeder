<?php
// Include the database connection
include '../../page/router/config.php';

// Initialize the $success variable to false
$success = false;

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get form data and sanitize it (to prevent SQL injection)
    $trackingNumber = isset($_POST['tracking_number']) ? trim($_POST['tracking_number']) : '';
    $purchaseId = isset($_POST['purchase_id']) ? trim($_POST['purchase_id']) : '';
    $firstName = isset($_POST['fname']) ? trim($_POST['fname']) : '';
    $lastName = isset($_POST['lname']) ? trim($_POST['lname']) : '';
    $delivery = isset($_POST['delivery']) ? trim($_POST['delivery']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $contact = isset($_POST['contact']) ? trim($_POST['contact']) : '';
    $payment = isset($_POST['payment']) ? trim($_POST['payment']) : '';
    $status = isset($_POST['status']) ? trim($_POST['status']) : '';

    // Get values from the form
    $breederID = isset($_POST['breeder_id']) ? trim($_POST['breeder_id']) : '';
    $postFeedID = isset($_POST['post_feed_id']) ? trim($_POST['post_feed_id']) : '';
    $customerID = isset($_POST['customer_id']) ? trim($_POST['customer_id']) : '';
    $price = isset($_POST['price']) ? floatval($_POST['price']) : null; // Convert price to a floating-point number
    $dogType = isset($_POST['dog_type']) ? trim($_POST['dog_type']) : '';

    // Check if any files were uploaded
    if (isset($_FILES['pet_image']) && is_array($_FILES['pet_image']['name'])) {
        $fileCount = count($_FILES['pet_image']['name']);
        $petImages = array(); // Create an array to store image file names

        for ($i = 0; $i < $fileCount; $i++) {
            $fileName = $_FILES['pet_image']['name'][$i];
            $tempName = $_FILES['pet_image']['tmp_name'][$i];
            $uploadDir = '../../public/src/uploads/purchasing/'; // Set your upload directory

            // Generate a unique filename
            $uniqueFileName = uniqid() . '_' . $fileName;

            // Move the uploaded file to the upload directory
            if (move_uploaded_file($tempName, $uploadDir . $uniqueFileName)) {
                $petImages[] = $uniqueFileName;
            }
        }
    } else {
        // If no files were uploaded, initialize the $petImages array with an empty string or any appropriate default value
        $petImages = array('');
    }

    // Prepare the SQL statement for inserting a new post using prepared statements
    $sql = "INSERT INTO purchase (purchase_breeder_id, purchase_customer_id, purchase_post_id, purchase_status) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Serialize the array before binding
        $serializedPetImages = serialize($petImages);

        // Bind parameters
        $stmt->bind_param("ssss", $breederID, $customerID, $postFeedID, $status);

        // Execute the statement
        if ($stmt->execute()) {
            $success = true;
            // Get the last inserted ID
            $id = $stmt->insert_id;

            // Close the statement
            $stmt->close();
        } else {
            echo "Error inserting purchase: " . $stmt->error;
        }
    } else {
        echo "Error preparing the SQL statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();

    if ($success) {
        // All insertions were successful
        session_start();
        $_SESSION['success'] = "Purchase submitted and it's being processed. Breeder will message you in the chat!";
        header("Location: post-feed.php");
        exit;
    } else {
        // Handle the case where data was not successfully inserted.
        // You can set an error message or redirect to an error page as needed.
    }
}
?>
