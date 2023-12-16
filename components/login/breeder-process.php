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
    header("Location: breeder.php");
    exit();
} else {
    if (empty($_POST['lname'])) {
        $_SESSION['error'] = "Lastname is required!";
        header("Location: breeer.php");
        exit();
    } else {
        if (empty($_POST['email'])) {
            $_SESSION['error'] = "Email is required!";
            header("Location: breeder.php");
            exit();
        } else {
            if (empty($_POST['password'])) {
                $_SESSION['error'] = "Password is required!";
                header("Location: breeder.php");
                exit();
            } else {
                if (empty($_POST['payment'])) {
                    $_SESSION['error'] = "Payment is required!";
                    header("Location: breeder.php");
                    exit();
                } else {
                    
                if (empty($_POST['lname']) || empty($_POST['email']) ||
                    empty($_POST['password']) || empty($_FILES['profile_image']['name'])) {
                    $_SESSION['error'] = "Credentials are required!";
                    header("Location: breeder.php");
                    exit();
                    }
                }
            }
        }
    }
}


if (
    isset($_POST['fname']) && isset($_POST['lname'])
    && isset($_POST['email']) && isset($_POST['password']) 
    && isset($_POST['user_type']) && isset($_FILES['receipt'])
    && isset($_FILES['profile_image']) 
    && isset($_FILES['id_image'])  && isset($_POST['payment'])
) {
    $fname = validate($_POST['fname']);
    $lname = validate($_POST['lname']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $user_type = validate($_POST['user_type']);
    $payment = validate($_POST['payment']);
    
    // Additional validation for email format, password complexity, etc. can be added here.

    // Hash the password (you may use a stronger password hashing method than md5).
    $hashed_password = md5($password);

    // Check if the email, first name, and last name are already taken in the database.
    // $stmt_check = $conn->prepare("SELECT * FROM `pending_approval` WHERE email = ? OR (fname = ? AND lname = ?)");
    // $stmt_check->bind_param("sss", $email, $fname, $lname);
    // $stmt_check->execute();
    // $result = $stmt_check->get_result();
    
    // if ($result->num_rows > 0) {
    //     $_SESSION['error'] = "This email or name combination is already taken.";
    //     header("Location: breeder.php");
    //     exit();
    // }

    // Upload and handle the profile image for breeders
    $target_dir = "../../public/src/uploads/breeder/";
    
    // Profile image
    $profile_target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    $profile_imageFileType = strtolower(pathinfo($profile_target_file, PATHINFO_EXTENSION));

    // Check if profile_image has a valid file type
    $profile_allowed_extensions = array("jpg", "jpeg", "png");
    if (!in_array($profile_imageFileType, $profile_allowed_extensions)) {
        $_SESSION['error'] = "Invalid profile image file type.";
        header("Location: breeder.php");
         exit();
    }
    
    if (!move_uploaded_file($_FILES["profile_image"]["tmp_name"], $profile_target_file)) {
        $_SESSION['error'] = "Error while uploading profile image.";
        header("Location: breeder.php");
         exit();
    }

    // Id image
    $id_target_file = $target_dir . basename($_FILES["id_image"]["name"]);
    $id_imageFileType = strtolower(pathinfo($id_target_file, PATHINFO_EXTENSION));

    // Check if id_image has a valid file type
    $id_allowed_extensions = array("jpg", "jpeg", "png");
    if (!in_array($id_imageFileType, $id_allowed_extensions)) {
        $_SESSION['error'] = "Invalid ID image file type.";
        header("Location: breeder.php");
         exit();
    }

    if (!move_uploaded_file($_FILES["id_image"]["tmp_name"], $id_target_file)) {
        $_SESSION['error'] = "Error while uploading ID image.";
        header("Location: breeder.php");
         exit();
    }

    // Receipt
    $receipt_target_file = $target_dir . basename($_FILES["receipt"]["name"]);
    $receiptFileType = strtolower(pathinfo($receipt_target_file, PATHINFO_EXTENSION));

    // Check if receipt has a valid file type
    $receipt_allowed_extensions = array("jpg", "jpeg", "png");
    if (!in_array($receiptFileType, $receipt_allowed_extensions)) {
        $_SESSION['error'] = "Invalid receipt file type.";
        header("Location: breeder.php");
         exit();
    }

    if (!move_uploaded_file($_FILES["receipt"]["tmp_name"], $receipt_target_file)) {
        $_SESSION['error'] = "Error while uploading receipt.";
        header("Location: breeder.php");
         exit();
    }

// Use a prepared statement to insert breeder data into the database, including the file paths to the uploaded images.
$stmt = $conn->prepare("INSERT INTO user (fname, lname, email, password, user_type, payment, profile_image, id_image, receipt, date_requested) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("sssssssss", $fname, $lname, $email, $hashed_password, $user_type, $payment, $profile_target_file, $id_target_file, $receipt_target_file);

if ($stmt->execute()) {
    // Redirect to another page after successful registration
    $_SESSION['success'] = "Registered! Awaiting admin approval. See your email for updates.";
    header("Location: breeder.php");
    exit();
} else {
    // Registration failed, handle the error and redirect the breeder accordingly.
    $_SESSION['error'] = "Registration failed!";
    header("Location: breeder.php");
    exit();
}

} else {
    // Redirect the breeder to the registration page if the POST data is not set.
    header("Location: breeder.php");
    exit();
}
?>
