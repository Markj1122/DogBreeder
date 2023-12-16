<?php

$id = $_GET['id'];

// Replace the database credentials with your own
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
    // Retrieve the pending booking details
    $sql = "SELECT * FROM subscribers WHERE id='$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    // Insert the booking into the bookings table
    $insertSql = "INSERT INTO breeders (id, fname, lname, email, password, user_type, payment, profile_image, id_image, receipt) VALUES ('" . $row['id'] . "', '" . $row['fname'] . "', '" . $row['lname'] . "', '" . $row['email'] . "', '" . $row['password'] . "', '" . $row['user_type'] . "', '" . $row['payment'] . "', '" . $row['profile_image'] . "', '" . $row['id_image'] . "', '" . $row['receipt'] . "')";
    mysqli_query($con, $insertSql);

    // Delete the pending booking from the pending_bookings table
    $deleteSql1 = "DELETE FROM subscribers WHERE id='$id'";
    mysqli_query($con, $deleteSql);

    // Commit the changes to both databases
    mysqli_commit($con);

    // Start or resume the session.
    session_start();

    // Set the success message in the session variable.
    $_SESSION['success'] = "Request has been successfully approved!";

    // Redirect to the desired page.
    header('Location: subscriptions.php');
    exit();
} catch (Exception $e) {
    // An error occurred, rollback the changes
    mysqli_rollback($con);

    mysqli_close($con);

    echo 'An error occurred: ' . $e->getMessage();
}
?>
