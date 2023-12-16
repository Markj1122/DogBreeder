<?php
session_start();
include ('../../page/router/config.php');

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['op']) && isset($_POST['np']) && isset($_POST['confirm_password'])) {
    $old_password = validate($_POST['op']);
    $new_password = validate($_POST['np']);
    $confirm_password = validate($_POST['confirm_password']);

    // Additional validation for password complexity, etc. can be added here.

    // Check if the new password matches the confirmation password.
    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match";
    } else {
        // Hash the old and new passwords (you may use a stronger password hashing method than md5).
        $hashed_old_password = md5($old_password);
        $hashed_new_password = md5($new_password);

        // Assuming you have a id to identify the admin whose password you want to update.
        $id = $_SESSION['id']; // You need to retrieve the adminID from the session or another source.

        // Verify the old password before updating the new one.
        $stmt = $conn->prepare("SELECT password FROM `admin` WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];
            if ($stored_password !== $hashed_old_password) {
                $_SESSION['error'] = "Incorrect old password";
            }
        } else {
            $_SESSION['error'] = "Admin not found";
        }

        // Update the password in the database.
        $stmt = $conn->prepare("UPDATE `admin` SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashed_new_password, $id);

        if ($stmt->execute()) {
            // Password updated successfully.
            $_SESSION['success'] = "Password updated successfully!";
        } else {
            // Password update failed, handle the error.
            $_SESSION['error'] = "Password update failed";
        }
    }
} else {
    // No input provided
    $_SESSION['error'] = "Invalid request";
}

// Redirect the user to the appropriate page
header("Location: change-password.php");
exit();
?>
