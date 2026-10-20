<?php
// getAccountDetails.php
header('Content-Type: application/json');

include 'connection.php'; // Adjust path if necessary

$response = ['success' => false, 'message' => 'An unknown error occurred.', 'account' => null];

if (isset($_GET['resident_id'])) {
    $residentId = $_GET['resident_id'];

    try {
        if ($conn->connect_error) {
            throw new Exception("Database connection failed: " . $conn->connect_error);
        }

        // SQL query to fetch a single account's data
        // JOIN with residents_info to get full_name
        // JOIN with roles to get role_name
        $stmt = $conn->prepare("
            SELECT
                a.resident_id,
                ri.first_name,
                ri.last_name,
                r.role_id,   -- IMPORTANT: Get role_id for select dropdown value
                r.role_name,
                a.status
            FROM
                accounts a
            JOIN
                residents_info ri ON a.resident_id = ri.resident_ID
            JOIN
                roles r ON a.role_id = r.role_id
            WHERE
                a.resident_id = ?
            LIMIT 1;
        ");

        if ($stmt === false) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        $stmt->bind_param("i", $residentId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $account = $result->fetch_assoc();
            // Combine names for frontend display
            $account['full_name'] = $account['first_name'] . ' ' . $account['last_name'];
            unset($account['first_name']);
            unset($account['last_name']);

            $response['success'] = true;
            $response['message'] = 'Account details fetched successfully.';
            $response['account'] = $account;
        } else {
            $response['message'] = 'Account not found.';
        }

        $stmt->close();

    } catch (Exception $e) {
        $response['message'] = 'Error: ' . $e->getMessage();
        error_log("Get Account Details Error: " . $e->getMessage());
    } finally {
        if ($conn && !$conn->connect_error) {
            $conn->close();
        }
    }
} else {
    $response['message'] = 'Resident ID not provided.';
}

echo json_encode($response);
?>