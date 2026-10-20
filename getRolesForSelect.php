<?php
// getRolesForSelect.php
header('Content-Type: application/json'); // Indicate JSON response

// Include your database connection file
include 'connection.php'; // Adjust path if necessary

$response = ['success' => false, 'message' => 'An unknown error occurred.'];

try {
    $stmt = $conn->prepare("SELECT role_id, role_name FROM roles ORDER BY role_name ASC");
    $stmt->execute();
    $result = $stmt->get_result();

    $roles = [];
    while ($row = $result->fetch_assoc()) {
        $roles[] = $row;
    }

    $response['success'] = true;
    $response['roles'] = $roles;
    $response['message'] = 'Roles fetched successfully.';

} catch (Exception $e) {
    $response['message'] = 'Database query failed: ' . $e->getMessage();
    error_log("Error fetching roles: " . $e->getMessage());
}

$conn->close(); // Close the database connection
echo json_encode($response);
?>