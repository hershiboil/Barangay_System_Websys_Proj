<?php
// deleteAccount.php
header('Content-Type: application/json');

include 'frontpageConnect.php'; // Adjust path if necessary

$response = ['status' => 'error', 'message' => 'An unknown error occurred.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $residentId = $_POST['resident_id'] ?? null;

    if (empty($residentId) || !is_numeric($residentId) || (int)$residentId <= 0) {
        $response['message'] = 'Invalid or missing Resident ID for deletion.';
        echo json_encode($response);
        exit();
    }

    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("DELETE FROM accounts WHERE resident_id = ?");
        if ($stmt === false) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        $stmt->bind_param("i", $residentId);

        if (!$stmt->execute()) {
            throw new Exception("Failed to delete account: " . $stmt->error);
        }

        if ($stmt->affected_rows > 0) {
            $response['status'] = 'success';
            $response['message'] = 'Account deleted successfully!';
        } else {
            $response['message'] = 'Account not found or already deleted.';
            $response['status'] = 'success'; // Treat as success if it just wasn't there
        }

        $stmt->close();
        $conn->commit();

    } catch (Exception $e) {
        $conn->rollback();
        $response['message'] = 'Database operation failed: ' . $e->getMessage();
        error_log("Delete Account Error: " . $e->getMessage());
    }
} else {
    $response['message'] = 'Invalid request method. Only POST requests are allowed.';
}

if ($conn && !$conn->connect_error) { // This check prevents trying to close an invalid connection
    $conn->close();
}
echo json_encode($response);
// No closing ?> tag is good practice for files that only contain PHP logic