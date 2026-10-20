<?php
include 'connection.php'; // makes $conn connection

$title = $_POST['title'] ?? '';
$limit = $_POST['limit'] ?? '';
$description = $_POST['description'] ?? '';

// Simple validation
if (empty($title) || empty($limit)) {
    echo "Missing required fields";
    exit;
}

// Prepared statement to avoid SQL injection
$stmt = $conn->prepare("INSERT INTO positions (title, pos_limit, description, last_modified) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("sis", $title, $limit, $description);

if ($stmt->execute()) {
    echo "success"; // This exact string must match the JS check
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
