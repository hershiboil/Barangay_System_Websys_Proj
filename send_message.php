<?php
session_start();

if (!isset($_SESSION['resident_id'])) {
    die("Access denied.");
}

$resident_ID = $_SESSION['resident_id'];

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'barangay_db'; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $subject = $conn->real_escape_string($_POST["subject"]);
    $message = $conn->real_escape_string($_POST["message"]);

    $sql = "INSERT INTO messages_entry (resident_ID, name, email, subject, message)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $resident_ID, $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "Message sent successfully.";

        $activity = "Sent a message regarding: $subject";
        $logSql = "INSERT INTO activity_log (resident_ID, activity_description, activity_date) VALUES (?, ?, NOW())";
        $logStmt = $conn->prepare($logSql);
        $logStmt->bind_param("is", $resident_ID, $activity);
        $logStmt->execute();
        $logStmt->close();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
