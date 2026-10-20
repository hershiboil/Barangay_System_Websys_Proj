<?php
include 'connection.php';

header('Content-Type: application/json');

$query = $_GET['query'] ?? '';

if (empty($query)) {
    error_log("Empty query. Returning empty array.");
    echo json_encode([]);
    exit();
}

$searchTerm = '%' . $query . '%';
$sql = "SELECT DISTINCT
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
        FROM residents_info 
        WHERE first_name LIKE ? OR last_name LIKE ? OR resident_ID LIKE ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    error_log("Error preparing statement: " . $conn->error);
    echo json_encode(['error' => 'Database error']);
    exit();
}
$stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
$stmt->execute();
if ($stmt->error) {
    error_log("Error executing statement: " . $stmt->error);
    echo json_encode(['error' => 'Database query error']);
    exit();
}
$result = $stmt->get_result();

$residents = [];
while ($row = $result->fetch_assoc()) {
    $residents[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode($residents);
?>
