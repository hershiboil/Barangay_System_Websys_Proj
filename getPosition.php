<?php
include 'connection.php'; // make sure this connects using mysqli $conn

$result = $conn->query("SELECT * FROM positions ORDER BY id ASC");

$rows = [];

while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

echo json_encode($rows);

$conn->close();
?>
