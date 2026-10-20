<?php
include 'connection.php'; // your DB connection
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["csv_file"])) {
    $file = $_FILES["csv_file"]["tmp_name"];

    if (($handle = fopen($file, "r")) !== FALSE) {
        fgetcsv($handle); // Skip header row

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Assign values (ensure order matches CSV)
            list(
                $first_name,
                $middle_name,
                $last_name,
                $suffix,
                $nick_name,
                $gender,
                $occupation,
                $age,
                $blood_type,
                $civil_status,
                $birthdate,
                $birthplace,
                $nationality,
                $religion,
                $contact_number,
                $email,
                $province,
                $municipality,
                $zip_code,
                $barangay,
                $purok,
                $street,
                $father_name,
                $father_contact,
                $mother_name,
                $mother_contact,
                $spouse_name,
                $spouse_contact,
                $guardian_name,
                $guardian_relation,
                $guardian_contact,
                $national_ID_num,
                $sss_num,
                $tin_num,
                $gsis_num,
                $pagibig_num,
                $philhealth_num,
                $resident_status,
                $voter,
                $pwd,
                $senior_citizen,
                $solo_parent,
                $is_4ps,
                $profile_photo
            ) = $data;

            // Optional: validate $resident_ID, $first_name, etc.

            $sql = "INSERT INTO residents_info (first_name, middle_name, last_name, suffix, nick_name, gender, occupation, age, 
                blood_type, civil_status, birthdate, birthplace, nationality, religion, contact_number, email, 
                province, municipality, zip_code,  barangay, purok, street, father_name, father_contact,
                mother_name, mother_contact, spouse_name, spouse_contact, guardian_name, guardian_relation,
                guardian_contact, national_ID_num, sss_num, tin_num, gsis_num, pagibig_num, philhealth_num,
                resident_status, voter, pwd, senior_citizen, solo_parent, is_4ps, profile_photo
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
                ?, ?, ?, ?, ?, ?, ?, ?,  
                ?, ?, ?, ?, ?, ?, ?, ?, 
                ?, ?, ?, ?, ?, ?, ?, ?
            )";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param(
                str_repeat("s", 44),
                $first_name,
                $middle_name,
                $last_name,
                $suffix,
                $nick_name,
                $gender,
                $occupation,
                $age,
                $blood_type,
                $civil_status,
                $birthdate,
                $birthplace,
                $nationality,
                $religion,
                $contact_number,
                $email,
                $province,
                $municipality,
                $zip_code,
                $barangay,
                $purok,
                $street,
                $father_name,
                $father_contact,
                $mother_name,
                $mother_contact,
                $spouse_name,
                $spouse_contact,
                $guardian_name,
                $guardian_relation,
                $guardian_contact,
                $national_ID_num,
                $sss_num,
                $tin_num,
                $gsis_num,
                $pagibig_num,
                $philhealth_num,
                $resident_status,
                $voter,
                $pwd,
                $senior_citizen,
                $solo_parent,
                $is_4ps,
                $profile_photo
            );



            $stmt->execute();
        }

        fclose($handle);
        header("Location: adminAllResidents.php?import=success");
        exit;
    } else {
        echo "Failed to open the CSV file.";
    }
} else {
    echo "No file uploaded.";
}
?>