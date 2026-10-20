<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'barangay_db';  
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'], $_POST['status'])) {
    $requestId = $_POST['id'];
    $status = $_POST['status'];
    $reason = isset($_POST['reason']) ? $_POST['reason'] : '';

    if ($status == 'approved') {
        $claimDate = $_POST['claim_date'];  
        $query = "UPDATE requests SET status = ?, claim_date = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $status, $claimDate, $requestId);
    } else if ($status == 'rejected') {
        $query = "UPDATE requests SET status = ?, rejection_reason = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $status, $reason, $requestId);
    }

    if ($stmt->execute()) {
        echo "Request status updated successfully.";
    } else {
        echo "Error updating status: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
