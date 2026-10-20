<?php
header('Content-Type: application/json');

include 'connection.php';

$response = ['status' => 'error', 'message' => 'An unknown error occurred.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roleName = trim($_POST['role_name'] ?? '');
    $roleDescription = trim($_POST['role_description'] ?? '');
    $permissionsJson = $_POST['permissions'] ?? '[]';

    $permissions = json_decode($permissionsJson, true);

    if (empty($roleName)) {
        $response['message'] = 'Role Name cannot be empty.';
        echo json_encode($response);
        exit();
    }

    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("INSERT INTO roles (role_name, description) VALUES (?, ?)");
        $stmt->bind_param('ss', $roleName, $roleDescription);
        if (!$stmt->execute()) {
            throw new Exception("Failed to insert role: " . $stmt->error);
        }
        $newRoleId = $conn->insert_id;
        $stmt->close();

        if (!empty($permissions) && is_array($permissions)) {
            $permissionStmt = $conn->prepare("INSERT INTO role_permissions (role_id, permission_name) VALUES (?, ?)");
            foreach ($permissions as $permissionName) {
                $permissionStmt->bind_param('is', $newRoleId, $permissionName);
                if (!$permissionStmt->execute()) {
                    error_log("Failed to insert permission '{$permissionName}' for role ID {$newRoleId}: " . $permissionStmt->error);
                }
            }
            $permissionStmt->close();
        }

        $conn->commit();
        $response['status'] = 'success';
        $response['message'] = 'Role and permissions added successfully!';

    } catch (Exception $e) {
        $conn->rollback();
        $response['message'] = 'Database operation failed: ' . $e->getMessage();
        error_log($e->getMessage());
    }

    $conn->close();
} else {
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>