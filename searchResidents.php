<?php
// Include your database connection file
include 'connection.php';

header('Content-Type: application/json'); // Tell the browser we're sending JSON

$searchQuery = $_GET['query'] ?? ''; // Get the search query from the URL parameter
$residentStatus = $_GET['status'] ?? ''; // Get the status filter (e.g., 'Active', 'Inactive')

$residents = []; // Initialize an empty array for results

if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
}

$sql = "SELECT
    resident_ID,
    first_name,
    middle_name,
    last_name,
    suffix,
    nick_name,
    birthdate,
    birthplace,
    age,
    gender,
    blood_type,
    occupation,
    civil_status,
    nationality,
    religion,
    contact_number,
    email,
    province,
    municipality,
    zip_code,
    barangay,
    purok,
    street,
    father_name,
    father_contact,
    mother_name,
    mother_contact,
    spouse_name,
    spouse_contact,
    guardian_name,
    guardian_relation,
    guardian_contact,
    national_ID_num,
    sss_num,
    tin_num,
    gsis_num,
    pagibig_num,
    philhealth_num,
    resident_status,
    voter,
    pwd,
    senior_citizen,
    solo_parent,
    is_4ps
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
    $whereClauses[] = "(first_name LIKE ? OR last_name LIKE ? OR resident_ID LIKE ? OR nick_name LIKE ? OR purok LIKE ? OR barangay LIKE ?)";
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $paramTypes .= "ssssss";
}

// Combine all where clauses
if (!empty($whereClauses)) {
    $sql .= " WHERE " . implode(" AND ", $whereClauses);
}

// Add the ORDER BY clause for resident_ID descending
$sql .= " ORDER BY resident_ID ASC";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(['error' => 'Prepare failed: ' . $conn->error]);
    exit();
}

// Bind parameters if any
if (!empty($params)) {
    $stmt->bind_param($paramTypes, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $residents[] = $row;
    }
}
$stmt->close();
$conn->close();

echo json_encode($residents);
?>