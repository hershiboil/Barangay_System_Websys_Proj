<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "barangay_db";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$blotterSeries = $_GET['blotterSeries'] ?? null;

if (!$blotterSeries) {
    die("No blotter series provided.");
}

$sql = "DELETE FROM blotter WHERE blotterSeries='$blotterSeries'";

if ($connection->query($sql) === TRUE) {
    echo "Record deleted successfully.";
    header("Location: adminBlotterlist.php");
    exit;
} else {
    echo "Error deleting record: " . $connection->error;
}
?>
