<?php
include 'db_connect.php'; // Ensure your database connection is included

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the ID is set and is a valid number
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        // Get the ID of the submission to delete
        $id = intval($_POST['id']);

        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("DELETE FROM contact_submissions WHERE id = ?");
        $stmt->bind_param("i", $id);

        // Execute the deletion
        if ($stmt->execute()) {
            // Redirect back with a success message
            header("Location: index.php?page=support");
            exit();
        } else {
            // Redirect back with an error message
            header("Location: index.php?page=support");
            exit();
        }

        // Close the statement
        $stmt->close();
    } else {
        // Redirect back with an error message if ID is invalid
        header("Location: index.php?page=support");
        exit();
    }
}

// Close the database connection
$conn->close();
?>
