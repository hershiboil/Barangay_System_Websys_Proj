<?php
// update_role.php
header('Content-Type: application/json'); // Set header to indicate JSON response

// Include your database connection file
// Make sure this path is correct relative to where update_role.php is located
include 'connection.php';

$response = ['status' => 'error', 'message' => 'An unknown error occurred.'];

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data sent from the JavaScript FormData
    $roleId = $_POST['role_id'] ?? null;
    $roleName = trim($_POST['role_name'] ?? '');
    $roleDescription = trim($_POST['role_description'] ?? '');

    // Basic validation for received data
    if (empty($roleId) || !is_numeric($roleId)) {
        $response['message'] = 'Invalid Role ID provided.';
        echo json_encode($response);
        exit();
    }

    if (empty($roleName)) {
        $response['message'] = 'Role Name cannot be empty.';
        echo json_encode($response);
        exit();
    }

    // Start a database transaction for atomicity
    // This ensures that either all database operations succeed, or none of them do.
    $conn->begin_transaction();

    try {
        // Prepare SQL statement to update the roles table
        // The `last_modified` column will automatically update if it's a TIMESTAMP with ON UPDATE CURRENT_TIMESTAMP
        $stmt = $conn->prepare("UPDATE roles SET role_name = ?, description = ? WHERE role_id = ?");

        // Bind parameters to the prepared statement
        // 'ssi' means: s=string, s=string, i=integer (for role_name, description, role_id)
        $stmt->bind_param('ssi', $roleName, $roleDescription, $roleId);

        // Execute the statement
        if (!$stmt->execute()) {
            // If execution fails, throw an exception to trigger the catch block
            throw new Exception("Failed to update role: " . $stmt->error);
        }
        $stmt->close(); // Close the statement

        // --- Optional: Permissions Update Logic (Uncomment and implement if needed) ---
        // If you need to update permissions as part of the role edit,
        // you would typically delete existing permissions for this role_id
        // and then insert the new set of permissions.
        /*
        // Example of how permissions would be handled if included in the edit modal:
        $permissionsJson = $_POST['permissions'] ?? '[]';
        $permissions = json_decode($permissionsJson, true);

        if (!empty($permissions) && is_array($permissions)) {
            // 1. Delete all existing permissions for this role
            $deleteStmt = $conn->prepare("DELETE FROM role_permissions WHERE role_id = ?");
            $deleteStmt->bind_param('i', $roleId);
            if (!$deleteStmt->execute()) {
                throw new Exception("Failed to delete existing permissions for role ID {$roleId}: " . $deleteStmt->error);
            }
            $deleteStmt->close();

            // 2. Insert the new set of permissions
            $permissionStmt = $conn->prepare("INSERT INTO role_permissions (role_id, permission_name) VALUES (?, ?)");
            foreach ($permissions as $permissionName) {
                $permissionStmt->bind_param('is', $roleId, $permissionName);
                if (!$permissionStmt->execute()) {
                    // Log the error but decide if you want to throw an exception here
                    // Throwing an exception would roll back the entire transaction (role update included)
                    error_log("Failed to insert permission '{$permissionName}' for role ID {$roleId}: " . $permissionStmt->error);
                    // throw new Exception("Failed to insert new permission '{$permissionName}'.");
                }
            }
            $permissionStmt->close();
        } else {
            // If no permissions are sent (meaning all were deselected), delete all existing ones for this role
            $deleteStmt = $conn->prepare("DELETE FROM role_permissions WHERE role_id = ?");
            $deleteStmt->bind_param('i', $roleId);
            if (!$deleteStmt->execute()) {
                throw new Exception("Failed to delete all permissions for role ID {$roleId} (none selected): " . $deleteStmt->error);
            }
            $deleteStmt->close();
        }
        */

        // If all operations within the try block succeeded, commit the transaction
        $conn->commit();
        $response['status'] = 'success';
        $response['message'] = 'Role updated successfully!';

    } catch (Exception $e) {
        // If any error occurred, rollback the transaction to undo any changes
        $conn->rollback();
        $response['message'] = 'Database operation failed: ' . $e->getMessage();
        // Log the full error message to your server's PHP error log for debugging
        error_log("Update Role Error: " . $e->getMessage());
    }

    $conn->close(); // Close the database connection
} else {
    // If the request method is not POST, return an error
    $response['message'] = 'Invalid request method. Only POST requests are allowed.';
}

// Encode the response array as JSON and output it
echo json_encode($response);
?>