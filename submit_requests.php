<?php
session_start();
include 'connection.php'; 

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$resident_ID = $_SESSION['resident_id'] ?? null;
if (!$resident_ID) {
    die("Resident ID not found in session.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['requestType'])) {
    $requestType = $_POST['requestType'];
    $activity = '';
    
    if ($requestType === 'businessPermit') {

        $businessName = $_POST['business_name'] ?? '';
        $businessLocation = $_POST['business_location'] ?? '';

        $sql = "INSERT INTO file_requests (resident_ID, request_type, business_name, business_location, request_date, status) VALUES (?, ?, ?, ?, NOW(), 'pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $resident_ID, $requestType, $businessName, $businessLocation);
        $activity = "Requested business permit for $businessName at $businessLocation";
    } else {
        $purpose = $_POST['purpose'] ?? '';

        $sql = "INSERT INTO file_requests (resident_ID, request_type, purpose, request_date, status) VALUES (?, ?, ?, NOW(), 'pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $resident_ID, $requestType, $purpose);
        $activity = "Requested $requestType certificate for reason: $purpose";
    }

    if ($stmt->execute()) {
        echo "Request submitted successfully.";
        
        $insertedRequestID = $stmt->insert_id;

        // ✅ Activity log
        $logQuery = "INSERT INTO activity_log (resident_ID, activity_description, activity_date, request_ID) VALUES (?, ?, NOW(), ?)";
        $logStmt = $conn->prepare($logQuery);
        $logStmt->bind_param("isi", $resident_ID, $activity, $insertedRequestID);
        $logStmt->execute();
        $logStmt->close();

        // ✅ Notification (Step 2)
        $notif_message = "Your request for " . htmlspecialchars($requestType) . " has been submitted successfully.";
        $notif_sql = "INSERT INTO notifications (resident_ID, message) VALUES (?, ?)";
        $notif_stmt = $conn->prepare($notif_sql);
        $notif_stmt->bind_param("is", $resident_ID, $notif_message);
        $notif_stmt->execute();
        $notif_stmt->close();

    } else {
        echo "Error submitting request: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
