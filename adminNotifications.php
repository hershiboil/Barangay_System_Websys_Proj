<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'barangay_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$total = 0;

// Count messages
$sqlMessages = "SELECT COUNT(*) AS count FROM messages_entry";
$resultMessages = $conn->query($sqlMessages);
$rowMessages = $resultMessages->fetch_assoc();
$total += $rowMessages['count'];

// Count complaints
$sqlComplaints = "SELECT COUNT(*) AS count FROM complaints_entry";
$resultComplaints = $conn->query($sqlComplaints);
$rowComplaints = $resultComplaints->fetch_assoc();
$total += $rowComplaints['count'];

// Count requests
$sqlRequests = "SELECT COUNT(*) AS count FROM file_requests";
$resultRequests = $conn->query($sqlRequests);
$rowRequests = $resultRequests->fetch_assoc();
$total += $rowRequests['count'];


echo json_encode(['total' => $total]);
$conn->close();
?>