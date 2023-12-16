<?php
// Include the database connection
include('../../page/router/config.php');

// Check if the form is submitted
if (isset($_POST['submit_review'])) {
    // Get form data and sanitize it (to prevent SQL injection)
    $profileImage = isset($_POST['profile_image']) ? trim($_POST['profile_image']) : '';
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';
    $rates = isset($_POST['rates']) ? trim($_POST['rates']) : '';

    // Prepare the SQL statement for inserting a new post using prepared statements
    $sql = "INSERT INTO reviews (profile_image, `name`, `message`, rates, date_rated) VALUES (?, ?, ?, ?, NOW()) ";

    $stmt = $conn->prepare($sql);

    // Check if the prepare statement was successful
    if ($stmt) {
        // Update the bind_param call to match the number of placeholders
        $stmt->bind_param("ssss", $profileImage, $name, $message, $rates);

        // Execute the statement
        $success = $stmt->execute();

        // Close the statement
        $stmt->close();

        // Close the database connection
        $conn->close();

        if ($success) {
            // All insertions were successful
            session_start();
            $_SESSION['success'] = "Your review has been successfully posted! Thank you for your interest in our website.";
            header("Location: see-purchase.php");
            exit;
        } else {
            echo "Error inserting review: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>
