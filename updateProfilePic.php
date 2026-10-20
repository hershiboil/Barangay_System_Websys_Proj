<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['resident_ID'])) {
    header("Location: frontpage.php");
    exit();
}

$resident_ID = $_SESSION['resident_ID'];

if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
    $fileTmp = $_FILES['profile_photo']['tmp_name'];
    $fileName = basename($_FILES['profile_photo']['name']);
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
    if (!in_array($fileExt, $allowed)) {
        echo "<script>alert('Invalid file type.'); window.location='userProfile.php';</script>";
        exit();
    }
    
    $newFileName = 'profile_' . $resident_ID . '_' . time() . '.' . $fileExt;
    $targetPath = 'img/' . $newFileName;

    if (move_uploaded_file($fileTmp, $targetPath)) {
        // Update the database
        $stmt = $conn->prepare("UPDATE residents_info SET profile_photo = ? WHERE resident_ID = ?");
        $stmt->bind_param("si", $newFileName, $resident_ID);
        $stmt->execute();
        $stmt->close();

        $_SESSION['profile_photo'] = $newFileName;
        
        echo "<script>window.location='userProfile.php';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to upload image.'); window.location='userProfile.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('No file uploaded.'); window.location='userProfile.php';</script>";
    exit();
}
?>