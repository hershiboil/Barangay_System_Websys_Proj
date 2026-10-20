<?php
// getResident.php (Note: Name changed from getResidents.php to getResident.php for clarity)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json'); // Crucial: Set content type to JSON

include 'connection.php'; // Your database connection file

$response = []; // Initialize an array for the response

// Check if the connection was successful
if ($conn->connect_error) {
    $response['error'] = "Connection failed: " . $conn->connect_error;
    echo json_encode($response);
    exit(); // Exit immediately after sending JSON error
}

// Check if 'id' parameter is set in the URL
if (!isset($_GET['id'])) {
    $response['error'] = "Resident ID not provided.";
    echo json_encode($response);
    $conn->close();
    exit();
}

$residentID = $_GET['id'];

// Query to fetch a single resident's data
// IMPORTANT: Make sure all column names here exactly match your 'residents_info' table
$sql = "SELECT * FROM residents_info WHERE resident_ID = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    $response['error'] = "Prepare failed: " . $conn->error;
    echo json_encode($response);
    $conn->close();
    exit();
}

$stmt->bind_param("s", $residentID); // "s" because resident_ID might be string or you can use "i" if it's integer

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $residentData = $result->fetch_assoc();
    echo json_encode($residentData); // Return single resident data as JSON
} else {
    $response['error'] = "Resident not found.";
    echo json_encode($response);
}

$stmt->close();
$conn->close();
?>