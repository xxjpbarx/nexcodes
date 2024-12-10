<?php
include "db_connect.php";

header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"));

$username = $data->username;
$password = $data->password;

// Database connection
$mysqli = new mysqli("localhost", "root", "", "nexpoint");
if ($mysqli->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

// Query to check if user exists and is a customer
$sql = "SELECT * FROM users WHERE username = ? AND type = 3";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password'])) {
        echo json_encode(['success' => true, 'user_type' => $row['type']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Incorrect password']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'User not found or not a customer']);
}

$stmt->close();
$mysqli->close();
?>
