<?php
$conn = new mysqli("localhost", "root", "", "barangay_db");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM announcement WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  header("Location: adminAnnouncement.php");
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
