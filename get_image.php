<?php
$db = new PDO('sqlite:connection.db');

if (isset($_GET['resident_id'])) {
    $stmt = $db->prepare("SELECT imgPath FROM barangay_officials WHERE id = ?");
    $stmt->execute([$_GET['officialId']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        header("Content-Type: image/jpeg");
        echo $row['imgPath'];  
    } else {
        http_response_code(404);
        echo "Image not found";
    }
}
?>