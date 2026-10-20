<?php 
include 'connection.php';

// Escape all inputs to prevent SQL syntax errors and SQL injection
$blotterSeries = $conn->real_escape_string($_POST['blotterSeries']);
$dates = $conn->real_escape_string($_POST['dates']);
$complainantName = $conn->real_escape_string($_POST['complainantName']);
$complainantAge = $conn->real_escape_string($_POST['complainantAge']);
$complainantAddress = $conn->real_escape_string($_POST['complainantAddress']);
$complainantContact = $conn->real_escape_string($_POST['complainantContact']);
$defendantName = $conn->real_escape_string($_POST['defendantName']);
$defendantAge = $conn->real_escape_string($_POST['defendantAge']);
$defendantAddress = $conn->real_escape_string($_POST['defendantAddress']);
$defendantContact = $conn->real_escape_string($_POST['defendantContact']);
$narrative = $conn->real_escape_string($_POST['narrative']);
$officerName = $conn->real_escape_string($_POST['officerName']);
$position = $conn->real_escape_string($_POST['position']);
$complaints = $conn->real_escape_string($_POST['complaints']);
$blotterDate = $conn->real_escape_string($_POST['blotterDate']);
$blotterPlace = $conn->real_escape_string($_POST['blotterPlace']);
$blotterTime = $conn->real_escape_string($_POST['blotterTime']);

$checkBlotterSeries = "SELECT * FROM blotter WHERE blotterSeries='$blotterSeries'";
$result = $conn->query($checkBlotterSeries);

if ($result->num_rows > 0) {
    // Update existing record
    $updateQuery = "UPDATE blotter SET 
        dates='$dates',
        complainantName='$complainantName',
        complainantAge='$complainantAge',
        complainantAddress='$complainantAddress',
        complainantContact='$complainantContact',
        defendantName='$defendantName',
        defendantAge='$defendantAge',
        defendantAddress='$defendantAddress',
        defendantContact='$defendantContact',
        narrative='$narrative',
        officerName='$officerName',
        position='$position',
        complaints='$complaints',
        blotterDate='$blotterDate',
        blotterPlace='$blotterPlace',
        blotterTime='$blotterTime'
        WHERE blotterSeries='$blotterSeries'";

    if ($conn->query($updateQuery) === TRUE) {
        echo "Record updated successfully.";
        header("Location: adminBlotterlist.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }

} else {
    // Insert new record
    $insertQuery = "INSERT INTO blotter (
        blotterSeries, dates, complainantName, complainantAge, complainantAddress, complainantContact, 
        defendantName, defendantAge, defendantAddress, defendantContact, narrative, officerName, position, complaints, blotterDate, blotterPlace, blotterTime
    ) VALUES (
        '$blotterSeries', '$dates', '$complainantName', '$complainantAge', '$complainantAddress', '$complainantContact',
        '$defendantName', '$defendantAge', '$defendantAddress', '$defendantContact', '$narrative', '$officerName', '$position', '$complaints', '$blotterDate', '$blotterPlace', '$blotterTime'
    )";

    
}
?>
