<?php
include 'connection.php'; 

$sql = "SELECT officialID, officialName, officialPosition FROM barangay_officials";
$result = mysqli_query($conn, $sql);

$officials = [];

while ($row = mysqli_fetch_assoc($result)) {
    $officials[] = [
        'name' => $row['officialName'],
        'position' => $row['officialPosition'],
        'image' => 'get_image.php?id=' . $row['officialID']  
    ];
}

echo json_encode($officials);
?>