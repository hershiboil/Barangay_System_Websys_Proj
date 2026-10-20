<?php
session_start();
$resident_ID = $_SESSION['resident_ID'] ?? null;

if (!$resident_ID) {
    header("Location: frontpage.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "barangay_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$current_password = trim($_POST['current_password']);
$new_password = trim($_POST['new_password']);

$sql = "SELECT password FROM users WHERE resident_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $resident_ID);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($stored_password);
$stmt->fetch();

if ($stmt->num_rows === 1) {
    if ($current_password === $stored_password) {
        $update_sql = "UPDATE users SET password = ? WHERE resident_ID = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("si", $new_password, $resident_ID);

        if ($update_stmt->execute()) {
            header("Location: userSettings.php?success=1");
            exit();
        } else {
            header("Location: userSettings.php?error=Update failed.");
            exit();
        }
    } else {
        header("Location: userSettings.php?error=Incorrect current password.");
        exit();
    }
} else {
    header("Location: userSettings.php?error=User not found.");
    exit();
}

$conn->close();
?>
