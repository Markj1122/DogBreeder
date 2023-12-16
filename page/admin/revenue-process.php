<?php
// Include the database connection
include('../../page/router/config.php');

// Check if the form is submitted
if (isset($_POST['add_revenue'])) {
    // Get form data and sanitize it (to prevent SQL injection)
    $revenue = isset($_POST['revenue']) ? trim($_POST['revenue']) : '';
    $tax = isset($_POST['tax']) ? trim($_POST['tax']) : '';

    // Prepare the SQL statement for inserting a new post using prepared statements
    $sql = "INSERT INTO revenues (revenue, tax, added_at) VALUES (?, ?, NOW()) ";

    $stmt = $conn->prepare($sql);

    // Check if the prepare statement was successful
    if ($stmt) {
        // Update the bind_param call to match the number of placeholders
        $stmt->bind_param("ss", $revenue, $tax);

        // Execute the statement
        $success = $stmt->execute();

        // Close the statement
        $stmt->close();

        // Close the database connection
        $conn->close();

        if ($success) {
            // All insertions were successful
            session_start();
            $_SESSION['success'] = "Revenue added successfully!.";
            header("Location: revenues.php");
            exit;
        } else {
            echo "Error inserting revenue: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>
