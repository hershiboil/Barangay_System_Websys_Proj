<?php
// delete_role.php
header('Content-Type: application/json'); // Set header to indicate JSON response

// Include your database connection file
// Make sure this path is correct relative to where delete_role.php is located
include 'connection.php';

$response = ['status' => 'error', 'message' => 'An unknown error occurred.'];

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // For DELETE requests, data is often sent as JSON in the request body
    // file_get_contents('php://input') reads the raw POST data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true); // Decode the JSON string into a PHP associative array

    $roleId = $data['role_id'] ?? null; // Get the role_id from the decoded data

    // Basic validation for received data
    if (empty($roleId) || !is_numeric($roleId)) {
        $response['message'] = 'Invalid Role ID provided for deletion.';
        echo json_encode($response);
        exit();
    }

    // Start a database transaction for atomicity
    $conn->begin_transaction();

    try {
        // First, delete all associated permissions from the role_permissions table
        $stmtPermissions = $conn->prepare("DELETE FROM role_permissions WHERE role_id = ?");
        $stmtPermissions->bind_param('i', $roleId); // 'i' for integer
        if (!$stmtPermissions->execute()) {
            throw new Exception("Failed to delete role permissions: " . $stmtPermissions->error);
        }
        $stmtPermissions->close();

        // Then, delete the role itself from the roles table
        $stmtRole = $conn->prepare("DELETE FROM roles WHERE role_id = ?");
        $stmtRole->bind_param('i', $roleId); // 'i' for integer
        if (!$stmtRole->execute()) {
            throw new Exception("Failed to delete role: " . $stmtRole->error);
        }
        $stmtRole->close();

        // If both deletions succeeded, commit the transaction
        $conn->commit();
        $response['status'] = 'success';
        $response['message'] = 'Role and its permissions deleted successfully!';

    } catch (Exception $e) {
        // If any error occurred, rollback the transaction to undo any changes
        $conn->rollback();
        $response['message'] = 'Database operation failed: ' . $e->getMessage();
        // Log the full error message to your server's PHP error log for debugging
        error_log("Delete Role Error: " . $e->getMessage());
    }

    $conn->close(); // Close the database connection
} else {
    // If the request method is not POST, return an error
    $response['message'] = 'Invalid request method. Only POST requests are allowed.';
}

// Encode the response array as JSON and output it
echo json_encode($response);
?>