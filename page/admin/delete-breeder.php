<?php
session_start();

$breederId = $_GET['breeder_id'];

$con = mysqli_connect("localhost", "root", "", "dogbreeder_db");

// Check if the user with the given ID exists
$sql = "SELECT * FROM breeders WHERE breeder_id='$breederId'";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    // Breeder with the given ID exists, proceed with deletion
    $deleteSql = "DELETE FROM breeders WHERE breeder_id='$breederId'";
    $query_run = mysqli_query($con, $deleteSql);

    if ($query_run) {
        // Deletion was successful
        session_start();
        $_SESSION['status'] = "Breeder has been successfully deleted!";
        header('location: breeder-list.php');
    } else {
        // Something went wrong with the deletion
        echo 'Something went wrong with the deletion.';
    }
} else {
    // Breeder with the given ID does not exist
    echo 'Breeder not found.';
}

mysqli_close($con);

?>
