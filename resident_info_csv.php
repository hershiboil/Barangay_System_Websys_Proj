<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "barangay_db";

$conn = new mysqli ($host, $user, $pass, $db);
if($conn->connect_error){
    die("Connection failed :" . $conn->connect_error);
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="resident_info.csv"');

$output = fopen("php://output", "w");

fputcsv($output, [
    'resident_ID', 'first_name', 'middle_name', 'last_name', 'suffix', 'nickname',
    'age', 'gender', 'civil_status', 'religion', 'nationality', 'contact_number',
    'email_address', 'address', 'birth_date', 'birth_place', 'municipality',
    'zip_code', 'purok', 'house_number', 'fathers_name', 'mothers_name',
    'guardian', 'occupation', 'national_ID', 'SSS_num', 'GSIS_num', 'pagibig_num',
    'philhealth_num', 'blood_type', 'user_profile', 'street', 'barangay'
]);

$query = "SELECT * FROM resident_info";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
exit;
?>