<?php
$conn = new mysqli("localhost", "root", "", "barangay_db");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // APPROVE action
    if (isset($_POST['id']) && isset($_POST['approve'])) {
        $id = intval($_POST['id']);
        $status = 'Approved';

        $stmt = $conn->prepare("UPDATE file_requests SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);

        if ($stmt->execute()) {
            header("Location: adminResidency.php");
            exit;
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    }

    // REJECT action with reason from modal
    elseif (isset($_POST['submit_reject']) && isset($_POST['reject_id']) && isset($_POST['reason'])) {
        $id = intval($_POST['reject_id']);
        $reason = trim($_POST['reason']);
        $status = 'Rejected';

        $stmt = $conn->prepare("UPDATE file_requests SET status = ?, rejection_reason = ? WHERE id = ?");
        $stmt->bind_param("ssi", $status, $reason, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Request rejected successfully.'); window.location.href='adminResidency.php';</script>";
            exit;
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    }

    // If reject button clicked without reason modal (fallback)
    elseif (isset($_POST['reject']) && isset($_POST['id'])) {
        echo "<script>alert('Please provide a rejection reason.'); window.location.href='adminResidency.php';</script>";
        exit;
    }

} else {
    echo "Invalid request.";
}

$conn->close();
?>
