<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Establish a database connection
    $mysqli = new mysqli("localhost", "root", "", "dogbreeder_db");

    // Check for database connection errors
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $status = $_POST["status"];
    $id = $_POST["id"]; // Retrieve 'id' from the form

    // Update the 'status' in the database using prepared statements
    $updateSql = "UPDATE customers SET `status` = ? WHERE id = ?";

    if ($stmt = $mysqli->prepare($updateSql)) {
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        $stmt->close();
        // Set a success message
        $_SESSION['success'] = "Status updated successfully.";
    }

    // Close the database connection
    $mysqli->close();
}

// Redirect back to the previous page or do any other necessary action
header('location: customers.php');

?>
