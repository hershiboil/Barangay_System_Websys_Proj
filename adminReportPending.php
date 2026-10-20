<?php
$conn = new mysqli("localhost", "root", "", "barangay_db");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['id']) && isset($_POST['reject'])) {
        $id = intval($_POST['id']);
        $status = 'rejected';

        $stmt = $conn->prepare("UPDATE complaints_entry SET report_status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);

        if ($stmt->execute()) {
            header("Location: adminReports.php");
            exit;
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    }

    elseif (isset($_POST['submit_accomplish']) && isset($_POST['accomplish_id']) && isset($_POST['reason'])) {
        $id = intval($_POST['accomplish_id']);
        $reason = trim($_POST['reason']);
        $status = 'accomplished';

        $stmt = $conn->prepare("UPDATE complaints_entry SET report_status = ?, solution = ? WHERE id = ?");
        $stmt->bind_param("ssi", $status, $reason, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Complaint solved successfully.'); window.location.href='adminReports.php';</script>";
            exit;
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    }

    // If reject button clicked without reason modal (fallback)
    elseif (isset($_POST['accomplish']) && isset($_POST['id'])) {
        echo "<script>alert('Please provide a solution.'); window.location.href='adminReports.php';</script>";
        exit;
    }

} else {
    echo "Invalid request.";
}

$conn->close();
?>
