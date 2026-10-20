<?php
// db connection
$conn = new mysqli("localhost", "root", "", "barangay_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT purok, COUNT(*) as total FROM residents_info GROUP BY purok";
$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
