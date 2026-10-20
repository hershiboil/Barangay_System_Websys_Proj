<?php
session_start();

$host = "localhost";
$db = "barangay_db"; 
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure session contains resident_ID
if (!isset($_SESSION['resident_ID'])) {
    echo "Unauthorized. Please log in.";
    exit();
}

$resident_ID = $_SESSION['resident_ID'];

// Validate and sanitize inputs
$type = $_POST['complaintType'] ?? '';
$other = $_POST['otherComplaint'] ?? '';
$rawDesc = $_POST['description'] ?? '';
$allowed_tags = '<b><i><u>';
$desc = strip_tags($rawDesc, $allowed_tags);
$finalType = ($type === 'Others') ? $other : $type;

// Insert complaint
$sql = "INSERT INTO complaints_entry (resident_ID, type, description, created_at) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $resident_ID, $finalType, $desc);

if ($stmt->execute()) {
    $complaint_id = $conn->insert_id;

    // ✅ Insert activity log
    $activity = "Submitted a complaint: $finalType";
    $logQuery = "INSERT INTO activity_log (resident_ID, activity_description, activity_date) VALUES (?, ?, NOW())";
    $logStmt = $conn->prepare($logQuery);
    $logStmt->bind_param("is", $resident_ID, $activity);
    $logStmt->execute();
    $logStmt->close();

    // ✅ Insert notification (Step 2)
    $notif_message = "Your complaint of type \"$finalType\" has been submitted successfully.";
    $notif_sql = "INSERT INTO notifications (resident_ID, message) VALUES (?, ?)";
    $notif_stmt = $conn->prepare($notif_sql);
    $notif_stmt->bind_param("is", $resident_ID, $notif_message);
    $notif_stmt->execute();
    $notif_stmt->close();

    // Handle file uploads
    if (!empty($_FILES['files']['name'][0])) {
        foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
            $filename = basename($_FILES['files']['name'][$key]);
            $targetDir = "uploads/";
            $safeFilename = time() . "_" . preg_replace("/[^A-Za-z0-9_\.-]/", '_', $filename);
            $filepath = $targetDir . $safeFilename;

            if (move_uploaded_file($tmp_name, $filepath)) {
                $fileStmt = $conn->prepare("INSERT INTO complaint_files (complaint_id, file_path) VALUES (?, ?)");
                $fileStmt->bind_param("is", $complaint_id, $filepath);
                $fileStmt->execute();
                $fileStmt->close();
            }
        }
    }

    echo "success";
} else {
    echo "Error submitting complaint: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
