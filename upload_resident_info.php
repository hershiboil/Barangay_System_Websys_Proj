<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "barangay_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csv_file'])) {
    $file = $_FILES['csv_file']['tmp_name'];

    if (($handle = fopen($file, "r")) !== FALSE) {
        // Skip header row
        fgetcsv($handle);

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Escape each value
            $data = array_map(function ($value) use ($conn) {
                return $conn->real_escape_string($value);
            }, $data);

            // Adjust to match your column order (33 columns in total)
            $sql = "INSERT IGNORE INTO resident_info (
                resident_ID, first_name, middle_name, last_name, suffix, nickname, age,
                gender, civil_status, religion, nationality, contact_number, email_address,
                address, birth_date, birth_place, municipality, zip_code, purok,
                house_number, fathers_name, mothers_name, guardian, occupation,
                national_ID, SSS_num, GSIS_num, pagibig_num, philhealth_num,
                blood_type, user_profile, street, barangay
            ) VALUES (
                '$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]',
                '$data[7]', '$data[8]', '$data[9]', '$data[10]', '$data[11]', '$data[12]',
                '$data[13]', '$data[14]', '$data[15]', '$data[16]', '$data[17]', '$data[18]',
                '$data[19]', '$data[20]', '$data[21]', '$data[22]', '$data[23]',
                '$data[24]', '$data[25]', '$data[26]', '$data[27]', '$data[28]',
                '$data[29]', '$data[30]', '$data[31]', '$data[32]'
            )";

            $conn->query($sql);
        }

        fclose($handle);
        echo "CSV uploaded and imported successfully.";
    } else {
        echo "Failed to open uploaded file.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
