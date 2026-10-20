<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'brew_bliss_db';

    $conn = new mysqli($host, $user, $pass, $db);
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $fullName = $conn->real_escape_string($_POST['fullName']);
    $emailAddress = $conn->real_escape_string($_POST['emailAddress']);
    $feedback = $conn->real_escape_string($_POST['feedback']);

    $conn->query("INSERT INTO feedbacks (fullName, emailAddress, feedback) VALUES ('$fullName', '$emailAddress', '$feedback')");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brew Bliss Cafe</title>
</head>
<body>
    <h2>Brew Bliss Cafe</h2>
    <form method="POST">
        <input type="text" name="fullName" placeholder="Full Name" required><br><br>
        <input type="email" name="emailAddress" placeholder="Email Address"><br><br>
        <textarea name="feedback" placeholder="Feedback or Suggestion"></textarea><br><br>  
        <button type="submit" name="submitFeedback">Submit</button>
    </form>
</body>
</html>

