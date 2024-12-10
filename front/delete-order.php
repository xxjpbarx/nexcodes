<?php
include('db_connect.php');  // Ensure database connection

// Get the POST data
$data = json_decode(file_get_contents("php://input"), true);
$orderId = $data['id'];  // Get the order ID to delete

// Check if ID is valid
if ($orderId) {
    // SQL query to delete the order
    $sql = "DELETE FROM tbl_order WHERE id = $orderId";
    
    // Execute the query and return success/failure response
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Error deleting order"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid order ID"]);
}

mysqli_close($conn);
?>
