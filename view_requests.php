<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'baranagay_db'; 

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, request_type, request_date, claim_date, status FROM requests ORDER BY claim_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Requests</title>
    <style>
        .notification-item {
            padding: 12px;
            border-bottom: 1px solid #eee;
            margin-bottom: 10px;
        }
        .notification-item div {
            margin: 5px 0;
        }
        .action-buttons {
            margin-top: 10px;
        }
        .reason-form {
            margin-top: 10px;
            display: none;
        }
    </style>
</head>
<body>
    <h1>Requests for Approval</h1>

    <?php if ($result->num_rows > 0) : ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Request Type</th>
                    <th>Request Date</th>
                    <th>Claim Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['request_type']); ?></td>
                        <td><?php echo date("M d, Y | H:i", strtotime($row['request_date'])); ?></td>
                        <td>
                        <?php 
                            if ($row['status'] === 'approved' && !empty($row['claim_date'])) {
                                echo date("M d, Y | H:i", strtotime($row['claim_date']));
                            } else {
                                echo ''; 
                            }
                        ?>
                        </td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td class="action-buttons">
                        
                        <button type="button" onclick="showApproveForm(<?php echo $row['id']; ?>)">Approve</button>

                       
                        <button type="button" onclick="showRejectForm(<?php echo $row['id']; ?>)">Reject</button>

                        
                        <div class="reason-form" id="reason-form-<?php echo $row['id']; ?>" style="display: none; margin-top: 10px;">
                        <form action="submit_requests.php" method="POST">
                            <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="status" value="rejected">
                            <label for="reason-<?php echo $row['id']; ?>">Reason for Rejection:</label>
                            <textarea name="reason" id="reason-<?php echo $row['id']; ?>" rows="3" cols="40" required></textarea><br>
                            <button type="submit">Submit Rejection</button>
                        </form>
                        </div>

                       
                        <div id="approve-form-<?php echo $row['id']; ?>" style="display: none; margin-top: 10px;">
                            <form action="submit_requests.php" method="POST">
                            <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="status" value="approved">
                            
                            <label for="claim_date_<?php echo $row['id']; ?>">Set Claim Date:</label><br>
                            <input type="datetime-local" name="claim_date" id="claim_date_<?php echo $row['id']; ?>" required><br>
                            
                            <button type="submit" name="approved">Submit Approval</button>
                            </form>
                        </div>
                    </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No requests found.</p>
    <?php endif; ?>

    <script>
      
        document.querySelectorAll('.approve-btn').forEach(button => {
            button.addEventListener('click', function() {
                const requestId = this.getAttribute('data-id');
               
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "update_request_status.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function() {
                    if (xhr.status == 200) {
                        alert('Request approved successfully!');
                        location.reload();  
                    } else {
                        alert('Error approving request');
                    }
                };
                xhr.send("id=" + requestId + "&status=approved");
            });
        });

        // Reject Request
        document.querySelectorAll('.reject-btn').forEach(button => {
            button.addEventListener('click', function() {
                const requestId = this.getAttribute('data-id');
                document.getElementById('reason-form-' + requestId).style.display = 'block';
            });
        });

        // Submit rejection reason
        document.querySelectorAll('.submit-reason').forEach(button => {
            button.addEventListener('click', function() {
                const requestId = this.getAttribute('data-id');
                const reason = document.getElementById('reason-' + requestId).value;

                if (reason.trim() === '') {
                    alert('Please provide a reason for rejection.');
                    return;
                }

                
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "update_request_status.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function() {
                    if (xhr.status == 200) {
                        alert('Request rejected successfully!');
                        location.reload();  
                    } else {
                        alert('Error rejecting request');
                    }
                };
                xhr.send("id=" + requestId + "&status=rejected&reason=" + encodeURIComponent(reason));
            });
        });

                function showApproveForm(id) {
                const form = document.getElementById('approve-form-' + id);
                if (form) {
                form.style.display = form.style.display === 'none' ? 'block' : 'none';
                }
                
        }

                function showRejectForm(id) {
                document.getElementById('reason-form-' + id).style.display = 'block';
            }
    </script>
</body>
</html>

<?php

$conn->close();
?>
