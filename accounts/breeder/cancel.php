<?php
session_start();

$id = $_GET['id'];

$con = mysqli_connect("localhost", "root", "", "dogbreeder_db");

// Check if the data with the given ID exists
$sql = "SELECT * FROM purchase WHERE purchase_id='$id'";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    // Pending Approval with the given ID exists, proceed with update and deletion
    $updateSql = "UPDATE purchase SET purchase_status='Cancelled' WHERE purchase_id='$id'";
    $query_update = mysqli_query($con, $updateSql);

    if ($query_update) 
    {
        header('location: pending-purchase.php');
    } 
    else 
    {
        echo 'Something went wrong with the deletion.';
    }
    
} else {
    // Pending Approval with the given ID does not exist
    echo 'Data not found.';
}

mysqli_close($con);
?>
