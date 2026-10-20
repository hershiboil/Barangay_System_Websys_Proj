<?php
session_start();
include 'connection.php';

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

$sql = "SELECT request_type, status 
        FROM file_requests 
        WHERE resident_ID = ? 
        ORDER BY request_date DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $resident_ID);
$stmt->execute();

$result = $stmt->get_result();

$requestStatuses = [];

while ($row = $result->fetch_assoc()) {
    if (!isset($requestStatuses[$row['request_type']])) {
        $requestStatuses[$row['request_type']] = $row['status'];
    }
}

$stmt->close();

function getStatusColor($status) {
    return match($status) {
        'Pending' => 'background-color:rgb(246, 208, 84);;',
        'Approved' => 'background-color: green; color: white;',
        'Rejected' => 'background-color: red; color: white;',
        'Claimed' => 'background-color: green; color: white;',
        default => 'background-color: gray;'
    };
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

  <!-- Fonts & Bootstrap -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="sidebar.css">

  <style>
    :root {
      --primary-blue: #007BFF;
      --primary-blue-dark: #0056b3;
      --blue-bg-light: #f0f6ff;
      --blue-border: #cce0ff;
      --white: #ffffff;
    }

    body {
      background-color: var(--blue-bg-light);
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 2px;
    }

    .card-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
      padding: 211px 20px;
      margin: auto;
      background: linear-gradient(to bottom right, #e3f2fd, #bbdefb);
      border-radius: 16px;
      object-fit: contain;
    }
    .card {
      width: 250px;
      height: 360px;
      perspective: 1000px;
      transition: transform 0.3s ease-in-out;
    }
    .card-inner {
      position: relative;
      width: 100%;
      height: 100%;
      text-align: center;
      transition: transform 0.6s ease;
      transform-style: preserve-3d;
      cursor: pointer;
    }
    .card:hover .card-inner {
      transform: rotateY(180deg);
    }
    .card-front, .card-back {
      position: absolute;
      width: 100%;
      height: 100%;
      backface-visibility: hidden;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 91, 187, 0.2);
      background-color: var(--white);
    }
    .card-front img {
      width: 250px;
      height: 360px;
      border-radius: 10px;
      object-fit: contain;
    }
    .card-back {
      transform: rotateY(180deg);
      background-color:var(--blue-border);
      color: var(--primary-blue-dark);
      padding: 15px;
    }
    .request-btn {
      background-color: var(--white);
      color: var(--primary-blue);
      border: 2px solid var(--primary-blue);
      padding: 8px 12px;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
      font-size: 14px;
      transition: all 0.3s ease;
    }
    .status-label {
      text-align: center;
      margin-top: 10px;
      padding: 8px;
      border-radius: 5px;
      font-weight: bold;
      background-color: var(--blue-bg-light);
      color: var(--primary-blue);
      border: 1px solid var(--blue-border);
    }

    .modal {
      display: none; /* Hidden by default */
      position: fixed;
      z-index: 9999;
      left: 0;
      top: 0;
      width: 100vw;
      height: 100vh;
      overflow: auto;
      background: rgba(0,0,0,0.3); /* Dim background */
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background: #fff;
      border-radius: 8px;
      padding: 24px;
      max-width: 500px;
      margin: auto;
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
      position: relative;
    }

    .modal.show {
      display: flex !important;
    }

    .modal-title {
      margin-bottom: 16px;
      font-size: 20px;
      font-weight: bold;
    }

    .form-group {
      margin-bottom: 16px;
      
    }

    .form-group label {
      margin-bottom: 20px;
      font-size: 22px;
      font-weight: bold;
      color: var(--primary-blue-dark);
    }

    .form-group input {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid var(--blue-border);
      border-radius: 6px;
      font-size: 14px;
      background-color: var(--blue-bg-light);
    }

    .modal-actions {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 20px;
    }

    .btn-submit, .btn-cancel {
      padding: 10px 18px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }

    .btn-submit {
      background-color: var(--primary-blue);
      color: var(--white);
    }

    .btn-cancel {
      background-color: #d9e6f7;
      color: var(--primary-blue-dark);
    }

    .close-button {
      color: #aaa;
      position: absolute;
      top: 15px;
      right: 20px;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
    }

    .close-button:hover,
    .close-button:focus {
      color: var(--primary-blue-dark);
      text-decoration: none;
      cursor: pointer;
    }

    @media (max-width: 768px) {
      .card-container {
        padding: 15px 10px;
      }

      .card {
        width: 90%;
        max-width: 300px;
      }
    }
  </style>

  <div id="popupMessage" style="
        display: none;
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        color: green;
        padding: 10px 20px;
        border-radius: 6px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        z-index: 9999;
        font-size: 14px;
"></div>

</head>
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
                    <li><a class="dropdown-item" href="frontpage.php" data-page= "frontpage.php"><span class="material-icons me-2">logout</span>Logout</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
      
        </div>
      </div>      
    <!--end of top-navbar-->

      <!-- Main content -->
      <div class="main-content p-4" id="maincontent">
        <div class="card-container">

          <!-- INDIGENCY -->
          <div class="card">
            <div class="card-inner">
              <div class="card-front">
                <img src="img/indigency.png" alt="Indigency">
              </div>
              <div class="card-back">
                <p>A document issued by the barangay stating that a person is financially incapable or belongs to a low-income household.</p>

                 <?php if (!isset($requestStatuses['indigency'])): ?>
                <!-- If no request has been made yet (status is not set), show the "Request" button -->
                <button class="request-btn" name="indigency" onclick="submitRequest('indigency')">Request</button>
              <?php elseif ($requestStatuses['indigency'] === 'Claimed'): ?>
                <!-- If the status is "Claimed", show the "Request Again" button -->
                <button class="request-btn" name="indigency" onclick="submitRequest('indigency')">Request Again</button>
              <?php else: ?>
                <!-- If the status is anything else (e.g., Pending, Approved, etc.), show the status label only -->
                <div class="status-label" style="<?= getStatusColor($requestStatuses['indigency']) ?>">
                  Status: <?= ucfirst($requestStatuses['indigency']) ?>
                </div>
              <?php endif; ?>
              </div>
            </div>
          </div>

          <!-- RESIDENCY -->
          <div class="card">
            <div class="card-inner">
              <div class="card-front">
                <img src="img/residency.png" alt="Residency">
              </div>
              <div class="card-back">
                <p>A document that certifies a person is a resident of a specific barangay, required for legal, educational, or employment purposes.</p>

                <?php if (!isset($requestStatuses['residency'])): ?>
                <!-- If no request has been made yet (status is not set), show the "Request" button -->
                <button class="request-btn" name="residency" onclick="submitRequest('residency')">Request</button>
              <?php elseif ($requestStatuses['residency'] === 'Claimed'): ?>
                <!-- If the status is "Claimed", show the "Request Again" button -->
                <button class="request-btn" name="residency" onclick="submitRequest('residency')">Request Again</button>
              <?php else: ?>
                <!-- If the status is anything else (e.g., Pending, Approved, etc.), show the status label only -->
                <div class="status-label" style="<?= getStatusColor($requestStatuses['residency']) ?>">
                  Status: <?= ucfirst($requestStatuses['residency']) ?>
                </div>
              <?php endif; ?>

              </div>
            </div>
          </div>

          <!-- CLEARANCE -->
        <div class="card">
          <div class="card-inner">
            <div class="card-front">
              <img src="img/clearance.png" alt="Clearance">
            </div>
            <div class="card-back">
              <p>A certification that a person has no pending complaints or violations in the barangay, needed for employment, travel, or business.</p>
              
               <?php if (!isset($requestStatuses['clearance'])): ?>
                <!-- If no request has been made yet (status is not set), show the "Request" button -->
                <button class="request-btn" name="clearance" onclick="submitRequest('clearance')">Request</button>
              <?php elseif ($requestStatuses['clearance'] === 'Claimed'): ?>
                <!-- If the status is "Claimed", show the "Request Again" button -->
                <button class="request-btn" name="clearance" onclick="submitRequest('clearance')">Request Again</button>
              <?php else: ?>
                <!-- If the status is anything else (e.g., Pending, Approved, etc.), show the status label only -->
                <div class="status-label" style="<?= getStatusColor($requestStatuses['clearance']) ?>">
                  Status: <?= ucfirst($requestStatuses['clearance']) ?>
                </div>
              <?php endif; ?>
              
            </div>
          </div>
        </div>

          <!-- BUSINESS PERMIT -->
          <div class="card">
            <div class="card-inner">
              <div class="card-front">
                <img src="img/businessPermit.png" alt="Business Permit">
              </div>
              <div class="card-back">
                <p>A document granting permission to operate a business in the barangay, usually required before obtaining a mayor's permit.</p>

                <?php if (!isset($requestStatuses['businessPermit'])): ?>
                <!-- If no request has been made yet (status is not set), show the "Request" button -->
                <button class="request-btn" name="businessPermit" onclick="submitRequest('businessPermit')">Request</button>
              <?php elseif ($requestStatuses['businessPermit'] === 'Claimed'): ?>
                <!-- If the status is "Claimed", show the "Request Again" button -->
                <button class="request-btn" name="businessPermit" onclick="submitRequest('businessPermit')">Request Again</button>
              <?php else: ?>
                <!-- If the status is anything else (e.g., Pending, Approved, etc.), show the status label only -->
                <div class="status-label" style="<?= getStatusColor($requestStatuses['businessPermit']) ?>">
                  Status: <?= ucfirst($requestStatuses['businessPermit']) ?>
                </div>
              <?php endif; ?>
              </div>
            </div>
          </div>

        </div>
      </div>
     </div>
  </div>

 <div id="editModal" class="modal">
<div class="modal-content">
  <span class="close-button" id="closeModal">&times;</span>
  <h2 id="modalTitle" class="modal-title"></h2>
  <form id="requestForm">
    <input type="hidden" id="requestType" name="requestType">
    <div id="dynamicFields" class="form-fields"></div>
    <div class="modal-actions">
      <button type="submit" class="btn-submit">Submit</button>
      <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
    </div>
  </form>
</div>
</div>


  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="sidebar.js"></script>
  <script>

        function submitRequest(type) {
          const modal = document.getElementById("editModal");
          const dynamicFields = document.getElementById("dynamicFields");
          const requestType = document.getElementById("requestType");
          const modalTitle = document.getElementById("modalTitle");

          modal.classList.add("show"); // Use flex centering
          requestType.value = type;

          // Update modal title
          modalTitle.textContent = `Request ${type.charAt(0).toUpperCase() +  type.slice(1)} Certificate`;

          // Insert fields dynamically based on type
          if (type === 'businessPermit') {
            dynamicFields.innerHTML = `
                <div class="form-group" >
                <label for="businessName">Business Name</label>
                <input type="text" id="business_name" name="business_name" required>
              </div>
              <div class="form-group">
                <label for="businessLocation">Business Location</label>
                <input type="text" id="business_location" name="business_location" required>
              </div>
            `;
          } else {
            dynamicFields.innerHTML = `
              <div class="form-group">
                <label for="purpose">Purpose</label>
                <input type="text" id="purpose" name="purpose" required>
              </div>
            `;
          }
        }

        function closeModal() {
          document.getElementById("editModal").classList.remove("show");
        }

        document.getElementById("closeModal").onclick = closeModal;
        window.onclick = function(event) {
          if (event.target == document.getElementById("editModal")) {
            closeModal();
          }
        };

        function showPopup(message) {
          const popup = document.getElementById("popupMessage");
          popup.textContent = message;
          popup.style.display = "block";

          setTimeout(() => {
            popup.style.display = "none";
          }, 2000); // hides after 2 seconds
        }
            
        const form = document.getElementById("requestForm");

        form.addEventListener("submit", function (e) {
          e.preventDefault();

          const formData = new FormData(form);

          fetch("submit_requests.php", {
            method: "POST",
            body: formData
          })
            .then(response => response.text())
            .then(data => {
            showPopup("Request submitted successfully.");
            closeModal();
            setTimeout(() => location.reload(), 3000); 
          })
          .catch(error => {
            console.error("Error:", error);
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

