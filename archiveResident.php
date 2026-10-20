<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'connection.php'; // Adjust this path if needed

if (isset($_GET['id'])) {
    $residentID = $_GET['id'];

    // Prepare statement to avoid SQL injection
    $sql = "UPDATE residents SET resident_status = 'Archived' WHERE resident_ID = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $residentID);

    if ($stmt->execute()) {
        header("Location: allResidents.php?msg=Resident+archived+successfully");
        exit();
    } else {
        die("Execution failed: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
} else {
    die("No resident ID specified.");
}
?>
