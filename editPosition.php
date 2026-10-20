<?php
include 'connection.php';

$id = $_POST['id'];
$title = $_POST['title'];
$limit = $_POST['limit'];
$description = $_POST['description'];

$stmt = $conn->prepare("UPDATE positions SET title=?, pos_limit=?, description=? WHERE id=?");
$stmt->bind_param("sisi", $title, $limit, $description, $id);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}

$stmt->close();
$conn->close();
?>
