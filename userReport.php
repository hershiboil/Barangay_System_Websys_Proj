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
  <link rel="stylesheet" href="userReport.css">
  
</head>
<style>
  .btn.active {
      background-color: #cce5ff;
      font-weight: bold;
  }


</style>

<body>

<div class="wrapper d-flex">
    
    <!-- Sidebar -->
    <nav id="sidebar">
  
        <div class="sidebar-header">
          <img src="img/barangayBalinad.png" class="logo-img"/>
          <div class="text-conatinerp">
            <h3   style="color: white";>CONNECT</h3>
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
            <h3 class="mb-4 text-center py-3" style="color: #1976d2;
              font-weight: 700;
              letter-spacing: 1px;
              background: linear-gradient(90deg, #e3f2fd 60%, #bbdefb 100%);
              border-radius: 16px;
              box-shadow: 0 2px 12px rgba(25, 118, 210, 0.07);
              margin: 0 auto 2rem auto;">REPORT INCIDENT</h3>
            <div class="mb-3">
              <!--<a href="csv_complaints.php" class="btn btn-success">
                 // Download CSV Report
              </a>
            -->
          </div>
        
            <form id="incidentForm" action="submit.php" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                  <label for="complaintType" class="form-label fw-bold">Complaint Type:</label>
                  <select class="form-select" id="complaintType" name="complaintType" onchange="toggleOtherInput()">
                      <option selected disabled>Select</option>
                      <option value="Noise Disturbance">Noise Disturbance</option>
                      <option value="Vandalism">Vandalism</option>
                      <option value="Theft">Theft</option>
                      <option value="Illegal Parking">Illegal Parking</option>
                      <option value="Others">Others</option>
                  </select>
              </div>
      
              <div class="mb-3 d-none" id="otherComplaintDiv">
                  <label for="otherComplaint" class="form-label fw-bold">Please specify your complaint:</label>
                  <input type="text" class="form-control" id="otherComplaint" name="otherComplaint" placeholder="Enter your complaint">
              </div>
      
              <!-- Description with live formatting -->
              <div class="mb-3">
              <label class="form-label fw-bold">Description:</label>
              <div class="btn-group mb-2">
                <button type="button" class="btn btn-light" onclick="formatText(event, 'bold')"><b>B</b></button>
                <button type="button" class="btn btn-light" onclick="formatText(event, 'italic')"><i>I</i></button>
                <button type="button" class="btn btn-light" onclick="formatText(event, 'underline')"><u>U</u></button>
              </div>
                <div id="description" contenteditable="true" class="form-control" style="min-height: 150px;"></div>
              </div>
      
              <div class="mb-3">
                  <label class="form-label fw-bold">Upload Supporting Documents:</label>
                  <div class="border p-3 d-flex flex-column align-items-center justify-content-center"
                      style="border-radius: 10px; border: 2px dashed #1976d2; min-height: 150px; padding: 12px; background-color: #fff;">
                      <input type="file" id="fileUpload" name="files[]" class="d-none" multiple>
                      <button type="button" class="btn btn-outline-primary"
                              onclick="document.getElementById('fileUpload').click()">
                          <i class="fas fa-plus"></i> +
                      </button>
                  </div>
              </div>
      
              <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          <div id="popup">
                
            </div>
      </div>
      
  </div>
  
</div>
    
    
  <!-- Bootstrap JS -->
   <!-- Bootstrap JS Bundle (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="sidebar.js"></script>

<script>
  function formatText(event, command) {
    event.preventDefault();
    const desc = document.getElementById("description");
    desc.focus();
    document.execCommand(command, false, null);
  }

  // Save the HTML of the contenteditable div into the hidden input on submit
  document.getElementById("incidentForm").addEventListener("submit", function (e) {
    const htmlDescription = document.getElementById("description").innerHTML;
    document.getElementById("descriptionInput").value = htmlDescription;
  });

  function toggleOtherInput() {
  const complaintType = document.getElementById('complaintType').value;
  const otherDiv = document.getElementById('otherComplaintDiv');
  otherDiv.classList.toggle('d-none', complaintType !== 'Others');
}

document.getElementById("incidentForm").addEventListener("submit", function (e) {
  const descDiv = document.getElementById("description");
  const hiddenInput = document.createElement("input");
  hiddenInput.type = "hidden";
  hiddenInput.name = "description";
  hiddenInput.value = descDiv.innerHTML;
  this.appendChild(hiddenInput);
});

 document.getElementById("incidentForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const form = document.getElementById("incidentForm");
  const formData = new FormData(form);
  const complaintType = document.getElementById("complaintType").value;
  const otherComplaintDiv = document.getElementById("otherComplaintDiv");
  const otherComplaint = document.getElementById("otherComplaint") ? document.getElementById("otherComplaint").value.trim() : "";
  const descriptionHTML = document.getElementById("description").innerHTML.trim();
  const fileInput = document.getElementById("fileUpload");
  const popup = document.getElementById("popup");

  // Validation
  if (!complaintType || complaintType === "Select") {
    popup.textContent = "Please select a complaint type.";
    popup.style.display = "block";
    popup.style.color = "red";
    setTimeout(() => { popup.style.display = "none"; }, 3000);
    return;
  }

  if (complaintType === "Others" && otherComplaint === "") {
    popup.textContent = "Please specify your complaint.";
    popup.style.display = "block";
    popup.style.color = "red";
    setTimeout(() => { popup.style.display = "none"; }, 3000);
    return;
  }

  if (!descriptionHTML || descriptionHTML === "<br>") {
    popup.textContent = "Please enter a description.";
    popup.style.display = "block";
    popup.style.color = "red";
    setTimeout(() => { popup.style.display = "none"; }, 3000);
    return;
  }

  if (fileInput.files.length === 0) {
    popup.textContent = "Please upload at least one supporting document.";
    popup.style.display = "block";
    popup.style.color = "red";
    setTimeout(() => { popup.style.display = "none"; }, 3000);
    return;
  }

  formData.append("description", descriptionHTML);

  fetch("submit_complaints.php", {
    method: "POST",
    body: formData
  })
  .then(res => res.text())
  .then(data => {
    if (data.trim() === "success") {
      var message = "Complaint submitted successfully!";
      popup.textContent = message;
      popup.style.display = "block";
      popup.style.color = "green";
      setTimeout(function () {
        popup.style.display = "none";
      }, 3000);

      // Reset the form
      form.reset();
      document.getElementById("description").innerHTML = "";
      document.getElementById("otherComplaintDiv").classList.add("d-none");
    } else {
      alert("Submission failed: " + data);
    }
  })
  .catch(err => {
    alert("An error occurred. Check console.");
    console.error(err);
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



