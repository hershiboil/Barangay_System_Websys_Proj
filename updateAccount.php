<?php
// updateAccount.php

header('Content-Type: application/json');
include 'connection.php';

$response = ['status' => 'error', 'message' => 'An unknown error occurred.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resident_id = $_POST['resident_id'] ?? '';
    $password = $_POST['password'] ?? '';
    $role_id = $_POST['role_id'] ?? '';
    $status = $_POST['status'] ?? '';

    // --- DEBUGGING START ---
    error_log("--- updateAccount.php Debugging ---");
    error_log("Received resident_id: " . $resident_id);
    error_log("Received password (empty if not changed): " . (!empty($password) ? '*****' : 'empty'));
    error_log("Received role_id: " . $role_id);
    error_log("Received status: " . $status);
    // --- DEBUGGING END ---

    if (empty($resident_id) || empty($role_id) || empty($status)) {
        $response['message'] = 'Missing required fields: Resident ID, Role, or Status.';
        echo json_encode($response);
        $conn->close();
        exit();
    }

    $update_fields = [];
    $params = [];
    $types = "";

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $update_fields[] = "password_hash = ?";
        $params[] = $hashed_password;
        $types .= "s";
    }

    $update_fields[] = "role_id = ?";
    $params[] = $role_id;
    $types .= "i";

    $update_fields[] = "status = ?";
    $params[] = $status;
    $types .= "s";

    $update_fields[] = "last_modified = NOW()";

    $sql = "UPDATE accounts SET " . implode(", ", $update_fields) . " WHERE resident_id = ?";

    $params[] = $resident_id; // Add resident_id for WHERE clause
    $types .= "s"; // Type for resident_id

    // --- DEBUGGING START ---
    error_log("Generated SQL: " . $sql);
    error_log("Bound parameters (types string): " . $types);
    error_log("Bound parameters (values): " . implode(", ", $params)); // Be careful with passwords here, usually you'd censor
    // --- DEBUGGING END ---

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        $response['message'] = 'Failed to prepare statement: ' . $conn->error;
        error_log("updateAccount.php prepare error: " . $conn->error);
        echo json_encode($response);
        $conn->close();
        exit();
    }

    $bind_params_array = [];
    $bind_params_array[] = $types;
    foreach ($params as $key => &$value) {
        $bind_params_array[] = &$value;
    }
    call_user_func_array([$stmt, 'bind_param'], $bind_params_array);


    if ($stmt->execute()) {
        // --- DEBUGGING START ---
        error_log("Statement executed successfully.");
        error_log("Affected rows: " . $stmt->affected_rows);
        // --- DEBUGGING END ---

        if ($stmt->affected_rows > 0) {
            $response['status'] = 'success';
            $response['message'] = 'Account updated successfully.';
        } else {
            $response['status'] = 'info';
            $response['message'] = 'No changes detected or account not found.';
        }
    } else {
        $response['message'] = 'Failed to update account: ' . $stmt->error;
        error_log("updateAccount.php execute error: " . $stmt->error);
    }

    $stmt->close();

} else {
    $response['message'] = 'Invalid request method. Only POST requests are allowed.';
    http_response_code(405);
}

if ($conn && !$conn->connect_error) {
    $conn->close();
}

echo json_encode($response);