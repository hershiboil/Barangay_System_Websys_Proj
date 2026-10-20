<?php
// getAdminAccounts.php
header('Content-Type: application/json');

include 'connection.php'; // Adjust path if necessary

$response = ['success' => false, 'message' => 'An unknown error occurred.', 'data' => []];

try {
    if ($conn->connect_error) {
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }

    $sql = "
        SELECT
            a.resident_id,
            ri.first_name,
            ri.last_name,
            r.role_name,
            a.status,
            a.last_modified
        FROM
            accounts a
        JOIN
            residents_info ri ON a.resident_id = ri.resident_ID
        JOIN
            roles r ON a.role_id = r.role_id
        WHERE
            r.role_name != 'resident' -- <--- KEY DIFFERENCE: Exclude 'resident' role
        ORDER BY
            a.last_modified DESC;
    ";

    $result = $conn->query($sql);

    if ($result === false) {
        throw new Exception("Error executing query: " . $conn->error);
    }

    $accounts = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row['full_name'] = $row['first_name'] . ' ' . $row['last_name'];
            unset($row['first_name']);
            unset($row['last_name']);
            $accounts[] = $row;
        }
    }

    $response['success'] = true;
    $response['message'] = 'Administrator/Staff Accounts fetched successfully.';
    $response['data'] = $accounts;

} catch (Exception $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
    error_log("Get Admin Accounts Error: " . $e->getMessage());
} finally {
    if ($conn && !$conn->connect_error) {
        $conn->close();
    }
}

echo json_encode($response);
?>