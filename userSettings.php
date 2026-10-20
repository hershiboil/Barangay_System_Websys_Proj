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
  <title>Settings</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


  <link rel="stylesheet" href="sidebar.css">
  
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

    <div class="main-content p-4" id="maincontent">
  <div class="container mt-4">
    <?php
      if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertBox">
          Settings updated successfully.
        </div>
      <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertBox">
          Error: <?= htmlspecialchars($_GET['error']) ?>
        </div>
      <?php endif; ?>
    
    <div class="card shadow-sm border-0">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Settings</h5>
      </div>
      <div class="card-body">
        <form action="save_settings.php" method="POST">
          
          <h6 class="mb-3 text-uppercase fw-bold">Change Password</h6>

          <div class="mb-3 position-relative">
          <label for="current_password" class="form-label">Current Password</label>
          <input type="password" name="current_password" id="current_password" class="form-control" required style="padding-right: 2.5rem;">
          
          <i class="bi bi-eye-slash toggle-password position-absolute" data-target="current_password"
            style="top: 73%; right: 0.75rem; transform: translateY(-50%); cursor: pointer;"></i>
        </div>

        <div class="mb-4 position-relative">
          <label for="new_password" class="form-label">New Password</label>
          <input
            type="password"
            name="new_password"
            id="new_password"
            class="form-control"
            required
            style="padding-right: 2.5rem;"
          >
          <i
            class="bi bi-eye-slash toggle-password position-absolute"
            data-target="new_password"
            style="top: 73%; right: 0.75rem; transform: translateY(-50%); cursor: pointer;"
          ></i>
        </div>

        <h6 class="mb-3 text-uppercase fw-bold">Preferences</h6>
        <div class="form-check form-switch mb-4">
          <input class="form-check-input" type="checkbox" name="notifications" id="notifications">
          <label class="form-check-label" for="notifications">Enable notifications</label>
        </div>

        <!-- Save Button -->
        <div class="text-end">
          <button type="submit" class="btn btn-primary px-4">
            Save Changes
          </button>
        </div>

        </form>
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



