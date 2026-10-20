<?php
 include 'connection.php'; 

// Process form data directly without checking for blotterContainer
$blotterSeries = $_POST['blotterSeries'];
$dates = $_POST['dates'];
$complainantName = $_POST['complainantName'];
$complainantAge = $_POST['complainantAge'];
$complainantAddress = $_POST['complainantAddress'];
$complainantContact = $_POST['complainantContact'];
$defendantName = $_POST['defendantName'];
$defendantAge = $_POST['defendantAge'];
$defendantAddress = $_POST['defendantAddress'];
$defendantContact = $_POST['defendantContact'];
$narrative = $_POST['narrative'];
$officerName = $_POST['officerName'];
$position = $_POST['position'];
$complaints = $_POST['complaints'];
$blotterDate= $_POST['blotterDate'];
$blotterPlace= $_POST['blotterPlace'];
$blotterTime= $_POST['blotterTime'];



$checkBlotterSeries = "SELECT * FROM blotter WHERE blotterSeries='$blotterSeries'";
$result = $conn->query($checkBlotterSeries);

if($result->num_rows > 0){
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
        complaints= '$complaints',
        blotterDate= '$blotterDate',
        blotterPlace= '$blotterPlace',
        blotterTime= '$blotterTime'
        WHERE blotterSeries='$blotterSeries'";

    if($conn->query($updateQuery) === TRUE){
        echo "Record updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }

} else {
    // Insert new record
    $insertQuery = "INSERT INTO blotter (
        blotterSeries, dates, complainantName, complainantAge, complainantAddress, complainantContact, 
        defendantName, defendantAge, defendantAddress, defendantContact, narrative, officerName, position, complaints,blotterDate, blotterPlace, blotterTime
    ) VALUES (
        '$blotterSeries', '$dates', '$complainantName', '$complainantAge', '$complainantAddress', '$complainantContact',
        '$defendantName', '$defendantAge', '$defendantAddress', '$defendantContact', '$narrative', '$officerName', '$position', '$complaints', '$blotterDate', '$blotterPlace', '$blotterTime'
    )";

    if($conn->query($insertQuery) === TRUE){
        echo "Record inserted successfully!";
        exit();
    } else {
        echo "Error inserting record: " . $conn->error;
    }
}
?>
