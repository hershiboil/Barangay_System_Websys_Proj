<?php
include 'connection.php';

// Set headers to force download
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=residents_info_export.csv');

// Open PHP output stream
$output = fopen('php://output', 'w');

// Write CSV column headers
fputcsv($output, [
    'resident_ID', 'first_name', 'middle_name', 'last_name', 'suffix', 'nick_name', 'gender', 'occupation', 'age',
    'blood_type', 'civil_status', 'birthdate', 'birthplace', 'nationality', 'religion',
    'contact_number', 'email', 'province', 'municipality', 'zip_code', 'barangay', 'purok', 'street',
    'father_name', 'father_contact', 'mother_name', 'mother_contact', 'spouse_name', 'spouse_contact',
    'guardian_name', 'guardian_relation', 'guardian_contact', 'national_ID_num', 'sss_num', 'tin_num',
    'gsis_num', 'pagibig_num', 'philhealth_num', 'resident_status', 'voter', 'pwd', 'senior_citizen',
    'solo_parent', 'is_4ps', 'profile_photo'
]);

// Fetch data - Modified to include filtering
$search_term = isset($_GET['search']) ? $_GET['search'] : ''; // Get the search term
$condition = "";
if ($search_term) {
    $condition = "WHERE first_name LIKE '%$search_term%' OR last_name LIKE '%$search_term%' OR middle_name LIKE '%$search_term%' OR resident_ID LIKE '%$search_term%'"; // Added resident_ID
}

$sql = "SELECT 
    resident_ID, first_name, middle_name, last_name, suffix, nick_name, gender, occupation, age,
    blood_type, civil_status, birthdate, birthplace, nationality, religion,
    contact_number, email, province, municipality, zip_code, barangay, purok, street,
    father_name, father_contact, mother_name, mother_contact, spouse_name, spouse_contact,
    guardian_name, guardian_relation, guardian_contact, national_ID_num, sss_num, tin_num,
    gsis_num, pagibig_num, philhealth_num, resident_status, voter, pwd, senior_citizen,
    solo_parent, is_4ps, profile_photo
    FROM residents_info $condition"; // Use the condition
$result = $conn->query($sql);

// Write each row
while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
exit;
?>