<?php
session_start();

$id = $_GET['id'];

$con = mysqli_connect("localhost", "root", "", "dogbreeder_db");

// Check if the data with the given ID exists
$sql = "SELECT * FROM pending_approval WHERE id='$id'";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    // Pending Approval with the given ID exists, proceed with deletion
    $deleteSql = "DELETE FROM pending_approval WHERE id='$id'";
    $query_run = mysqli_query($con, $deleteSql);

    if ($query_run) {
        // Deletion was successful
        session_start();
        $_SESSION['status'] = "You have successfully rejected!";
        header('location: approval-request.php');
    } else {
        // Something went wrong with the deletion
        echo 'Something went wrong with the deletion.';
    }
} else {
    // Pending Approval with the given ID does not exist
    echo 'Data not found.';
}

mysqli_close($con);

?>
