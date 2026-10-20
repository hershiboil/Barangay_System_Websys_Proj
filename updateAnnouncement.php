<?php
$conn = new mysqli("localhost", "root", "", "barangay_db");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$title = $conn->real_escape_string($_POST['title']);
$content = $conn->real_escape_string($_POST['content']);

$sql = "UPDATE announcement SET title='$title', content='$content', modified='yes' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  header("Location: adminAnnouncement.php");
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
