<?php
include 'connection.php';
session_start();

if (!isset($_SESSION['resident_ID'])) {
    header("Location: frontpage.php"); 
    exit();
}

$resident_ID = $_SESSION['resident_ID'];

$sql = "SELECT 
          r.first_name, 
          r.middle_name, 
          r.last_name, 
          r.suffix,
          r.province, 
          r.municipality,
          r.barangay,
          r.purok, 
          r.street,
          r.profile_photo, 
          r.gender, 
          r.birthdate, 
          r.birthplace,
          r.civil_status, 
          r.religion, 
          r.nationality, 
          r.contact_number,
          u.password
        FROM residents_info r
        JOIN users1 u ON r.resident_ID = u.resident_ID
        WHERE r.resident_ID = ?";
    
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $resident_ID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $firstName = $row['first_name'];
    $middleName = $row['middle_name'];
    $middleInitial = strtoupper(substr($row['middle_name'], 0, 1)) . ".";
    $lastName = $row['last_name'];
    $suffix = $row['suffix'];
    $address = $row['street'] . ', Purok ' . $row['purok'] . ', ' . $row['barangay'] . ', ' . $row['municipality'] . ', ' . $row['province'];
    $user_profile = $row['profile_photo'];
    $gender = $row['gender'];
    $dob = new DateTime($row['birthdate']);
    $today = new DateTime();
    $age = $today->diff($dob)->y;
    $civil_status = $row['civil_status'];
    $birth_place = $row['birthplace'];
    $religion = $row['religion'];
    $nationality = $row['nationality'];
    $contact = $row['contact_number'];
    $purok = $row['purok'];
    $street = $row['street'];
    $barangay = $row['barangay'];
    $password = $row['password'];
} else {
    $firstName = "Unknown";
    $middleInitial = "";
    $lastName = "User";
    $address = "Unknown Address";
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

  <style>
   span { 
  color: white; 
}

.profile { 
  margin-top: 20px; 
  margin-left: 20px; 
  font-weight: bolder; 
}

/* Profile Top Styles */
.profile-top {
  padding: 20px;  /* Increased padding for better spacing */
  background-color: white;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  border-radius: 10px;
  max-width: 98%;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.profile-top img {
  height: 70px; 
  width: 70px; 
  border-radius: 100px;
  margin-right: 20px; /* Space between the image and text */
}

.profile-top h5 {
  margin-bottom: 5px; /* Adds space between the name and ID */
}

.profile-top .badge {
  margin-right: 10px; /* Adds space between ID badge and text */
}

.profile-top p {
  margin-top: 5px; /* Adds space between the address and the name/badge */
}

/* Profile Container Styles */
.profile-container {
  display: flex;
  flex-wrap: wrap;
  gap: 15px;
}

.profile-left, .profile-right {
  padding: 20px; /* Added padding for consistency and better spacing */
  background-color: white;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  border-radius: 10px;
}

.profile-left {
  flex: 2 1 60%;
  max-width: 60%;
  min-height: 400px;
}

.profile-left i {
  color: cornflowerblue;
  margin-left: 20px;
}

.profile-left span {
  color: black;
}

.profile-right {
  flex: 1 1 35%;
  max-width: 36%;
  min-height: 320px;
}

/* Add a small gap between the profile sections */
.profile-left, .profile-right {
  margin-top: 25px;
}
    .modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.4); /* Black background with opacity */
  padding-top: 60px;
}

.modal-content {
  background-color: #fff;
  margin: 5% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 600px;
}

.close {
  color: #aaa;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

  </style>
</head>
<body>

<div class="wrapper d-flex">
  <nav id="sidebar">
    <div class="sidebar-header">
      <img src="img/barangayBalinad.png" class="logo-img"/>
      <div class="text-conatinerp">
        <h3>CONNECT</h3>
        <p>Balinad Daraga, Albay</p>
      </div>
    </div>
    <ul class="list-unstyled components">
      <li><a href="userDashboard.php" class="load-page"><i class="material-icons">dashboard</i><span>Dashboard</span></a></li>
      <li><a href="userRequest.php" class="load-page"><i class="material-icons">description</i><span>Certificates</span></a></li>
      <li><a href="userReport.php" class="load-page"><i class="material-icons">report</i><span>Report</span></a></li>
      <li  class=""><a href="userActivityLog.php" class="load-page" data-page="userActivityLog.php"><i class="material-icons">history</i><span>Activity Log</span></a></li>
          
    </ul>
  </nav>

  <div id="content" class="flex-grow-1">
    <div class="top-navbar px-3 py-2 d-flex align-items-center justify-content-between" id="topnavbar">
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

      
      <div class="xp-profilebar d-flex align-items-center ms-auto">
        <nav class="navbar p-0">

          <ul class="nav navbar-nav flex-row align-items-center mb-0">
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
                              <span class="text-dark"><?php echo htmlspecialchars($notif['message']); ?></span>
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
            <li class="nav-item dropdown">
              <a class="nav-link d-flex align-items-center" href="#" id="profileToggle">
                <img src="img/<?php echo htmlspecialchars($user_profile); ?>" alt="Profile Picture" class="img-fluid profile-img" style="width:50px; height: 50px; border-radius:50%; box-shadow: 0 0 8px rgba(0, 0, 0, 0.15);"/>
              </a>
              <ul class="dropdown-menu dropdown-menu-end small-menu" id="profileDropdown">
                <li><a class="dropdown-item" href="userProfile.php" data-page="userProfile.php"><span class="material-icons me-2">person_outline</span>Profile</a></li>
                <li><a class="dropdown-item" href="userSettings.php"><span class="material-icons me-2">settings</span>Settings</a></li>
                <li><a class="dropdown-item load-page" href="frontpage.php" data-page="frontpage.php"><span class="material-icons me-2">logout</span>Logout</a></li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </div>

    

   <div class="main-content p-4" id="maincontent">
  <div class="profile">
    <h3 class="mb-4">Profile</h3>
    <div class="profile-top d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center">
    <div style="position: relative;" class="me-4">
      <img src="img/<?php echo htmlspecialchars($user_profile); ?>" alt="Profile Picture" class="img-fluid profile-img" id="profilePic" />
      <form id="profilePicForm" action="updateProfilePic.php" method="POST" enctype="multipart/form-data" style="display:none;">
        <input type="file" name="profile_photo" id="profilePhotoInput" accept="image/*" />
      </form>
      <button type="button" id="cameraBtn" style="position: absolute; bottom: 0; right: 0; background: #007bff; border: none; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
        <span class="material-icons" style="color: white; font-size: 20px;">photo_camera</span>
      </button>
    </div>
    <div>
      <h5><strong><?php echo strtoupper($firstName . " " . $middleInitial . " " . $lastName); ?></strong></h5>
      <span class="badge bg-primary"><?php echo($resident_ID) ?></span>
      <p>Barangay Resident | <?php echo $address; ?></p>
    </div>
  </div>
      <button id="editProfileBtn" class="btn btn-primary rounded-circle">
        <i class="material-icons">edit</i>
      </button>
    </div>


    <div id="editModal" class="modal">
  <div class="modal-content">
    <span class="close" id="closeModal" style="position: absolute; right: 20px; top: 15px; font-size: 24px; cursor: pointer;">&times;</span>
    <h3>Edit Profile</h3>

    <form id="editForm" class="row g-3" method="POST" action="updateProfile.php">
      <div class="col-sm-6 col-md-3">
        <label for="firstName">FIRST NAME</label>
        <input type="text" class="form-control" id="firstName" name="first_name" value="<?php echo htmlspecialchars($firstName); ?>">
      </div>

      <div class="col-sm-6 col-md-3">
        <label for="middleName">MIDDLE NAME</label>
        <input type="text" class="form-control" id="middleName" name="middle_name" value="<?php echo htmlspecialchars($middleName); ?>">
      </div>

      <div class="col-sm-6 col-md-3">
        <label for="lastName">LAST NAME</label>
        <input type="text" class="form-control" id="lastName" name="last_name" value="<?php echo htmlspecialchars($lastName); ?>">
      </div>

      <div class="col-sm-6 col-md-3">
        <label for="suffix">SUFFIX</label>
        <input type="text" class="form-control" id="suffix" name="suffix" value="<?php echo htmlspecialchars($suffix); ?>">
      </div>

      <div class="col-sm-6 col-md-3">
        <label for="gender">GENDER</label>
        <select class="form-select" id="gender" name="gender">
          <option value="Male" <?php if ($gender == 'Male') echo 'selected'; ?>>Male</option>
          <option value="Female" <?php if ($gender == 'Female') echo 'selected'; ?>>Female</option>
        </select>
      </div>

      <div class="col-sm-6 col-md-3">
        <label for="dob">DATE OF BIRTH</label>
        <input type="date" class="form-control" id="dob" name="birthdate" value="<?php echo $dob->format('Y-m-d'); ?>">
      </div>

      <div class="col-sm-6 col-md-3">
        <label for="placeOfBirth">PLACE OF BIRTH</label>
        <input type="text" class="form-control" id="placeOfBirth" name="birthplace" value="<?php echo htmlspecialchars($birth_place); ?>">
      </div>

      <div class="col-sm-6 col-md-3">
        <label for="civilStatus">CIVIL STATUS</label>
        <select class="form-select" id="civilStatus" name="civil_status">
          <option value="Single" <?php if ($civil_status == 'Single') echo 'selected'; ?>>Single</option>
          <option value="Married" <?php if ($civil_status == 'Married') echo 'selected'; ?>>Married</option>
          <option value="Engaged" <?php if ($civil_status == 'Engaged') echo 'selected'; ?>>Engaged</option>
        </select>
      </div>

      <div class="col-sm-6 col-md-3">
        <label for="barangay">BARANGAY</label>
        <input type="text" class="form-control" id="barangay" name="barangay" value="<?php echo htmlspecialchars($barangay); ?>">
      </div>

      <div class="col-sm-6 col-md-3">
        <label for="purok">PUROK</label>
        <input type="text" class="form-control" id="purok" name="purok" value="<?php echo htmlspecialchars($purok); ?>">
      </div>

      <div class="col-sm-6 col-md-3">
        <label for="street">STREET</label>
        <input type="text" class="form-control" id="street" name="street" value="<?php echo htmlspecialchars($street); ?>">
      </div>


      <div class="col-sm-6 col-md-6">
        <label for="religion">RELIGION</label>
        <input type="text" class="form-control" id="religion" name="religion" value="<?php echo htmlspecialchars($religion); ?>">
      </div>

      <div class="col-sm-6 col-md-6">
        <label for="nationality">NATIONALITY</label>
        <input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo htmlspecialchars($nationality); ?>">
      </div>

      <div class="col-12 d-flex justify-content-end gap-2 mt-3">
        <button type="button" id="closeButton" class="btn btn-light">Close</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </form>
  </div>
</div>
</div>

        <div class="profile-container">
        <div class="profile-left">
          <h4>Personal Information</h4><br>
          <div><i class="material-icons">today</i> <strong>AGE:</strong> <span><?php echo $age; ?></span></div>
          <div><i class="material-icons">wc</i> <strong>GENDER:</strong> <span><?php echo $gender; ?></span></div>
          <div><i class="material-icons">cake</i> <strong>DATE OF BIRTH:</strong> <span><?php echo $dob->format('F d, Y'); ?></span></div>
          <div><i class="material-icons">groups</i> <strong>CIVIL STATUS:</strong> <span><?php echo $civil_status; ?></span></div>
          <div><i class="material-icons">spa</i> <strong>RELIGION:</strong> <span><?php echo $religion; ?></span></div>
          <div><i class="material-icons">flag</i> <strong>NATIONALITY:</strong> <span><?php echo $nationality; ?></span></div>

        </div>
          <div class="profile-right">
            <div class="mb-3">
              <label for="contact" class="form-label fw-bold">CONTACT:</label>
              <div class="input-group">
                <input type="text" class="form-control" id="contact" value="<?php echo $contact; ?>" readonly>
                <button class="btn btn-outline-secondary"><i class="material-icons">content_copy</i></button>
              </div>
            </div>
            <div>
              <label for="tempPass" class="form-label fw-bold">TEMPORARY PASSWORD:</label>
              <div class="input-group">
                <input type="text" class="form-control" id="tempPass" value="<?php echo htmlspecialchars($password); ?>" readonly>
                <button class="btn btn-outline-secondary" onclick="copyToClipboard('tempPass')">
                  <i class="material-icons">content_copy</i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="sidebar.js"></script>
<script>
       
var modal = document.getElementById("editModal");
var editProfileBtn = document.getElementById("editProfileBtn");
var closeModal = document.getElementById("closeModal");
var closeButton = document.getElementById("closeButton");

// Open the modal when the button is clicked
editProfileBtn.onclick = function() {
  modal.style.display = "block";
};

// Close the modal when the "X" or "Close" button is clicked
closeModal.onclick = function() {
  modal.style.display = "none";
};

closeButton.onclick = function() {
  modal.style.display = "none";
};

// Close the modal if the user clicks anywhere outside of the modal content
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

  // Save Changes - Send form data via fetch to PHP
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(form);

    fetch("updateProfile.php", {
      method: "POST",
      body: formData
    })
    .then(response => response.text())
    .then(data => {
      alert(data); // Show result from PHP
      modal.style.display = "none"; // Close modal after success
    })
    .catch(error => {
      console.error("Error saving data:", error);
      alert("Error saving changes.");
    });
  });

  function copyToClipboard(elementId) {
    const input = document.getElementById(elementId);
    input.select();
    input.setSelectionRange(0, 99999); // For mobile devices

    navigator.clipboard.writeText(input.value).then(() => {
      alert("Copied to clipboard!");
    }).catch(() => {
      alert("Failed to copy.");
    });
  }
  
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

  document.getElementById('cameraBtn').addEventListener('click', function() {
  document.getElementById('profilePhotoInput').click();
});

document.getElementById('profilePhotoInput').addEventListener('change', function() {
  if (this.files && this.files[0]) {
    document.getElementById('profilePicForm').submit();
  }
});
  </script>
   </body>
   </html>
   
  