<?php

$id = $_GET['id']; 

$host = "localhost";
$username = "root";
$password = "";
$database = "dogbreeder_db";

// Create a connection to the database
$con = mysqli_connect($host, $username, $password, $database);

// Check if the connection is successful
if (!$con) {
    die("Connection to the database failed: " . mysqli_connect_error());
}

// Start a transaction for data consistency
mysqli_begin_transaction($con);

try {
    $sql = "SELECT * FROM pending_approval WHERE id='$id'";
    $result = mysqli_query($con, $sql);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $insertSql = "INSERT INTO breeders (breeder_id, fname, lname, email, password, user_type, payment, profile_image, id_image, receipt) VALUES (
            '" . $row['breeder_id'] . "',
            '" . $row['fname'] . "', 
            '" . $row['lname'] . "',
            '" . $row['email'] . "',
            '" . $row['password'] . "',
            '" . $row['user_type'] . "',
            '" . $row['payment'] . "',
            '" . $row['profile_image'] . "',
            '" . $row['id_image'] . "',
            '" . $row['receipt'] . "'
        )";
        
        mysqli_query($con, $insertSql);

        $deleteSql = "DELETE FROM pending_approval WHERE id='$id'";
        mysqli_query($con, $deleteSql);

        mysqli_commit($con);

        // Start or resume the session.
        session_start();

        // Set the success message in the session variable.
        $_SESSION['success'] = "Request has been successfully approved!";

        // Redirect to the desired page.
        header('Location: approval-request.php');
        exit();
    } else {
        echo "Record with id '$id' not found.";
    }
} catch (Exception $e) {
    // An error occurred, rollback the changes
    mysqli_rollback($con);

    echo 'An error occurred: ' . $e->getMessage();
} finally {
    mysqli_close($con);
}
?>