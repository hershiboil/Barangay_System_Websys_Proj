<?php
function get_param($key) {
    return isset($_GET[$key]) ? htmlspecialchars(urldecode($_GET[$key])) : 'N/A';
}

$name = get_param('name');
$email = get_param('email');
$subject = get_param('subject');
$message = get_param('message');
$date = get_param('date');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Full Message View</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f9f9f9; }
        .container { background: #fff; padding: 20px; border-radius: 8px; max-width: 600px; margin: auto; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; }
        .info { margin-bottom: 15px; }
        .info strong { display: inline-block; width: 80px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>📬 Full Message</h2>
        <div class="info"><strong>Name:</strong> <?= $name ?></div>
        <div class="info"><strong>Email:</strong> <?= $email ?></div>
        <div class="info"><strong>Subject:</strong> <?= $subject ?></div>
        <div class="info"><strong>Date:</strong> <?= $date ?></div>
        <div><strong>Message:</strong><br><p><?= nl2br($message) ?></p></div>
        <br>
        <a href="adminDashboard.php">← Back to Notifications</a>
    </div>
</body>
</html>
