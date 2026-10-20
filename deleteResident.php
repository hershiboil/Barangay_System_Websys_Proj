<?php
include 'connection.php'; // Your database connection file

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $residentID = $_POST['resident_ID'] ?? '';

    if (empty($residentID)) {
        echo json_encode(['success' => false, 'message' => 'Missing resident ID.']);
        exit();
    }

    // Prepare and execute the DELETE statement
    $sql = "DELETE FROM residents_info WHERE resident_ID = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $residentID); // Assuming resident_ID is a string
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Resident not found or already deleted.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => $conn->error]);
    }
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>