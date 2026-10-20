<?php
$conn = new mysqli("localhost", "root", "", "barangay_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $officialID = $_POST['officialID'];
    $newName = $_POST['newName'];
    $uploadOk = 1;
    $newImagePath = "";

    // Check if a new image was uploaded
    if (!empty($_FILES["newImage"]["name"])) {
        $targetFile = ($_FILES["newImage"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["newImage"]["tmp_name"]);
        if ($check === false) {
            echo "Error: File is not an image.<br>";
            $uploadOk = 0;
        }

        // Check file size (adjust as needed)
        if ($_FILES["newImage"]["size"] > 500000) {
            echo "Error: Sorry, your file is too large.<br>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "Error: Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
            $uploadOk = 0;
        }

        // If everything is ok, try to upload file
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["newImage"]["tmp_name"], $targetFile)) {
                $newImagePath = $targetFile;
            } else {
                echo "Error: Sorry, there was an error uploading your file.<br>";
                $uploadOk = 0;
            }
        }

        
    }

    // Prepare the update query
    $sql = "UPDATE barangay_officials SET officialName = ?";
    if (!empty($newImagePath)) {
        $sql .= ", imgPath = ?";
    }
    $sql .= " WHERE officialID = ?";

    $stmt = $conn->prepare($sql);

    if (!empty($newImagePath)) {
        $stmt->bind_param("ssi", $newName, $newImagePath, $officialID);
    } else {
        $stmt->bind_param("si", $newName, $officialID);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Official information updated successfully.'); window.location.href = 'adminDashboard.php';</script>";
    } else {
        echo "<script>alert('Error updating official information: " . $stmt->error . "'); window.location.href = 'adminDashboard.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>