<?php
$conn = new mysqli("localhost", "root", "", "barangay_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["officialID"])) {
    $officialID = $_POST["officialID"];

    // Default values
    $defaultName = "Official Name";
    $defaultImage = "image";

    $stmt = $conn->prepare("UPDATE barangay_officials SET officialName = ?, imgPath = ? WHERE officialID = ?");
    $stmt->bind_param("ssi", $defaultName, $defaultImage, $officialID);

    if ($stmt->execute()) {
        echo "<script>alert('Official reset to default successfully.'); window.location.href = 'adminDashboard.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href = 'adminDashboard.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
