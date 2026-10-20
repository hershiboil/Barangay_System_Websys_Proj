<?php
// saveAccount.php
header('Content-Type: application/json'); // Indicate JSON response

// Include your database connection file
include 'connection.php'; // Adjust path if necessary

$response = ['status' => 'error', 'message' => 'An unknown error occurred.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from POST request
    $residentId = $_POST['resident_id'] ?? null; // Null if not selected from search
    $password = $_POST['password'] ?? '';
    $roleId = $_POST['role_id'] ?? null;
    $status = $_POST['status'] ?? '';

    // --- Basic Validation for 'accounts' table fields ---
    // residentId is primary key, so it must be present and valid
    if (empty($residentId) || !is_numeric($residentId) || (int)$residentId <= 0) {
        $response['message'] = 'Invalid or missing Resident ID.';
        echo json_encode($response);
        exit();
    }
    if (empty($password)) {
        $response['message'] = 'Password cannot be empty.';
        echo json_encode($response);
        exit();
    }
    if (empty($roleId) || !is_numeric($roleId) || (int)$roleId <= 0) {
        $response['message'] = 'Invalid or missing Role ID.';
        echo json_encode($response);
        exit();
    }
    if (empty($status) || !in_array($status, ['active', 'inactive'])) {
        $response['message'] = 'Invalid or missing Status value. Must be "active" or "inactive".';
        echo json_encode($response);
        exit();
    }

    // --- Password Hashing (CRUCIAL SECURITY STEP) ---
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    if ($hashedPassword === false) {
        $response['message'] = 'Failed to hash password due to an internal error.';
        error_log("Password hashing failed for residentId: " . ($residentId ?? 'NULL'));
        echo json_encode($response);
        exit();
    }
    // --- End Password Hashing ---

    // Start a transaction for atomicity
    $conn->begin_transaction();

    try {
        // --- SQL Query for the 'accounts' table ---
        // Insert into 'accounts' table with resident_id, password, role_id, and status
        // 'last_modified' column is automatically handled by MySQL with ON UPDATE CURRENT_TIMESTAMP
        $stmt = $conn->prepare("INSERT INTO accounts (resident_id, password, role_id, status) VALUES (?, ?, ?, ?)");

        if ($stmt === false) {
            throw new Exception("Failed to prepare statement for account creation: " . $conn->error);
        }

        // Bind parameters:
        // 'i' for integer (resident_id)
        // 's' for string (hashedPassword)
        // 'i' for integer (role_id)
        // 's' for string (status)
        $stmt->bind_param("isis", $residentId, $hashedPassword, $roleId, $status);

        if (!$stmt->execute()) {
            // Check for duplicate entry error specifically for resident_id (since it's PRIMARY KEY)
            if ($conn->errno == 1062) { // MySQL error code for duplicate entry
                throw new Exception("A user account already exists for Resident ID: " . $residentId . ". Each resident can only have one account.");
            }
            throw new Exception("Failed to create account: " . $stmt->error);
        }
        $stmt->close();

        $conn->commit(); // Commit the transaction if all operations succeed
        $response['status'] = 'success';
        $response['message'] = 'Account created successfully!';

    } catch (Exception $e) {
        $conn->rollback(); // Rollback the transaction on any error
        $response['message'] = 'Database operation failed: ' . $e->getMessage();
        error_log("Save Account Error: " . $e->getMessage()); // Log detailed error for debugging
    }
} else {
    $response['message'] = 'Invalid request method. Only POST requests are allowed.';
}

// Ensure connection is valid before closing
if ($conn && !$conn->connect_error) {
    $conn->close();
}
echo json_encode($response);
?>