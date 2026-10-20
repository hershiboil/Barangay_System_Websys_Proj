<?php
include 'connection.php'; // Your database connection file (VERY IMPORTANT)

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $residentID = $_POST['resident_ID']; // Get from form
    $firstName = $_POST['first_name'];
    $middleName = $_POST['middle_name'];
    $lastName = $_POST['last_name'];
    $suffix = $_POST['suffix'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $bloodType = $_POST['blood_type'];
    $civilStatus = $_POST['civil_status'];
    $birthdate = $_POST['birthdate'];
    $birthplace = $_POST['birthplace'];
    $contactNumber = $_POST['contact_number'];
    $email = $_POST['email'];
    $province = $_POST['province'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $purok = $_POST['purok'];
    $street = $_POST['street'];
    $zipCode = $_POST['zip_code']; // Correct variable
    $fatherName = $_POST['father_name'];
    $fatherContact = $_POST['father_contact'];
    $motherName = $_POST['mother_name'];
    $motherContact = $_POST['mother_contact'];
    $spouseName = $_POST['spouse_name'];
    $spouseContact = $_POST['spouse_contact'];
    $guardianName = $_POST['guardian_name'];
    $guardianRelation = $_POST['guardian_relation'];
    $guardianContact = $_POST['guardian_contact'];
    $occupation = $_POST['occupation'];
    $nickName = $_POST['nick_name'];
    $nationality = $_POST['nationality'];
    $religion = $_POST['religion'];
    $nationalIDNum = $_POST['national_ID_num'];
    $sssNum = $_POST['sss_num'];
    $tinNum = $_POST['tin_num'];
    $gsisNum = $_POST['gsis_num'];
    $pagibigNum = $_POST['pagibig_num'];
    $philhealthNum = $_POST['philhealth_num'];
    $residentStatus = $_POST['resident_status'];
    $voter = $_POST['voter'];
    $pwd = $_POST['pwd'];
    $seniorCitizen = $_POST['senior_citizen'];
    $soloParent = $_POST['solo_parent'];
    $is4ps = $_POST['is_4ps'];

    // Construct the UPDATE query (MOST IMPORTANT)
    $sql = "UPDATE residents_info SET
                first_name = ?,
                middle_name = ?,
                last_name = ?,
                suffix = ?,
                gender = ?,
                age = ?,
                blood_type = ?,
                civil_status = ?,
                birthdate = ?,
                birthplace = ?,
                contact_number = ?,
                email = ?,
                province = ?,
                municipality = ?,
                barangay = ?,
                purok = ?,
                street = ?,
                zip_code = ?,
                father_name = ?,
                father_contact = ?,
                mother_name = ?,
                mother_contact = ?,
                spouse_name = ?,
                spouse_contact = ?,
                guardian_name = ?,
                guardian_relation = ?,
                guardian_contact = ?,
                occupation = ?,
                nick_name = ?,
                nationality = ?,
                religion = ?,
                national_ID_num = ?,
                sss_num = ?,
                tin_num = ?,
                gsis_num = ?,
                pagibig_num = ?,
                philhealth_num = ?,
                resident_status = ?,
                voter = ?,
                pwd = ?,
                senior_citizen = ?,
                solo_parent = ?,
                is_4ps = ?
            WHERE resident_ID = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Bind parameters (VERY IMPORTANT) - The order and types MUST match the query!
        $stmt->bind_param("sssssissssssssssssssssssssssssssssssssssssss",
            $firstName, $middleName, $lastName, $suffix, $gender, $age, $bloodType,
            $civilStatus, $birthdate, $birthplace, $contactNumber, $email, $province,
            $municipality, $barangay, $purok, $street, $zipCode, $fatherName,
            $fatherContact, $motherName, $motherContact, $spouseName, $spouseContact,
            $guardianName, $guardianRelation, $guardianContact, $occupation, $nickName,
            $nationality, $religion, $nationalIDNum, $sssNum, $tinNum, $gsisNum,
            $pagibigNum, $philhealthNum, $residentStatus, $voter, $pwd, $seniorCitizen,
            $soloParent, $is4ps, $residentID); // Don't forget resident ID for WHERE clause

        // Execute the statement
        if ($stmt->execute()) {
            // Success
            $response = ['success' => true];
        } else {
            // Error
            $response = ['success' => false, 'message' => $stmt->error];
        }

        // Close statement
        $stmt->close();
    } else {
        // Prepare failed
        $response = ['success' => false, 'message' => $conn->error];
    }
    // Close connection
    $conn->close();

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>