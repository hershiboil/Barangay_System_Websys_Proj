<?php
include 'connection.php';

$id = $_POST['id'];

$stmt = $conn->prepare("DELETE FROM positions WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}

$stmt->close();
$conn->close();
?>
