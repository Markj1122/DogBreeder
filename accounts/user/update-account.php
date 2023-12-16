<?php
session_start();
include ('../../page/router/config.php');

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['new_email']) && isset($_FILES['profile_image'])) {
    $new_email = validate($_POST['new_email']); // Validate the new email

    // Additional validation for email format can be added here if needed.

    // Check if the profile_image field is empty or not
    if ($_FILES['profile_image']['size'] > 0) {
        // Upload and handle the new profile image for the users
        $target_dir = "../../public/src/uploads/user/";
        $profile_target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
        $profile_imageFileType = strtolower(pathinfo($profile_target_file, PATHINFO_EXTENSION));

        // Check if profile_image has a valid file type
        $profile_allowed_extensions = array("jpg", "jpeg", "png");
        if (!in_array($profile_imageFileType, $profile_allowed_extensions)) {
            $_SESSION['error'] = "Invalid profile image file type";
        } else if (!move_uploaded_file($_FILES["profile_image"]["tmp_name"], $profile_target_file)) {
            $_SESSION['error'] = "Error uploading profile image";
        } else {
            // Use a prepared statement to update users data in the database,
            // including the new email and the file path to the uploaded image.
            $currentDateTime = date('Y-m-d H:i:s');
            $stmt = $conn->prepare("UPDATE `user` SET user_email = ?, user_profile_image = ? WHERE user_email = ?");
            
            if ($stmt) { // Check if the statement was successfully prepared
                $stmt->bind_param("sss", $new_email, $profile_target_file, $_SESSION['user_email']);
                if ($stmt->execute()) {
                    $_SESSION['success'] = "Profile successfully updated!";
                    // Update the email in the session variable as well
                    $_SESSION['user_email'] = $new_email;
                } else {
                    $_SESSION['error'] = "Profile update failed: " . $stmt->error; // Provide error details
                }
                $stmt->close(); // Close the prepared statement
            } else {
                $_SESSION['error'] = "Statement preparation failed: " . $conn->error; // Provide error details
            }
        }
    } else {
        // No new profile image uploaded, use the existing one
        $profile_target_file = $_SESSION['user_profile_image'];

        // Use a prepared statement to update only the email in the database
        $stmt = $conn->prepare("UPDATE `user` SET user_email = ? WHERE user_email = ? ");

        if ($stmt) { // Check if the statement was successfully prepared
            $stmt->bind_param("ss", $new_email, $_SESSION['user_email']);
            if ($stmt->execute()) {
                $_SESSION['success'] = "Email successfully updated!";
                // Update the email in the session variable as well
                $_SESSION['user_email'] = $new_email;
            } else {
                $_SESSION['error'] = "Profile update failed: " . $stmt->error; // Provide error details
            }
            $stmt->close(); // Close the prepared statement
        } else {
            $_SESSION['error'] = "Statement preparation failed: " . $conn->error; // Provide error details
        }
    }
} else {
    $_SESSION['error'] = "Invalid request";
}

// Redirect to the current page using JavaScript
echo "<script>window.location.href = 'edit-account.php';</script>";
exit();
?>
