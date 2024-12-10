<?php
include('db_connect.php');

if ($_POST['id'] == '') { // New Item
    $query = $conn->prepare("INSERT INTO inventory (name, description, quantity, total, stock_limit) VALUES (?, ?, ?, ?, ?)");
    $query->bind_param("ssiii", $_POST['name'], $_POST['description'], $_POST['quantity'], $_POST['total'], $_POST['stock_limit']);
} else { // Update Item
    $query = $conn->prepare("UPDATE inventory SET name = ?, description = ?, quantity = ?, total = ?, stock_limit = ? WHERE id = ?");
    $query->bind_param("ssiiii", $_POST['name'], $_POST['description'], $_POST['quantity'], $_POST['total'], $_POST['stock_limit'], $_POST['id']);
}

if ($query->execute()) {
    echo 1;
} else {
    echo "Error: " . $conn->error;
}
?>
