<?php
session_start();
include "connection.php";

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Initialize login attempt count and timestamp
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['last_login_attempt'] = 0;
}

// Check if there have been too many login attempts
if ($_SESSION['login_attempts'] >= 3 && (time() - $_SESSION['last_login_attempt']) < 120) { // 180 seconds = 3 minutes
    header("Location: ../login/index.php");
    exit();
}

if (isset($_POST['username_or_email']) && isset($_POST['password'])) {
    $username_or_email = validate($_POST['username_or_email']);
    $password = validate($_POST['password']);

    // Update the last login attempt timestamp
    $_SESSION['last_login_attempt'] = time();

    if (empty($username_or_email) || empty($password)) {
        $_SESSION['error'] = "Credentials are required!";
        header("Location: ../login/index.php");
        exit();    
    } else {
        // Hash the password
        $password = md5($password);

        $redirect_page = '';
        $stmt = $conn->prepare("SELECT * FROM user WHERE user_email = ? AND user_password = ?");
        $stmt->bind_param("ss", $username_or_email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
                
        if ($result->num_rows === 1)
        {
            $row = $result->fetch_assoc();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_type'] = $row['user_role'];
                        
            //if role type is customer
            if($row['user_role'] == "Customer")
            {
                $redirect_page = '../../accounts/user/home.php';   
            }
            //if role type is breeder
            if($row['user_role'] == "Breeder")
            {
                $redirect_page = '../../accounts/breeder/home.php';   
            }
        }
        else 
        {
            // Handle an invalid ID or out-of-range ID
            $_SESSION['error'] = "Invalid User ID!" .$result->num_rows ;
            
            header("Location: ../login/index.php");
            exit();
        }
    
        // Check if the input is an email or username
        if (filter_var($username_or_email, FILTER_VALIDATE_EMAIL)) {
            $whereClause = "user_email='$username_or_email'";
        } 
        // Query the database based on the selected table and email/username
        $sql = "SELECT * FROM user WHERE $whereClause AND user_password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            // Reset login attempt count on successful login
            $_SESSION['login_attempts'] = 0;

            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_email'] = $row['user_email'];
            $_SESSION['user_firstname'] = $row['user_firstname'];
            header("Location: $redirect_page");
            exit();
        } else {
            // Increment login attempt count on failed login
            $_SESSION['login_attempts']++;

            $_SESSION['error'] = "Credentials not found!";
            header("Location: ../login/index.php");
            exit();   
            
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>
