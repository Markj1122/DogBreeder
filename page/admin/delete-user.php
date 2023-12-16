<?php
session_start();

$userId = $_GET['user_id'];

$con = mysqli_connect("localhost", "root", "", "dogbreeder_db");

// Check if the user with the given ID exists
$sql = "SELECT * FROM tbl_users WHERE user_id='$userId'";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    // User with the given ID exists, proceed with deletion
    $deleteSql = "DELETE FROM tbl_users WHERE user_id='$userId'";
    $query_run = mysqli_query($con, $deleteSql);

    if ($query_run) {
        // Deletion was successful
        session_start();
        $_SESSION['status'] = "User has been successfully deleted!";
        header('location: user-list.php');
    } else {
        // Something went wrong with the deletion
        echo 'Something went wrong with the deletion.';
    }
} else {
    // User with the given ID does not exist
    echo 'User not found.';
}

mysqli_close($con);

?>
