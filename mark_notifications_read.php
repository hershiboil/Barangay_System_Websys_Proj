<?php
include 'connection.php';
session_start();

if (!isset($_SESSION['resident_ID'])) {
    http_response_code(403);
    exit();
}

$resident_ID = $_SESSION['resident_ID'];
$sql = "UPDATE notifications SET is_read = 1 WHERE resident_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $resident_ID);
$stmt->execute();

echo "success";
?>