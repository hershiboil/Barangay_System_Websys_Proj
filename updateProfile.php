<?php
session_start();

 include 'connection.php';

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $resident_ID = $_SESSION['resident_ID']; 

    $firstName = $_POST['first_name'];
    $middleName = $_POST['middle_name'];
    $lastName = $_POST['last_name'];
    $suffix = $_POST['suffix'];
    $gender = $_POST['gender'];
    $dob = $_POST['birthdate']; 
    $civil_status = $_POST['civil_status'];
    $birth_place = $_POST['birthplace'];
    $religion = $_POST['religion'];
    $nationality = $_POST['nationality'];
    $purok = $_POST['purok'];
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];


    $query = "UPDATE residents_info SET 
                first_name = ?, 
                middle_name = ?, 
                last_name = ?, 
                suffix = ?, 
                gender = ?, 
                birthdate = ?, 
                civil_status = ?, 
                birthplace = ?, 
                religion = ?, 
                nationality = ?, 
                purok = ?, 
                street = ?, 
                barangay = ?
              WHERE resident_ID = ?";

    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("sssssssssssssi", 
            $firstName, $middleName, $lastName, $suffix, $gender, $dob,
            $civil_status, $birth_place, $religion, $nationality, 
            $purok, $street, $barangay, $resident_ID
        );

        if ($stmt->execute()) {
            echo "Profile updated successfully!";
        } else {
            echo "Error updating profile: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>