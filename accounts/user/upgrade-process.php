<?php
include ('../../page/router/config.php');

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['fname']) && isset($_POST['lname']) 
    && isset($_POST['new_email']) && isset($_POST['user_type']) 
    && isset($_POST['payment']) && isset($_FILES['receipt']) 
    && isset($_FILES['id_image'])) {

    $fname = validate($_POST['fname']);
    $lname = validate($_POST['lname']);
    $new_email = validate($_POST['new_email']);
    $user_type = validate($_POST['user_type']);
    $payment = validate($_POST['payment']);

    // Handle the uploaded receipt image
    $target_dir_receipt = "../../public/src/uploads/breeder/"; // Specify the directory for receipt images.
    $target_file_receipt = $target_dir_receipt . basename($_FILES["receipt"]["name"]);
    $receiptFileType = strtolower(pathinfo($target_file_receipt, PATHINFO_EXTENSION));

    // Check if the uploaded file is an image
    $check_receipt = getimagesize($_FILES["receipt"]["tmp_name"]);
    if ($check_receipt === false) {
        $_SESSION['error'] = "Invalid receipt image file.";
        header("Location: upgrade-account.php");
        exit(); 
    }

    // Check if the file type is allowed (e.g., jpg, jpeg, png)
    $allowed_extensions_receipt = array("jpg", "jpeg", "png");
    if (!in_array($receiptFileType, $allowed_extensions_receipt)) {
        $_SESSION['error'] = "Invalid receipt file type";
        header("Location: upgrade-account.php");
        exit(); 
    }

    // Move the uploaded receipt file to the specified directory
    if (move_uploaded_file($_FILES["receipt"]["tmp_name"], $target_file_receipt)) {
        // Handle the uploaded ID image
        $target_dir_id = "../../public/src/uploads/breeder/"; // Specify the directory for ID images.
        $target_file_id = $target_dir_id . basename($_FILES["id_image"]["name"]);
        $idFileType = strtolower(pathinfo($target_file_id, PATHINFO_EXTENSION));

        // Check if the uploaded file is an image
        $check_id = getimagesize($_FILES["id_image"]["tmp_name"]);
        if ($check_id === false) {
            $_SESSION['error'] = "Invalid ID image file.";
            header("Location: upgrade-account.php");
            exit(); 
        }

        // Check if the file type is allowed (e.g., jpg, jpeg, png)
        $allowed_extensions_id = array("jpg", "jpeg", "png");
        if (!in_array($idFileType, $allowed_extensions_id)) {
            $_SESSION['error'] = "Invalid ID file type";
            header("Location: upgrade-account.php");
            exit(); 
        }

        // Move the uploaded ID file to the specified directory
        if (move_uploaded_file($_FILES["id_image"]["tmp_name"], $target_file_id)) {
            // Fetch password and profile_image from the users table
            $stmt_fetch = $conn->prepare("SELECT password, profile_image FROM users WHERE email = ?");
            if (!$stmt_fetch) {
                die("Error in SQL statement: " . $conn->error);
            }

            $bindResult_fetch = $stmt_fetch->bind_param("s", $new_email);
            if (!$bindResult_fetch) {
                die("Error binding parameters: " . $stmt_fetch->error);
            }

            if ($stmt_fetch->execute()) {
                $stmt_fetch->store_result();
                $stmt_fetch->bind_result($password, $profile_image);
                $stmt_fetch->fetch();

                // Use a prepared statement to insert user data into the subscriptions table, including the file paths for receipt and ID image.
                $stmt_insert = $conn->prepare("INSERT INTO subscriptions (fname, lname, email, password, user_type, payment, profile_image, id_image, receipt, date_requested) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
                if (!$stmt_insert) {
                    die("Error in SQL statement: " . $conn->error);
                }
                $bindResult_insert = $stmt_insert->bind_param("sssssssss", $fname, $lname, $new_email, $password, $user_type, $payment, $profile_image, $target_file_id, $target_file_receipt);
                if (!$bindResult_insert) {
                    die("Error binding parameters: " . $stmt_insert->error);
                }

                if ($stmt_insert->execute()) {
                    $_SESSION['success'] = "Upgrade request submitted successfully!";
                    header("Location: upgrade-account.php");
                    exit();                 
                } else {
                    // Upgrade request failed, handle the error and redirect the user accordingly.
                    $_SESSION['error'] = "Upgrade request failed";
                    header("Location: upgrade-account.php");
                    exit(); 
                }
            } else {
                // Handle the error when fetching password and profile_image
                $_SESSION['error'] = "Error fetching user data";
                header("Location: upgrade-account.php");
                exit();
            }
        } else {
            // Handle errors related to ID image upload.
            $_SESSION['error'] = "Error while uploading ID image";
            header("Location: upgrade-account.php");
            exit(); 
        }
    } else {
        // Handle errors related to receipt image upload.
        $_SESSION['error'] = "Error while uploading receipt image";
        header("Location: upgrade-account.php");
        exit(); 
    }
} else {
    // Redirect the user to the upgrade page if the POST data is not set.
    header("Location: upgrade-account.php");
    exit();
}
?>
