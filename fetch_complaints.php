<?php
$host = "localhost";
$db = "barangay_db";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed");
}

$complaintId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT id, type, description, created_at FROM complaints WHERE id = $complaintId LIMIT 1";
$result = $conn->query($sql);

if ($row = $result->fetch_assoc()) {
    $files = [];
    $fileResult = $conn->query("SELECT file_path FROM complaint_files WHERE complaint_id = $complaintId");
    while ($fileRow = $fileResult->fetch_assoc()) {
        $files[] = $fileRow['file_path'];
    }

    $row['files'] = $files;
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'Complaint not found.']);
}
?>
