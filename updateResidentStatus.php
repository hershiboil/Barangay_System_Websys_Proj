<?php
// Include your database connection file
include 'connection.php';

header('Content-Type: application/json'); // Set header to indicate JSON response

$response = array(); // Initialize response array

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if resident_ID and new_status are set
    if (isset($_POST['resident_ID']) && isset($_POST['new_status'])) {
        $residentID = $_POST['resident_ID'];
        $newStatus = $_POST['new_status']; // Should be 'Active' or 'Inactive'

        // Prepare and bind the update statement
        // Using 's' for string (new_status) and 'i' for integer (resident_ID)
        $stmt = $conn->prepare("UPDATE residents_info SET resident_status = ? WHERE resident_ID = ?");
        if ($stmt) {
            $stmt->bind_param("si", $newStatus, $residentID);

            // Execute the statement
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $response['success'] = true;
                    $response['message'] = "Resident status updated successfully.";
                } else {
                    $response['success'] = false;
                    $response['message'] = "No resident found with ID: " . $residentID . " or status is already " . $newStatus . ".";
                }
            } else {
                $response['success'] = false;
                $response['message'] = "Error executing statement: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $response['success'] = false;
            $response['message'] = "Error preparing statement: " . $conn->error;
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Required parameters (resident_ID, new_status) are missing.";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request method.";
}

// Encode the response array to JSON and echo it
echo json_encode($response);

// Close the database connection
$conn->close();
?>