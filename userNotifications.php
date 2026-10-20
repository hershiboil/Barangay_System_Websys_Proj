<?php
session_start();
header('Content-Type: application/json');

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'barangay_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die(json_encode(['error' => 'Connection failed']));
}

if (!isset($_SESSION['resident_id'])) {
  echo json_encode(['total' => 0]);
  exit;
}

$residentID = $_SESSION['resident_id'];
$total = 0;

// Count user's file requests with status Approved or Rejected
$sqlRequests = "SELECT COUNT(*) AS count FROM file_requests WHERE resident_ID = ? AND status IN ('Approved', 'Rejected')";
$stmtRequests = $conn->prepare($sqlRequests);
$stmtRequests->bind_param("i", $residentID);
$stmtRequests->execute();
$resultRequests = $stmtRequests->get_result();
$rowRequests = $resultRequests->fetch_assoc();
$total = $rowRequests['count'];

echo json_encode(['total' => $total]);

$conn->close();
