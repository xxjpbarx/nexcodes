<?php
// Database connection
$servername = "localhost";
$username = "u745007485_root";
$password = "Nexpoint2024";
$dbname = "u745007485_nexpoint";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get product ID from the request
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the query to fetch the product details
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the product exists
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        // Return the product details as JSON
        echo json_encode($product);
    } else {
        echo json_encode(['error' => 'Product not found']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'Invalid ID']);
}

// Close the connection
$conn->close();
?>
