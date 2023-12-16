<?php
session_start();

$id = $_GET['id'];

$con = mysqli_connect("localhost", "root", "", "dogbreeder_db");

// Check if the user with the given ID exists
$sql = "SELECT * FROM customers WHERE id='$id'";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    // User with the given ID exists, proceed with deletion
    $deleteSql = "DELETE FROM customers WHERE id='$id'";
    $query_run = mysqli_query($con, $deleteSql);

    if ($query_run) {
        // Deletion was successful
        session_start();
        $_SESSION['succuss'] = "Customer's data has been deleted!";
        header('location: customers.php');
    } else {
        // Something went wrong with the deletion
        echo 'Something went wrong with the deletion.';
    }
} else {
    // User with the given ID does not exist
    echo 'Customer not found.';
}

mysqli_close($con);

?>
