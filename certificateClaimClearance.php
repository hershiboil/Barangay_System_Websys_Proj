<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_claim_date'])) {
    $conn = new mysqli("localhost", "root", "", "barangay_db");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $request_id = $_POST['request_id'];
    $claim_date = $_POST['claim_date'];

    // Update both claimed_date and status
    $stmt = $conn->prepare("UPDATE file_requests SET claim_date = ?, status = 'Claimed' WHERE id = ?");
    $stmt->bind_param("si", $claim_date, $request_id);

    if ($stmt->execute()) {
        echo "<script>alert('Claim date and status updated successfully!'); window.location.href='adminClearance.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
