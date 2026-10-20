<?php
// getRoles.php
header('Content-Type: application/json');
include 'connection.php';

$response = ['success' => false, 'data' => []];

try {
    $stmt = $conn->prepare("SELECT role_id, role_name, description, last_modified FROM roles ORDER BY role_id ASC");
    // Ensure role_id is selected here!

    $stmt->execute();
    $result = $stmt->get_result();

    $roles = [];
    while ($row = $result->fetch_assoc()) {
        $roles[] = $row;
    }

    $response['success'] = true;
    $response['data'] = $roles;

} catch (Exception $e) {
    $response['error'] = 'Database error: ' . $e->getMessage();
}

$conn->close();
echo json_encode($response);
?>