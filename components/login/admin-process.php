    <?php
    session_start();
    include "connection.php";

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (
        isset($_POST['fname']) && isset($_POST['lname']) 
        && isset($_POST['email']) && isset($_POST['password']) 
        && isset($_POST['user_type']) && isset($_FILES['profile_image'])
    ) {
        $fname = validate($_POST['fname']); 
        $lname = validate($_POST['lname']);
        $email = validate($_POST['email']);
        $password = validate($_POST['password']);
        $user_type = validate($_POST['user_type']);
          
        
        // Additional validation for email format, password complexity, etc. can be added here.

        // Hash the password (you may use a stronger password hashing method than md5).
        $hashed_password = md5($password);

        // Upload and handle the profile image for users
        $target_dir = "../../public/src/uploads/admin/";
        
        // Profile image
        $profile_target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
        $profile_imageFileType = strtolower(pathinfo($profile_target_file, PATHINFO_EXTENSION));

        // Check if profile_image has a valid file type
        $profile_allowed_extensions = array("jpg", "jpeg", "png");
        if (!in_array($profile_imageFileType, $profile_allowed_extensions)) {
            header("Location: admin.php?error=Invalid profile image file type");
            exit();
        }
        
        if (!move_uploaded_file($_FILES["profile_image"]["tmp_name"], $profile_target_file)) {
            header("Location: admin.php?error=Error uploading profile image");
            exit();
        }

        // Use a prepared statement to insert admin data into the database, including the file path to the uploaded image and id_image.
        $stmt = $conn->prepare("INSERT INTO `admin` (fname, lname, email, password, user_type, profile_image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $fname, $lname, $email, $hashed_password, $user_type, $profile_target_file); // Fixed

        if ($stmt->execute()) {
            // Redirect to another page after successful registration
            header("Location: admin.php?success=Registered successfully! Please check your email for confirmation notice.");
            exit();
        } else {
            // Registration failed, handle the error and redirect the admin accordingly.
            header("Location: admin.php?error=Registration failed");
            exit();
        }
    } else {
        // Redirect the admin to the registration page if the POST data is not set.
        header("Location: admin.php");
        exit();
    }

    ?>
