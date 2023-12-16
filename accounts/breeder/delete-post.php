<?php

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Ensure that the 'id' parameter is set and is a valid number
    header("Location: my-post.php");
    exit();
}

$id = $_GET['id'];
$id = intval($id); // Cast the value to an integer to prevent SQL injection

$con = mysqli_connect("localhost", "root", "", "dogbreeder_db");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the customer record with the given ID exists
$sql = "SELECT id FROM post_feed WHERE id = $id";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    // The customer record exists, proceed with deletion
    $deleteSql = "DELETE FROM post_feed WHERE id = $id";
    $query_run = mysqli_query($con, $deleteSql);

    if ($query_run) {
        // Deletion was successful
        $_SESSION['success'] = "Your post has been deleted!";
        header('location: my-post.php');
    } else {
        // Something went wrong with the deletion
        $_SESSION['error'] = "Something went wrong with the deletion.";
        header('location: my-post.php');
    }
} else {
    // Customer record not found
    $_SESSION['error'] = "Post data not found.";
    header('location: my-post.php');
}

mysqli_close($con);

header('Location: my-post.php');
?>

