<?php
include 'connection.php';
session_start();

if (!isset($_SESSION['resident_id'])) {
    header("Location: frontpage.php"); 
    exit();
}

$resident_ID = $_SESSION['resident_id'];

$sql = "SELECT profile_photo FROM residents_info WHERE resident_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $resident_ID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $user_profile = $row['profile_photo'];
} else {
   echo "Failed to retrieve user info.";
    exit();
}

$notif_sql = "SELECT message, created_at as timestamp FROM notifications WHERE resident_ID = ? ORDER BY timestamp DESC LIMIT 5";
$notif_stmt = $conn->prepare($notif_sql);
$notif_stmt->bind_param("i", $resident_ID);
$notif_stmt->execute();
$notif_result = $notif_stmt->get_result();

$notifications = [];
while ($row = $notif_result->fetch_assoc()) {
    $notifications[] = $row;
}

$unread_sql = "SELECT COUNT(*) AS unread_count FROM notifications WHERE resident_ID = ? AND is_read = 0";
$unread_stmt = $conn->prepare($unread_sql);
$unread_stmt->bind_param("i", $resident_ID);
$unread_stmt->execute();
$unread_result = $unread_stmt->get_result();
$unread_count = $unread_result->fetch_assoc()['unread_count'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Document</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <link rel="stylesheet" href="sidebar.css">
  
</head>
<style>
  body {
    font-family: 'Poppins', sans-serif;
    background-color: #f0f4f8;
    color: #333;
  }

  #content {
    background: linear-gradient(to bottom right, #e3f2fd, #bbdefb);
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0, 123, 255, 0.1);
    color: #0d47a1;
  }

  /* Date and notification icons */
  .date-time .material-icons,
  .nav-link .material-icons {
    color: blue;
  }

  #currentDateTime {
    color: #e3f2fd;
  }

  /* Notification and Profile dropdowns */
  #notificationDropdown,
  #profileDropdown {
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(33, 150, 243, 0.15);
  }

  /* Table header */
  .table thead {
    background-color: #1565c0 !important;
    color: white;
  }

  .table-bordered th, .table-bordered td {
    border-color: #bbdefb;
  }

  /* Badge colors (already applied with logic, keeping consistent) */
  .badge.bg-warning {
    background-color: #ffe082 !important;
    color: #333;
  }
  .badge.bg-success {
    background-color: #81c784 !important;
  }
  .badge.bg-danger {
    background-color: #e57373 !important;
  }
  .badge.bg-primary {
    background-color: #64b5f6 !important;
  }
  .badge.bg-secondary {
    background-color: #90a4ae !important;
  }

  /* Profile image hover */
  .profile-img:hover {
    box-shadow: 0 0 12px rgba(33, 150, 243, 0.3);
    transition: box-shadow 0.3s;
  }

  /* Notification badge */
  .nav-link .badge {
    background-color: #ff5252;
    font-size: 0.75rem;
    border-radius: 50%;
  }

  /* Dropdown item hover */
  .dropdown-menu .dropdown-item:hover {
    background-color: #e3f2fd;
    color: #0d47a1;
  }



</style>

<body>

<div class="wrapper d-flex">
    
    <!-- Sidebar -->
    <nav id="sidebar">
  
        <div class="sidebar-header">
          <img src="img/barangayBalinad.png" class="logo-img"/>
          <div class="text-conatinerp">
            <h3>CONNECT</h3>
            <p>Balinad Daraga, Albay</p>
          </div>
        </div>

        <ul class="list-unstyled components">
            <li  class="">
                <a href="userDashboard.php" class="load-page" data-page="userDashboard.php"><i class="material-icons">dashboard</i><span>Dashboard</span></a>
            </li>
            <li  class="">
                <a href="userRequest.php" class="load-page" data-page="userRequest.php"><i class="material-icons">description</i><span>Certificates</span></a>
            </li>
            <li  class="">
                <a href="userReport.php" class="load-page" data-page="userReport.php"><i class="material-icons">report</i><span>Report</span></a>
            </li> 
            <li  class="">
              <a href="userActivityLog.php" class="load-page" data-page="userActivityLog.php"><i class="material-icons">history</i><span>Activity Log</span></a>
            </li>           
        </ul>
    </nav>

  <!--main content-->
  <div id="content" class="flex-grow-1">
   <div class="top-navbar px-3 py-2 d-flex align-items-center justify-content-between" id="topnavbar">
  <div class="d-flex align-items-center justify-content-between w-100 flex-nowrap flex-column flex-sm-row">

    <!-- Left: Sidebar toggle + Date -->
    <div class="d-flex align-items-center mb-2 mb-sm-0 flex-nowrap w-100">
      <div class="sidebarToggleContainer me-3" id="sidebarToggleContainer">
        <button id="sidebarToggle" class="btn btn-sm toggle-btn">
          <i class="material-icons" id="toggleIcon">chevron_left</i>
        </button>
      </div>

      <div class="date-time d-flex align-items-center">
        <span class="material-icons me-1">calendar_today</span>
         <span id="currentDateTime" class="small text-dark fw-medium"></span>
      </div>
    </div>

    <!-- Right side: Notification + Profile -->
          <div class="xp-profilebar d-flex align-items-center ms-auto">
            <nav class="navbar p-0">
              <!-- Notification -->
                <li class="nav-item dropdown me-3" style="position: relative;">
                  <a href="#" class="nav-link" id="notificationToggle">
                    <span class="material-icons">notifications</span>
                    <?php if ($unread_count > 0): ?>
                      <span class="badge bg-danger" style="position: absolute; top: 0; right: 0; font-size: 0.7rem;">
                        <?php echo $unread_count; ?>
                      </span>
                    <?php endif; ?>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" id="notificationDropdown">
                    <?php if (!empty($notifications)): ?>
                      <?php foreach ($notifications as $notif): ?>
                        <li>
                          <a class="dropdown-item" href="#">
                            <div class="d-flex justify-content-between">
                              <span><?php echo htmlspecialchars($notif['message']); ?></span>
                              <small class="text-muted"><?php echo date("M d", strtotime($notif['timestamp'])); ?></small>
                            </div>
                          </a>
                        </li>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <li><a class="dropdown-item text-muted" href="#">No new notifications</a></li>
                    <?php endif; ?>
                  </ul>
                </li>

          <!-- Profile Dropdown -->
          <li class="nav-item dropdown position-relative">
            <a class="nav-link d-flex align-items-center" href="#" id="profileToggle">
              <img src="img/<?php echo htmlspecialchars($user_profile); ?>" alt="Profile Picture"
                   class="img-fluid profile-img"
                   style="width:50px; height: 50px; border-radius:50%; box-shadow: 0 0 8px rgba(0, 0, 0, 0.15);"/>
              <span class="xp-user-live ms-1"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end small-menu position-absolute" id="profileDropdown">
              <li><a class="dropdown-item" href="userProfile.php"><span class="material-icons me-2">person_outline</span>Profile</a></li>
              <li><a class="dropdown-item" href="userSettings.php" data-page="userSettings.php"><span class="material-icons me-2">settings</span>Settings</a></li>
              <li><a class="dropdown-item" href="frontpage.php"><span class="material-icons me-2">logout</span>Logout</a></li>
            </ul>
          </li>

        </ul>
      </nav>
    </div>

  </div>
</div>    
    <!--end of top-navbar-->
      <div class="main-content p-4" id="maincontent">
        <div class="container">
          <h4 class="mb-4 text-center py-3">RECENT ACTIVITIES</h4>
          <div class="table-responsive">
            <table class="table table-bordered align-middle">
              <thead class="table-dark">
                <tr>
                 <th style="width: 3%;">#</th>
                  <th style="width: 55%;">Activity</th>
                  <th style="width: 25%;">Date & Time</th>
                  <th style="width: 15%;">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
               
                $logQuery = "SELECT al.id, al.activity_description, al.activity_date, fr.status 
                            FROM activity_log al 
                            LEFT JOIN file_requests fr ON al.request_ID = fr.id 
                            WHERE al.resident_ID = ? 
                            ORDER BY al.activity_date DESC";

                $stmt = $conn->prepare($logQuery);
                $stmt->bind_param("i", $resident_ID);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                   $counter = 1;
                    while ($row = $result->fetch_assoc()) {
                        $desc = htmlspecialchars($row['activity_description']);
                        $datetime = date("F j, Y - g:i A", strtotime($row['activity_date']));
                        $status = htmlspecialchars($row['status'] ?? "N/A");

                        $badgeClass = match ($status) {
                            'Pending' => 'bg-warning text-dark',
                            'Approved' => 'bg-success',
                            'Rejected' => 'bg-danger',
                            'Claimed' => 'bg-primary text-white', 
                            default => 'bg-secondary'
                        };

                        echo "<tr>
                                <td>{$counter}</td>
                                <td>{$desc}</td>
                                <td>{$datetime}</td>
                                <td><span class='badge {$badgeClass}'>{$status}</span></td>
                              </tr>";
                        $counter++;
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center text-muted'>No activities logged yet.</td></tr>";
                }

                $stmt->close();
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    
    
  <!-- Bootstrap JS -->
   <!-- Bootstrap JS Bundle (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="sidebar.js"></script>

<script>
document.getElementById("notificationToggle").addEventListener("click", function(e) {
    fetch("mark_notifications_read.php", { method: "POST" })
        .then(res => res.text())
        .then(data => {
            if (data.trim() === "success") {
                var badge = this.querySelector(".badge");
                if (badge) badge.style.display = "none";
            }
        });
});
</script>
  
  
</body>
</html>



