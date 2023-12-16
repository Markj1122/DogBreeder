<?php
session_start();
include "connection.php";

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['fname']) && isset($_POST['lname']) 
    && isset($_POST['email']) && isset($_POST['password']) 
    && isset($_POST['user_type']) && isset($_FILES['profile_image'])) {

    $fname = validate($_POST['fname']);
    $lname = validate($_POST['lname']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $user_type = validate($_POST['user_type']);

    // Additional validation for email format, password complexity, etc. can be added here.

    // Hash the password (you may use a stronger password hashing method than md5).
    $hashed_password = md5($password);

    // Upload and handle the profile image
    $target_dir = "../../public/src/uploads/user/"; // Specify the directory where you want to store uploaded images.
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the uploaded file is an image
    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
    if ($check === false) {
        header("Location: user.php?error=Invalid image file");
        exit();
    }

    // Check if the file type is allowed (e.g., jpg, jpeg, png)
    $allowed_extensions = array("jpg", "jpeg", "png");
    if (!in_array($imageFileType, $allowed_extensions)) {
        header("Location: user.php?error=Invalid file type");
        exit();
    }

    // Generate a random verification token
    $verification_token = bin2hex(random_bytes(16));

    // Insert user data along with the verification token into the database
    $stmt = $conn->prepare("INSERT INTO users (fname, lname, email, password, user_type, profile_image, verification_token) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $fname, $lname, $email, $hashed_password, $user_type, $target_file, $verification_token);

    if ($stmt->execute()) {
        // Send a verification email to the user
        $subject = "Email Verification";
        $message = "Click the following link to verify your email: <a href='http://yourwebsite.com/verify.php?token=$verification_token'>Verify Email</a>";
        // Use PHP's mail function or a library like PHPMailer to send the email.

        header("Location: user.php?success=Registered successfully! Check your email for verification.");
        exit();
    } else {
        // Registration failed, handle the error and redirect the user accordingly.
        header("Location: user.php?error=Registration failed");
        exit();
    }
} else {
    // Redirect the user to the registration page if the POST data is not set.
    header("Location: user.php");
    exit();
}
?>
