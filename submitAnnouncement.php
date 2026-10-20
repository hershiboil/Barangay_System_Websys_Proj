<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "barangay_db";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$content = isset($_POST['content']) ? trim($_POST['content']) : '';

if (empty($title) || empty($content)) {
    die("Error: Both title and content are required.");
}

$dateToday = date('Y-m-d');

$sql = "INSERT INTO announcement (title, content, dateToday) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $title, $content, $dateToday);

if ($stmt->execute()) {
    header("Location: adminAnnouncement.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
