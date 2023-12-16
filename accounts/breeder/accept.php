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
    $sql = "SELECT * FROM purchase WHERE purchase_id='$id'";
    $result = mysqli_query($con, $sql);
    
    
    if ($row = mysqli_fetch_assoc($result)) {
        $insertSql = "UPDATE purchase set purchase_status = 'Accepted' WHERE purchase_id = $id";
    
        mysqli_query($con, $insertSql);

        mysqli_commit($con);

        // Start or resume the session.
        session_start();

        // Set the success message in the session variable.
        $_SESSION['success'] = "Purchase has been accepted!";

        // Redirect to the desired page.
        header('Location: pending-purchase.php');
        exit();
    } 
    else 
    {
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