<?php
include('db_connect.php');
$id = $_POST['id'];
$query = $conn->prepare("DELETE FROM inventory WHERE id = ?");
$query->bind_param("i", $id);
if ($query->execute()) {
    echo 1;
} else {
    echo 0;
}
?>
