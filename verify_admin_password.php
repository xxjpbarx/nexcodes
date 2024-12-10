<?php

include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    $enteredPassword = $_POST['password'];

    // Fetch the hashed password for the admin user from the database
    $sql = "SELECT password FROM users WHERE username = 'admin' AND type = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        $adminPasswordHash = $admin['password'];

        // Verify the entered password with the stored hashed password
        if (md5($enteredPassword) === $adminPasswordHash) {
            echo "success"; // Password matched
        } else {
            echo "failure"; // Password did not match
        }
    } else {
        echo "failure"; // Admin user not found
    }
    $conn->close();
} else {
    echo "Invalid request";
}
?>
