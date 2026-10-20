<?php
// Include the database connection
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $residentID = $_POST['residentID'];
    $fullName = $_POST['fullName'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    // Update the resident data in the database
    $sql = "UPDATE residents SET fullName = ?, age = ?, gender = ? WHERE resident_ID = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssis", $fullName, $age, $gender, $residentID);
        $stmt->execute();

        // Redirect to a success page or show a success message
        header('Location: residents.php'); // Or wherever you want to redirect
        exit();
    } else {
        // Handle errors if the query fails
        echo "Error: " . $conn->error;
    }
}
?>
