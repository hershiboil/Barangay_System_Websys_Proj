<?php
// searchResidents.php
header('Content-Type: application/json'); // Tell the browser we're sending JSON

// Include your database connection file
include 'connection.php'; // Adjust path if necessary

$response = ['success' => false, 'message' => 'An unknown error occurred.', 'residents' => []];

// Check database connection first
if ($conn->connect_error) {
    $response['message'] = 'Database connection failed: ' . $conn->connect_error;
    echo json_encode($response);
    exit();
}

try {
    $searchQuery = $_GET['query'] ?? ''; // Get the search query from the URL parameter
    $residentStatus = $_GET['status'] ?? ''; // Get the status filter (e.g., 'Active', 'Inactive')

    $sql = "SELECT
        resident_ID,
        first_name,
        middle_name,
        last_name,
        suffix
    FROM residents_info";

    $whereClauses = [];
    $params = [];
    $paramTypes = "";

    // Add status filter if provided
    if (!empty($residentStatus)) {
        $whereClauses[] = "resident_status = ?";
        $params[] = $residentStatus;
        $paramTypes .= "s";
    }

    // Add search query filter if provided
    if (!empty($searchQuery)) {
        $searchTerm = '%' . $searchQuery . '%';
        // Adjust column names (e.g., nick_name, purok, barangay) to match your table
        $whereClauses[] = "(first_name LIKE ? OR last_name LIKE ? OR resident_ID LIKE ? OR nick_name LIKE ? OR purok LIKE ? OR barangay LIKE ?)";
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $paramTypes .= "ssssss"; // Six 's' for six string parameters
    }

    // Combine all where clauses
    if (!empty($whereClauses)) {
        $sql .= " WHERE " . implode(" AND ", $whereClauses);
    }

    // Add the ORDER BY clause for resident_ID ascending
    $sql .= " ORDER BY resident_ID ASC";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }

    // Bind parameters if any
    if (!empty($params)) {
        // Use call_user_func_array to bind parameters dynamically
        // The first argument to bind_param is the type string, followed by the parameters
        $bindParams = array_merge([$paramTypes], $params);
        $refParams = [];
        foreach ($bindParams as $key => $value) {
            $refParams[$key] = &$bindParams[$key]; // Pass by reference for bind_param
        }
        call_user_func_array([$stmt, 'bind_param'], $refParams);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $residents = []; // Initialize array here to ensure it's always an array
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $residents[] = $row;
        }
    }

    $response['success'] = true;
    $response['residents'] = $residents;
    $response['message'] = 'Residents fetched successfully.';

} catch (Exception $e) {
    $response['message'] = 'Database operation failed: ' . $e->getMessage();
    error_log("Error in searchResidents.php: " . $e->getMessage()); // Log error for debugging
}

$stmt->close(); // Close the statement
$conn->close(); // Close the database connection

echo json_encode($response);
?>