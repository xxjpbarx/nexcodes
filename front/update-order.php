<?php
include('../db_connect.php'); // Make sure to adjust the path if needed

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id']; 
    $qty = $_POST['qty'];
    $status = $_POST['status'];
    
    // Validate input data
    if (empty($id) || empty($qty) || empty($status)) {
        echo json_encode(['success' => false, 'message' => 'Invalid input.']);
        exit;
    }

    // Prepare the SQL query to update the order
    $sql = "UPDATE tbl_order SET qty = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('isi', $qty, $status, $id);
    
    if ($stmt->execute()) {
        // Update successful
        echo json_encode(['success' => true, 'message' => 'Order updated successfully.']);
    } else {
        // Update failed
        echo json_encode(['success' => false, 'message' => 'Failed to update order.']);
    }

    $stmt->close();
    $conn->close();
}
?>
