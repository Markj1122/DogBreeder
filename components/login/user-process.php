<?php
session_start();
include "connection.php";

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (empty($_POST['fname'])) {
    $_SESSION['error'] = "Firstname is required!";
    header("Location: user.php");
    exit();
} else {
    if (empty($_POST['lname'])) {
        $_SESSION['error'] = "Lastname is required!";
        header("Location: user.php");
        exit();
    } else {
        if (empty($_POST['email'])) {
            $_SESSION['error'] = "Email is required!";
            header("Location: user.php");
            exit();
        } else {
            if (empty($_POST['password'])) {
                $_SESSION['error'] = "Password is required!";
                header("Location: user.php");
                exit();
            } else {
                if (empty($_POST['lname']) || empty($_POST['email']) ||
                    empty($_POST['password']) || empty($_FILES['profile_image']['name'])) {
                    $_SESSION['error'] = "Credentials are required.";
                    header("Location: user.php");
                    exit();
                }
            }
        }
    }
}


// Rest of your code remains the same.


if (isset($_POST['fname']) && isset($_POST['lname']) 
    && isset($_POST['email']) && isset($_POST['password']) 
    && isset($_POST['user_type']) && isset($_FILES['profile_image'])) {

    $fname = validate($_POST['fname']);
    $lname = validate($_POST['lname']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $user_type = validate($_POST['user_type']);
    $contact = validate($_POST['contact']);
    $address = validate($_POST['address']);
    $status = "Active"; //set active status by default

    // Additional validation for email format, password complexity, etc. can be added here.

    // Hash the password (you may use a stronger password hashing method than md5).
    $hashed_password = md5($password);

    // Check if the email is already in use
    $stmt = $conn->prepare("SELECT * FROM user WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Email is already in use
        $_SESSION['error'] = "Email is already taken.";
        header("Location: user.php");
        exit();
    }

    // Check if the firstname and lastname is already in use
    $stmt = $conn->prepare("SELECT * FROM user WHERE user_firstname = ? AND user_lastname = ?");
    $stmt->bind_param("ss", $fname, $lname);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Firstname is already in use
        $_SESSION['error'] = "Name is already taken.";
        header("Location: user.php");
        exit();
    }

    
    // Upload and handle the profile image
    $target_dir = "../../public/src/uploads/user/"; // Specify the directory where you want to store uploaded images.
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the uploaded file is an image
    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
    if ($check === false) {
        $_SESSION['error'] = "Invalid image file.";
        //header("Location: user1.php");
        header("Location: user.php");
        exit(); 
    }

    // Check if the file type is allowed (e.g., jpg, jpeg, png)
    $allowed_extensions = array("jpg", "jpeg", "png");
    if (!in_array($imageFileType, $allowed_extensions)) {
        $_SESSION['error'] = "Invalid file type";
        header("Location: user.php");
        exit(); 
    }

    // Move the uploaded file to the specified directory
    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
        // Use a prepared statement to insert user data into the database, including the file path to the uploaded image.
        $stmt = $conn->prepare("INSERT INTO user (user_firstname, user_lastname, user_email, user_password, user_role, user_profile_image, user_contact, user_address, user_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $fname, $lname, $email, $hashed_password, $user_type, $target_file, $contact, $address, $status);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Registered successfully!";
            header("Location: index.php");
            exit();
        }   else {
            // Registration failed, handle the error and redirect the user accordingly.
            $_SESSION['error'] = "Registration failed";
            header("Location: user.php");
            exit(); 
        }
    } else {
        // Handle errors related to file upload.
        $_SESSION['error'] = "Error while uploading image";
        header("Location: user.php");
        exit(); 
    }
} else {
    // Redirect the user to the registration page if the POST data is not set.
    header("Location: user.php");
    exit();
}
?>
