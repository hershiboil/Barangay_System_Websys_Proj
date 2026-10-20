<?php
include 'connection.php';
session_start();

if (!isset($_SESSION['resident_id'])) {
    header("Location: frontpage.php"); 
    exit();
}

$resident_ID = $_SESSION['resident_id'];


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT title, content, dateToday FROM announcement WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $announcement = $result->fetch_assoc();
} else {
    die("Invalid announcement ID.");
}

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
  <title>Settings</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


  <link rel="stylesheet" href="sidebar.css">

  <style>
  body {
    background-color: #e6f0ff !important; /* Soft blue background */
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
  }

  .main-content {
    min-height: 100vh;
    padding: 2rem 1rem;
    display: flex;
    justify-content: center;
    align-items: flex-start;
  }

  .announcement-full {
    max-width: 850px;
    width: 100%;
    background: #ffffff;
    padding: 2.5rem;
    border-radius: 16px;
    border-left: 6px solid #0d6efd;
    box-shadow: 0 8px 24px rgba(13, 110, 253, 0.1);
    transition: box-shadow 0.3s ease;
  }

  .announcement-full:hover {
    box-shadow: 0 12px 28px rgba(13, 110, 253, 0.2);
  }

  .back-link {
    display: inline-block;
    margin-bottom: 1.5rem;
    color: #0d6efd;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.2s ease;
  }

  .back-link:hover {
    text-decoration: underline;
    color: #0b5ed7;
  }

  .announcement-full h2 {
    color: #0d6efd;
    font-size: 2rem;
    margin-bottom: 1rem;
    font-weight: 700;
  }

  .announcement-full p.text-muted {
    font-size: 0.95rem;
    color: #6c757d;
    margin-bottom: 1rem;
  }

  .announcement-body {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #333;
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: pre-wrap;
  }

  hr.text-primary {
    border-top: 2px solid #0d6efd;
    margin: 1.5rem 0;
    opacity: 0.5;
  }

  @media screen and (max-width: 576px) {
    .announcement-full {
      padding: 1.5rem;
      border-radius: 10px;
    }

    .announcement-full h2 {
      font-size: 1.5rem;
    }

    .announcement-body {
      font-size: 1rem;
    }
  }
</style>

  
</head>
<style>
 
    .card {
  border-radius: 0.75rem;
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
    <div class="top-navbar px-3 py-2 d-flex align-items-center justify-content-between" id="topnavbar" >
        <div class="d-flex justify-content-between align-items-center flex-wrap flex-md-nowrap w-100">
      
          <!-- Left side: Toggle + Calendar -->
          <div class="d-flex align-items-center">
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
                  <a class="nav-link d-flex align-items-center" href="#"
                   id="profileToggle">
                     <img src="img/<?php echo htmlspecialchars($user_profile); ?>" alt="Profile Picture" class="img-fluid profile-img" style="width:50px; height: 50px; border-radius:50%; box-shadow: 0 0 8px rgba(0, 0, 0, 0.15);"/>
                    <span class="xp-user-live ms-1"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end small-menu position-absolute" id="profileDropdown">
                    <li><a class="dropdown-item" href="userProfile.php"><span class="material-icons me-2">person_outline</span>Profile</a></li>
                     <li><a class="dropdown-item" href="userSettings.php" data-page="userSettings.php"><span class="material-icons me-2">settings</span>Settings</a></li>
                    <li><a class="dropdown-item" href="frontpage.php" data-page="frontpage.php"><span class="material-icons me-2">logout</span>Logout</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
      
        </div>
      </div>      
    <!--end of top-navbar-->

   <div class="main-content p-4" id="maincontent" style="min-height: 100vh; background: #e6f0ff;">
  <div class="container-fluid h-100 d-flex justify-content-center align-items-start pt-5">
    <div class="announcement-full bg-white shadow-lg p-5 rounded-4 w-100" style="max-width: 900px;">
      <a href="userDashboard.php" class="back-link mb-3 d-inline-block" style="color: #0d6efd; text-decoration: none;">
        ← Back to Announcements
      </a>
      <h2 class="text-primary mb-3"><?php echo htmlspecialchars($announcement['title']); ?></h2>
      <p class="text-muted mb-2">
        <small><strong>Date:</strong> <?php echo date("F j, Y", strtotime($announcement['dateToday'])); ?></small>
      </p>
      <hr class="text-primary">
      <div class="announcement-body fs-5" style="line-height: 1.7; color: #333;">
        <?php echo nl2br(htmlspecialchars($announcement['content'])); ?>
      </div>
    </div>
  </div>
</div>
    
  <!-- Bootstrap JS -->
   <!-- Bootstrap JS Bundle (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="sidebar.js"></script>

<script>
  setTimeout(function () {
    const alertBox = document.getElementById("alertBox");
    if(alertBox){
      alertBox.classList.remove('show');
       setTimeout(() => alertBox.remove(), 500);
    }

  }, 3000);

 document.querySelectorAll('.toggle-password').forEach(icon => {
    icon.addEventListener('click', () => {
      const input = document.getElementById(icon.getAttribute('data-target'));
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
      } else {
        input.type = 'password';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
      }
    });
  });
</script>

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

