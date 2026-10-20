<?php
$host = 'localhost';
$user ='root';
$pass = '';
$db = 'brew_bliss_db';

$conn = new mysqli($host, $user, $pass, $db);
if($conn -> connect_error){
    die("Connection failed: " . $conn -> connect_error);
}

$conn -> close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brew Bliss Cafe</title>
</head>
<body>
    <h2>Feedback List</h2>

    <?php
    $sql = "SELECT * FROM feedbacks";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Feedback</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['feedback']) . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No feedback available.";
    }
    ?>

</body>
</html>